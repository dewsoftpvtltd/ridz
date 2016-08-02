<?php
class MagicMethods{
  private $mums = 2;
  protected $luns  = 1;
  //protected $file;
  protected $greeting;

public function __construct(){
  echo "making class...";
  $this->greeting = function(){
    //return fopen(__DIR__."/sleepy.php", 'r');
    echo "hello! I have exactly ".$this->luns." lun";
  };

}
public function getGreeting(){
  return $this->greeting;
}
public function __sleep(){
  return ['mums', 'luns'];
}
public function __wakeup(){
  $this->luns = 2;
  $this->greeting = function(){
    echo "hello! I have exactly ".$this->luns." luns now";
  };
}
  public function __get($name){
    if (property_exists($this, $name)) {
      return $this->$name;
  }else{
    echo "Failed to find $name";
  }
}
public function __set($property, $value) {
              if (property_exists($this, $property)) {
                      echo "<pre>Setting $value</pre>";

                      // ... Clever code for sanitation...
                      if ($value == "Evil input from user"){
                              echo "<pre>Oh no! Bad user! Go sit in the corner!</pre>";
                              $this->$property = null;
                      } else {
                              $this->$property = $value;
                      }
              }
              return $this;
      }

      /**  As of PHP 5.1.0  */
    public function __isset($name)
    {
        echo "Is '$name' set?<br><br>";
        if (property_exists($this, $name)) {

        return isset($this->$name);
      }
    }
    /**  As of PHP 5.1.0  */
       public function __unset($name)
       {
           echo "Unsetting '$name'\n";
           if (property_exists($this, $name)) {

           unset($this->$name);
       }
     }

  public function __toString(){
    return $this->luns. " , ".$this->mums;
  }
  public function __call($func, $arguments)
   {
       // Note: value of $func is case sensitive.
       if($arguments == ['name','place']){
       echo "Calling Object's method '$func' with args: "
            . implode(', ', $arguments). "\n";
          }else{
            echo "walla";
          }
   }


   /**  As of PHP 5.3.0  */
     public static function __callStatic($name, $arguments)
     {
         // Note: value of $name is case sensitive.
         echo "Calling static method '$name' "
              . implode(', ', $arguments). "\n";
     }

  public function __invoke(){
    echo "i am not a function";
  }

public function __destruct(){
  echo "destroying class...";
}
}
