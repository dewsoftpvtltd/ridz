<?php
/**
 * Log Factory
 *
 * Setup and return a file, mysql, or sqlite logger
 */
class Log_Factory {
  /**
* Get a log object
*
* @param string $type The type of logging backend, file mysql or sqlite
   * @param array $options Log class options
   */
  public function getLog($type = 'file', array $options)
  {
    // Normalize the type to lowercase
    $type = strtolower($type);
// Figure out the class name and include it
$class = "Log_" .ucfirst($type);
require_once str_replace('_', DIRECTORY_SEPARATOR, $class) .'.php';
// Instantiate the class and set the appropriate options
    $log = new $class($options);
    switch ($type) {
      case 'file':
        $log->setPath($options['location']);
        break;
      case 'mysql':
        $log->setUser($options['username']);
        $log->setPassword($options['password']);
        $log->setDBName($options['location']);
        break;
      case 'sqlite':
        $log->setDBPath($options['location']);
        break;
}
    return $log;
  }
}

$logs = new Log_Factory();
$see = $logs->getLog('file', ['location'=>'/temp']);
print_r($see);

/**
 * [$array Foreach written as do/while loop using php built in functions]
 * @var array
 */
$array = array("Hello", "World","Lovely");
reset($array);
print_r($array);
do {
echo '<pre>'.key($array) .': '. current($array) .'</pre>'. PHP_EOL;
} while (next($array));
foreach ($array as $key => $value) {
  echo '<pre>'. $key .': ' .$value . '</pre>'. PHP_EOL;
}
