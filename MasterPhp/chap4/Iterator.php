<?php
class BasicIterator implements Iterator {
    private $key = 0;
    private $data = array(
                          "hello",
                          "world",
                          "lovely"
                        );
    public function __construct() {
        $this->key = 0;
}
    public function rewind() {
        $this->key = 0;
}
    public function current() {
        return $this->data[$this->key];
}
    public function key() {
        return $this->key;
}
    public function next() {
        $this->key++;
        return true;
    }
    public function valid() {
        return isset($this->data[$this->key]);
} }
$iterator = new BasicIterator();
$iterator->rewind();
print_r($iterator);
do {
  $key = $iterator->key();
  $value = $iterator->current();
  echo '<pre>'. $key .': ' .$value . '</pre>'. PHP_EOL;
} while ($iterator->next() && $iterator->valid());

$iterator = new BasicIterator();
foreach ($iterator as $key => $value) {
  echo '<pre>'. $key .': ' .$value . '</pre>'. PHP_EOL;
}
