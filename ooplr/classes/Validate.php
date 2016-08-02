<?php

/**
 *
 */
class Validate{
  private $passed = false,
          $errors= [],
          $db = null;
  public function __construct(){
    $this->db = DB::getInstance();
  }

  public function check($source, $items=[]){
    foreach ($items as $item => $rules) {
      foreach ($rules as $rule => $rule_value) {
        //echo $item.'  '.$rule.' must be '.$rule_value.'<br>';
        $value = trim($source[$item]);
        //echo $value. '<br>';
        if($rule ==='required' && empty($value)){
          $this->addError("{$item} is required!");
        }else if(!empty($value)){
            switch ($rule) {
              case 'min':
                if(strlen($value) < $rule_value){
                  $this->addError("{$item} should be at least {$rule_value} in length!");
                }
                break;
              case 'max':
              if(strlen($value) > $rule_value){
                $this->addError("{$item} should be a maximum of {$rule_value} in length!");
              }
                  break;
              case 'matches':
              if($value != $source[$rule_value]){
                $this->addError("{$item} must match {$rule_value}!");
              }
                  break;
              case 'unique':
              $check = $this->db->get($rule_value, [$item,'=',$value]);
              //print_r($check);
              if($check->count()){
                $this->addError("{$item} already exists!");
              }
                  break;
            }
        }
      }
    }
    if(empty($this->errors()))
    {
      $this->passed = true;
    }
    return $this;
  }
  public function passed(){
    return $this->passed;
  }
  private function addError($error){
    $this->errors[] = $error;
  }
  public function errors(){
    return $this->errors;
  }
}
