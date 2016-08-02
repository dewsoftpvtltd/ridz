<?php
include('includes/header.php');
require_once('core/init.php');

$user = new User();

if(!$user->isLoggedIn()){
  Redirect::to('login');
}else{
  $name = $user->data()->name;

  if(Input::exists()){
    if(Token::check(Input::get('token'))){
    $validate = new Validate();
    $validation = $validate->check($_POST,
    [
      'currentpassword'=>[
                  'required'=> true,
                  'min' => 6,
            ],
      'newpassword'=>[
                  'required'=> true,
                  'min' => 6,
            ],
      'newpasswordagain'=>[
                  'required'=> true,
                  'matches'=>'newpassword',
      ]
    ]
  );
  if($validation->passed()){
      $currentpassword = Input::get('currentpassword');
      $salt = $user->data()->salt;
      if(Hash::make($currentpassword,$salt) !== $user->data()->password){
        echo "Current password is not correct!";
        $changed = false;

      }else{
        $salt = Hash::salt(32);
        $user->update([
          'password'=> Hash::make(Input::get('newpassword'), $salt),
          'salt'=>$salt
        ]);
        $changed = true;
      }
    // $user->update($name);
    //
    // if(true){
    //   $update = true;
    // }
    if($changed){
      Session::flash('success', 'Your password has been updated successfully');
      Redirect::to('index');
    }else{
      echo 'failed';
     }


  //  echo "<div style='padding-left: 150px; padding-top:10px; color: green;'><h3>Passed</h3></div>";
  }else{
  echo "<div style='padding-left: 150px; padding-top:10px; color: red;'><h3>Errors Found!</h3></div>";
    foreach($validation->errors() as $ve){
      echo "<div style='padding-left: 150px; padding-top:10px; color: red;'>".$ve. "</div>";
    };
        }
      }
  }
}

?>
<div class="container">
  <h2>Change Password Form</h2>
  <form role="form" action='' method="post">

    <div class="form-group">
      <label for="currentpassword">Current Password:</label>
      <input type="password" class="form-control" id="currentpassword"  name="currentpassword" placeholder="Enter Current Password">
    </div>
    <div class="form-group">
      <label for="newpassword">New Password:</label>
      <input type="password" class="form-control" id="newpassword"  name="newpassword" placeholder="New Password">
    </div>
    <div class="form-group">
      <label for="newpasswordagain">New Password Again:</label>
      <input type="password" class="form-control" id="newpasswordagain"  name="newpasswordagain" placeholder="New Password Again">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <button type="submit" class="btn btn-default">Update</button>
  </form>

  </div>



<?php
include('includes/footer.php');
