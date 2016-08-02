<?php


class User{
  private  $db = null, $data, $sessionName, $isLoggedIn = false, $cookieName;

  public function __construct($user = null){
    $this->db = DB::getInstance();
    $this->sessionName = Config::get('session/session_name');
    $this->cookieName = Config::get('remember/cookie_name');

    if(!$user){
      $user = Session::get($this->sessionName);
      if(Session::has($this->sessionName)){
        $this->find($user);
        $this->isLoggedIn = true;
      }else{
      //  $this->logout();
        $this->isLoggedIn = false;
      }
    }else{
      $this->find($user);
    }
  }

  public function create($fields){
    if(!$this->db->insert('users', $fields)){
      throw new RegisterException('Account could not be created!');
    }
  }
  public function find($user){
    if($user) {
      $field = (is_numeric($user)) ? 'id': 'username';
      $userdata =  $this->db->get('users', [$field,'=',$user]);
      if($userdata->count()){
        $this->data = $userdata->first();
        return true;
      }
    }
  }
  public function login($username = null,$password = null, $remember=false){
    if(!$username && !$password && $this->exists()){
      Session::put($this->sessionName, $this->data()->id);

    }else{
      $user = $this->find($username); //var_dump($this->data());

    if($user){

      if($this->data()->password === Hash::make($password, $this->data()->salt)){
          Session::put($this->sessionName, $this->data()->id);

          if($remember){
            $hash = Hash::unique();//die($this->data()->id);
            $hashCheck = $this->db->get('users_session', ['user_id','=', $this->data()->id]);
//var_dump($hashCheck);die();
            if(!$hashCheck->count()){
              $this->db->insert('users_session',[
                'user_id' => $this->data()->id,
                'hash' => $hash
              ]);
              Cookie::put($this->cookieName, $hash, Config::get('remember/cookie_expiry'));
            }else{
              $hash = $hashCheck->first()->hash;
            //  die($hash);
            }
          }
          return true;
      }
    }
  }
    return false;
  }
  public function logout(){
    $this->db->delete('users_session', ['user_id','=',$this->data()->id]);
    Session::delete($this->sessionName);
    Cookie::delete($this->cookieName);


  }
  public function data(){
    return $this->data;
  }

public function exists(){
  return (!empty($this->data)) ? true : false;
}
  public function isLoggedIn(){
    return $this->isLoggedIn;
  }

  public function update($fields=[], $id = null){
    if(!$id && $this->isLoggedIn()){
      $id = $this->data()->id;
    }

    if(!$this->db->update('users', $id, $fields)){
      throw new Exception("There was a problem updating...");
    }
  }

  public function hasPermission($key){
    $group =  $this->db->get('groups', ['id','=',$this->data()->group]);
    if($group->count()){
      $permissions = json_decode($group->first()->permissions, true);
      //print_r($permissions);
       if($permissions[$key] == true){
          return true;
        }
    }
    return false;
  }
}


class RegisterException extends Exception{}
