<?php
interface Iterator extends Traversable {
  public function current ();
  public function key();
  public function next();
  public function rewind();
  public function valid();
}


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
