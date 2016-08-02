<?php
session_start();

$GLOBALS['Config'] = array(
  'mysql' => array(
    'host'=>'127.0.0.1',
    'db'=>'login-codecourse',
    'username'=>'homestead',
    'password'=>'secret',

  ),
  'remember' => array(
    'cookie_name'=>'hash',
    'cookie_expiry'=>604800,
  ),
  'session'=>array(
  'session_name'=>'user',
  'token_name'=>'token'
)
);

spl_autoload_register(function($class){
    require_once("classes/$class.php");
});

require_once("functions/sanitize.php");
$sessionName = Config::get('session/session_name');
$cookieName = Config::get('remember/cookie_name');

if(Cookie::exists($cookieName) && !Session::exists($sessionName)){
  $hash = Cookie::get($cookieName);
  $hashCheck = DB::getInstance()->get('users_session', ['hash','=', $hash]);
if($hashCheck->count()){
  $user = new User($hashCheck->first()->id);
  $user->login();

}
}
