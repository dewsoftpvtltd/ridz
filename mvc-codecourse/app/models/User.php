<?php
//User Model
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {
  //public $username;
  protected $fillable = ['username', 'email'];

  public function __toString(){
    return "$this->username";
  }
}
