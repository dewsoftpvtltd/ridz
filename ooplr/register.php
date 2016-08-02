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
                'unique'=>'users',
    ],
    'name'=>[
                'required'=> true,
                'min' => 2,
                'max' =>50,
          ],
    'password'=>[
                'required'=> true,
                'min' => 6,
          ],
    'confirmpassword'=>[
                'required'=> true,
                'matches'=>'password',
    ]
  ]
);

if($validation->passed()){
  $user = new User;
  $salt = Hash::salt(32);
  //die($salt);
  try{$user->create([
    'username' =>Input::get('username'),
    'name' =>Input::get('name'),
    'password' =>Hash::make(Input::get('password'), $salt),
    'salt' =>$salt,
    'joined' =>date('Y-m-d H:i:s'),
    'group' =>1,
  ]);
  Session::flash('success', 'Your have been registered successfully');
  Redirect::to('index');
}catch(RegisterException $e){
  die($e->getMessage());
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
?>
<?php include('includes/header.php');?>
<div class="container">
  <h2>Registration Form</h2>
  <form role="form" action='' method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?php if(Input::exists()){ echo e(Input::get('username'));}?>" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name"  name="name"  placeholder="Enter name" value="<?php if(Input::exists()){ echo e(Input::get('name'));}?>" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password"  name="password" placeholder="Enter Password">
    </div>
    <div class="form-group">
      <label for="confirmpassword">Confirm Password:</label>
      <input type="password" class="form-control" id="confirmpassword"  name="confirmpassword" placeholder="Re-Enter Password">
    </div>
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <button type="submit" class="btn btn-default">Register</button>
  </form>
  <div class=""><a href="login.php"> Login Here!
  </a>
  </div>
</div>

<?php include('includes/footer.php');?>
