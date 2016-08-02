<?php
require_once('core/init.php');

if(Input::exists()){
  if(Token::check(Input::get('token'))){
  $validate = new Validate();
  $validation = $validate->check($_POST,
  [
    'username'=>[
                'required'=> true,
                'min' => 2,
                'max' =>20,
    ],

    'password'=>[
                'required'=> true,
                'min' => 6,
          ]
  ]
);

if($validation->passed()){
  $user = new User;
  $remember = (Input::get('remember') ==='on')? true: false;
  $login = $user->login(Input::get('username'),Input::get('password'),$remember);
  if($login){
    Session::flash('success', 'Your have been logged in successfully');
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
?><?php include('includes/header.php');?>
<div class="container">
  <h2>Login Form</h2>
  <form role="form" action='' method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?php if(Input::exists()){ echo e(Input::get('username'));}?>" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password"  name="password" placeholder="Enter Password">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

    <div class="checkbox">
      <label><input type="checkbox" id="remember" name="remember"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Login</button>
  </form>
  <div class=""><a href="register.php"> Register Here!
  </a>
  </div>
</div>

<?php include('includes/footer.php');?>
