<?php
class Courier {
  public $name;
  public $home_country;
  public function __construct($name, $home_country) {
    $this->name = $name;
    $this->home_country = $home_country;
    $this->logfile = $this->getLogFile();
    return true;
  }
  protected function getLogFile() {
    // error log location would be in a config file
    return fopen('tmp/error_log.txt', 'a');
}
  public function log($message) {
    if($this->logfile) {
      fputs($this->logfile, 'Log message: ' . $message . "\n");
    }
}
  public function __sleep() {
    // only store the "safe" properties
    return array("name", "home_country");
}
  public function __wakeup() {
    // properties are restored, now add the logfile
    $this->logfile = $this->getLogFile();
    return true;
  }
}
$courier = new Courier('TCS', 'Pakistan');
echo '<pre>', print_r($courier),'</pre>';
$courier->log("hello there");
//echo $courier->getLogFile();
$json = serialize($courier);
echo $json;
$json = unserialize($json);
$json->log("hello there dear world");

echo '<pre>', print_r($json),'</pre>';
