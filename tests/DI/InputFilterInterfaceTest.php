<?php
namespace Tests\DI;
use DI\InputFilterInterface;
class InputFilterInterfaceTest extends \PHPUnit_Framework_TestCase
{
  protected $mock;
  public function setUp(){
    $mockFactory = $this->getMockBuilder('DI\InputFilterInterface');
    $this->mock = $mockFactory->getMockForAbstractClass();
  }
  /**
   * [interfaceHasMethodsWeWant description]
   * @param  [type] $method [description]
   * @return void         [description]
   * @test
   * @dataProvider methodProvider
   */
  public function interfaceHasMethodsWeWant($method){
    $this->assertTrue(
        method_exists($this->mock, $method)
  );
  }
  public function methodProvider(){
    return array(
      array('isValid'),
      array('setValue'),
      array('getMessages'),
    );
  }
}
