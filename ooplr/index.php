<?php

require_once('core/init.php');

if(Session::has('success')){
 echo "<div style='padding-left: 150px; padding-top:10px; color: green;'><h3>". Session::flash('success'). "</h3></div>";
}

//echo Session::get(Config::get('session/session_name'));
$user = new User();
if($user->isLoggedIn()){
?>
<?php include('includes/header.php');?>

<p>
  Hello Dear <a href="profile.php?user=<?php  echo e($user->data()->username); ?>" > <?php echo e($user->data()->username); ?></a> !<br>
  <ul style="">
      <li><a href="logout.php" class="btn btn-default btn-sm">Logout</a></li>
      <li><a href="index.php" class="btn btn-default btn-sm">Home</a></li>
      <li><a href="update.php" class="btn btn-default btn-sm">Update</a></li>

      <li><a href="changepassword.php" class="btn btn-default btn-sm">Change Password</a></li>
      <li><a href="profile.php?user=<?php  echo e($user->data()->username); ?>" class="btn btn-default btn-sm">Profile</a></li>

  </ul>


</p>
<?php include('includes/footer.php');?>

<?php
if($user->hasPermission('admin')){
  echo "You are an administrator!";
}
}else{
Redirect::to('login');
}
