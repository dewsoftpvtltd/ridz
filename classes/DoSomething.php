<?php /**
 *
 */
class DoSomething
{


  protected $name;
  protected $age;
  public $greeting;

  function __construct($name, $age)
  {
      $this->name = $name;
        $this->age = $age;

  }

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
    return $this;
  }
  public function __invoke(){
    return $this->getName();
  }
  public function __set_state($stuff){
     $this->name = $stuff['name'];
     $this->age = $stuff['age'];
     $this->greeting = function (){
       echo "hello from set state";
     };
  }
}
 ?>
