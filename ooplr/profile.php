<?php
include('includes/header.php');
require_once('core/init.php');

if(!$username = Input::get('user')){
  Redirect::to('index');
}else{
    $user = new User($username);
    if($user->exists()){
      $data = $user->data();
?>
<h3><?php echo e($data->username); ?></h3>

<p>
  Full Name : <?php echo e($data->name); ?>
</p>

<?php
    }else{
      Redirect::to(404);
    }

}




include('includes/footer.php');
