<?php
class Dwarf{
  protected $name;

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
    return $this;
  }

}

 ?>
