<?php
namespace Tests\DI;
use DI\RegistrationFilter;
class RegistrationFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @var RegistrationFilter
    */
    protected $filter;
  /**
   * [setUp It is run before every test]
   */
    public function setUp(){
      $this->filter = new RegistrationFilter();
    }
  /**
   * [UsernameIsRequired description]
   * @test
   */
    public function UsernameIsRequired(){
      $this->filter->setValues(array());
      $this->assertFalse(
          $this->filter->validateUsername()
    );
    }

     /**
       * @test
       */
      public function ifUsernameIsProvidedIsValid()
      {
          $this->filter->setValues(
            array('username' => 'basit',)
          );
          $this->assertTrue(
          $this->filter->validateUsername()
        );
      }
      /**
        * @test
        */
       public function ifUsernameIsNotProvidedMessageIsCorrect()
       {
           $this->filter->setValues(
             array()
           );
           $this->assertFalse(
           $this->filter->validateUsername()
         );
         $messages = $this->filter->getMessages();
         $this->assertNotEmpty($messages);
         $this->assertArrayHasKey('username',$messages);
         $this->assertContains(
            'Username is required',
            $messages['username']
          );

       }

   /**
     * Tests username length validation
     *
     * @param string $username Username to validate
     * @param string $message Message if invalid
     *
     * @test
     * @dataProvider usernameProvider
     */
    public function usernameMustBeTheRightSize($username, $message = null)
    {
        $this->filter->setValues(array('username' => $username));
        if (is_null($message)) {
            // Valid username
            $this->assertTrue($this->filter->validateUsername());
            $this->assertEmpty($this->filter->getMessages());
            return;
        } else {
            // Invalid username
            $this->assertFalse($this->filter->validateUsername());
            $messages = $this->filter->getMessages();
            $this->assertNotEmpty($messages);
            $this->assertArrayHasKey('username', $messages);
            $this->assertContains($message, $messages['username']);
        }
    }
    /**
     * Provides a list of usernames. If it's blah...
     * @return array
     */
    public function usernameProvider()
    {
        return array(
            array('foobarSalami'),
            array('bc'),
            array(str_repeat('a', 40)),
            array(str_repeat('b', 41), 'Username must be less than 40 characters'),
            array('a', 'Username must be at least 2 characters'),
            array('foo@bar', 'Username contains invalid characters'),
            array('sam&banana', 'Username contains invalid characters'),
            array('*********', 'Username contains invalid characters'),
            array('broniez_4_life'),

          );
        }
        /**
       * @test
       * @dataProvider lowercaseUsernameProvider
       */
      public function validationLowercasesUsernames($username)
      {
          $this->filter->setValues(array('username' => $username));
          $this->assertTrue($this->filter->validateUsername());
          $this->assertEquals(
              strtolower($username),
              $this->filter->getValue('username')
          );
      }
      public function lowercaseUsernameProvider()
      {
          return array(
              array('FOO'),
              array('Foo'),
              array('12345'),
              array('FoO'),
              array('Bar'),
          );
      }
      /**
       * @test
       */
      public function passwordIsRequired()
      {
          $this->filter->setValues(array());
          $this->assertFalse($this->filter->validatePassword());
          $messages = $this->filter->getMessages();
          $this->assertNotEmpty($messages);
          $this->assertArrayHasKey('password', $messages);
          $this->assertContains('Password is required', $messages['password']);
      }
      /**
       *
       * @param string $password Password to test
       * @param boolean $valid Is it valid?
       *
       * @test
       *
       * @dataProvider passwordLengthProvider
       */
      public function passwordIsAtLeast8Characters($password, $valid)
      {
          $this->filter->setValues(array('password' => $password));
          if ($valid) {
              $this->assertTrue($this->filter->validatePassword());
          } else {
              $this->assertFalse($this->filter->validatePassword());
              $messages = $this->filter->getMessages();
              $this->assertNotEmpty($messages);
              $this->arrayHasKey('password', $messages);
              $this->assertContains(
                  'Password must be at least 8 characters',
                  $messages['password']
              );
          }
      }
      public function passwordLengthProvider()
      {
          return array(
              array('a', false),
              array('bb', false),
              array('ccc', false), // ...
              array('abcdefg', false),
              array('abcdeGgh1@', true),
          );
      }
        public function passwordComplexityWorks($password, $valid){
          $this->filter->setValues(array('password' => $password));
          if ($valid) {
              // Valid password
              $this->assertTrue($this->filter->validatePassword());
              $this->assertEmpty($this->filter->getMessages());
              return;
          } else {
              // Invalid password
              $this->assertFalse($this->filter->validatePassword());
              $messages = $this->filter->getMessages();
              $this->assertNotEmpty($messages);
              $this->assertArrayHasKey('password', $messages);
              $this->assertContains('Password complexity is too low', $messages['password']);
          }
        }

        public function complexPasswordProvider(){
          return array(
            array('a', false),
            array('a1', false),
            array('a1111111111', false),
            array('aBc234235', true),
            array('a@#$%Baaaa', true),
            array('p@ssw0rd', true),
            array('Aa1^2salami', true),
          );
        }
}
