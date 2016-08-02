<?php
$array = array(
  "Hello", // Level 1
  array(
    "World" // Level 2
  ),
  array(
    "How", // Level 2
    array(
      "are", // Level 3
      "you" // Level 3
    )
),
  "doing?" // Level 1
);
$recursiveIterator = new RecursiveArrayIterator($array);
$recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveIterator);
foreach ($recursiveIteratorIterator as $key => $value) {
echo '<pre>Depth: ' . $recursiveIteratorIterator->getDepth() .'</pre>' . PHP_EOL;
      echo '<pre>Key: ' . $key . '</pre>' . PHP_EOL;
  echo '<pre>Value: ' .$value . '</pre>' . PHP_EOL;
}
