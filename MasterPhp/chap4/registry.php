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
  $name = (!is_null($name)) ?: get_class($object);
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
