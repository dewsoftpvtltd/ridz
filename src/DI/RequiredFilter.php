<?php
namespace DI;

class RequiredFilter implements InputFilterInterface
{
  protected $value;
  protected $messages = [];
  protected $isValidated = false;
  /**
   * Sets the value to validate
   *
   * @param mixed $value Value to validate
   *
   * @return static
   */
  public function setValue($values)
  {
      $this->value = $values;
      $this->clearMessages();

      return $this;
  }

  /**
   * Returns error messages for whatever went wrong
   *
   * @return array
   */
  public function getMessages(){
        return $this->messages;
  }
  /**
   * Determines if the input filter is valid
   *
   * @return boolean
   */
  public function isValid(){

    if(is_null($this->value) ||
    $this->value === ''
  ){
    $this->messages[] = 'Value is required';
      return false;
    }else{
      return true;
    }

  }

  public function clearMessages(){
    $this->messages = [];
  }
}
