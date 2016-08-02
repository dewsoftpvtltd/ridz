<?php

/**
 *
 */
class Home extends Controller
{

  function __construct()
  {

  }


  function index($name = ''){
    //echo "$name";
    $user = User::whereUsername($name)->first();
    //var_dump($user->username);
    return $this->view('home/index',['name'=>$user->username, 'email'=>$user->email]);
  }

  function create($name = '',$o = ''){
     User::create([
       'username' => $name,
       'email' => $o
     ]);
  }

}
