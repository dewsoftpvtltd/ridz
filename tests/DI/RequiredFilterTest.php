<?php
namespace Tests\DI;
use DI\RequiredFilter;
class RequiredFilterTest extends \PHPUnit_Framework_TestCase
{
  /**
  * @var RegistrationFilter
  */
  protected $filter;
  /**
  * [setUp It is run before every test]
  */
  public function setUp(){
    $this->filter = new RequiredFilter();
  }
/**
 * [filterIsInstanceOfInputValidtor description]
 * @return void
 * @test
 */
public function filterIsInstanceOfInputValidtor(){
  $this->assertInstanceOf('DI\InputFilterInterface', $this->filter);
}
/**
 * [filterWithRequiredValueIsValid description]
 * @param  [type] $value [description]
 * @param  [type] $valid [description]
 * @return [void]        [description]
 * @test
 * @dataProvider requiredProvider
 */
  public function filterWithRequiredValueIsValid($value, $valid){
    $this->filter->setValue($value);
    if($valid){
      $this->assertTrue($this->filter->isValid());
      $this->assertEmpty($this->filter->getMessages());
    }else{
      $this->assertFalse($this->filter->isValid());
      $messages = $this->filter->getMessages();
    //  print_r($messages);
      $this->assertInternalType('array', $messages);
      $this->assertNotEmpty($messages);
      //$this->assertArrayHasKey($value,$messages);
      $this->assertContains(
         'Value is required',
         $messages
       );

    }
  }
  public function requiredProvider(){

     return array(
         array(1, true),
         array('banana', true),
         array(new \stdClass(), true),
         array(array(1), true),
         array(true, true),
         array(false, true),
         array(array(), true),
         array(0, true),
         array(0.0, true),
         array("0", true),
         array('', false),
         array(null, false),
    );
  }
  /**
      * Ensures the validator is validating validly.
      *
      * @return void
      * @test
      */
     public function messagesDoNotPersistBetweenIsValidCalls()
     {
         $this->filter->isValid();
         $this->assertCount(1, $this->filter->getMessages());
         $this->filter->isValid();
         $this->assertCount(1, $this->filter->getMessages());
     }
/**
 * [ClearMessageDoesWhatItSaysOnTheTin description]
 * @test
 */
  public function ClearMessageDoesWhatItSaysOnTheTin(){
    $this->filter->isValid();
    $this->assertCount(1, $this->filter->getMessages());

    $this->filter->clearMessages();
    $this->assertCount(0, $this->filter->getMessages());
  }

      /**
       * @test
       * @group QABugz
       */
      public function anotherBugFoundByQA()
      {
          $this->filter->isValid();
          $this->assertCount(1, $this->filter->getMessages());
          $this->filter->setValue('banana');
          $this->assertCount(0, $this->filter->getMessages());
          //$this->filter->getMessages();
      }
}
