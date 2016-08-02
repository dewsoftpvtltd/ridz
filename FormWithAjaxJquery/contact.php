<?php
//header('Content-Type', 'text/Javascript');
//
// $json = ['name'=>'basit'];
$json = [
  'success'=> false,
  'name' => 'basit',
  'email'=>'email',
  'message'=>'something'
];
$request = $_POST;
if(isset($request['name'],$request['email'],$request['message'])){
  $name = $request['name'];
  $email = $request['email'];
$message = $request['message'];

  $json['success'] = true;
  $json['name'] = $name;
  $json['email'] = $email;
  $json['message'] = $message;
}

echo json_encode($json);
