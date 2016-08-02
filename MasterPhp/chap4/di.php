<?php



class Registry{
  /**
* @var array The store for all of our objects
*static private $_store = array();
*/
static private $_store = array();
/**
* Add an object to the registry
*
* If you do not specify a name the class name is used
*
* @param mixed $object The object to store
* @param string $name Name used to retrieve the object
* @return mixed If overwriting an object, the previous object will be returned.
 * @throws Exception
 */
static public function set($object, $name = null)
{
  // Use the class name if no name given, simulates singleton
  $name = (is_null($name)) ?: get_class($object);
  $name = strtolower($name);
  $return = null;
  if (isset(self::$_store[$name])) {
    // Store the old object for returning
    $return = self::$_store[$name];
  }
  self::$_store[$name]= $object;
  return $return;
}
/**
 * Get an object from the registry
 *
 * @param string $name Object name, {@see self::set()}
 * @return mixed
 * @throws Exception
 */
static public function get($name)
{
  if (!self::contains($name)) {
    throw new Exception("Object does not exist in registry");
}
  return self::$_store[$name];
}
/**
   * Check if an object is in the registry
   *
   * @param string $name Object name, {@see self::set()}
   * @return bool
   */
  static public function contains($name)
  {
    if (!isset(self::$_store[$name])) {
      return false;
}
    return true;
  }
  /**
   * Remove an object from the registry
   *
   * @param string $name Object name, {@see self::set()}
   * @returns void
   */
  static public function remove($name)
  {
    if (self::contains($name)) {
      unset(self::$_store[$name]);
    }
  }

  static public function getStore(){
    return self::$_store;
  }
}
// class SiteConfig{}
// $config = new SiteConfig();
// Registry::set($config, "siteconfig");
// var_dump(Registry::getStore());
   /**
 * Log Class
 */
class Log {
  /**
   * @var Log_Engine_Interface
   */
  protected $engine = false;
  /**
   * Add an event to the log
   *
   * @param string $message
   */
  public function add($message)
  {
    if (!$this->engine) {
      throw new Exception('Unable to write log. No Engine set.');
}
    $data['datetime'] = time();
    $data['message'] = $message;
    $session = Registry::get('session');
    $data['user'] = $session->getUserId();
    $this->engine->add($data);
  }
  /**
   * Set the log data storage engine
   *
   * @param Log_Engine_Interface $Engine
   */
  public function setEngine(Log_Engine_Interface $engine)
  {
    $this->engine = $engine;
  }
  /**
   * Retrieve the data storage engine
   *
   * @return Log_Engine_Interface
*/
  public function getEngine()
  {
    return $this->engine;
  }
}


interface Log_Engine_Interface {
  /**
   * Add an event to the log
   *
   * @param string $message
   */
  public function add(array $data);
}

class Log_Engine_File implements Log_Engine_Interface {
  /**
   * Add an event to the log
   *
   * @param string $message
   */
  public function add(array $data)
  {
$line = '[' .data('r', $data['datetime']). '] ' . $data['message']. ' User: ' .$data['user'] . PHP_EOL;
$config = Registry::get('siteconfig');
if (!file_put_contents($config['location'], $line, FILE_APPEND)) {
      throw new Exception("An error occurred writing to file.");
} }
}
$engine = new Log_Engine_File();
$log = new Log();
$log->setEngine($engine);
// Add it to the registry
Registry::set($log);

//var_dump($log);
