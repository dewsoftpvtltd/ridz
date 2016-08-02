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
      'name'=>[
                  'required'=> true,
                  'min' => 2,
                  'max' =>50,
      ],
    ]
  );

  if($validation->passed()){

    try{
      $name = Input::get('name');
      $user->update(['name' => $name]);
      $update = true;
    }catch(Exception $e){
      die($e->getMessage());
    }
    // $user->update($name);
    //
    // if(true){
    //   $update = true;
    // }
    if($update){
      Session::flash('success', 'Your name has been update successfully');
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
  <h2>Update Form</h2>
  <form role="form" action='' method="post">

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name"  name="name"  placeholder="Enter name" value="<?php echo e($name) ?>" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <button type="submit" class="btn btn-default">Update</button>
  </form>

  </div>



<?php
include('includes/footer.php');
