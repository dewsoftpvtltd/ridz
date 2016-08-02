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
// Create our Recursive data structure
$recursiveIterator = new RecursiveArrayIterator($array);
// Create our recursive iterator
$recursiveIteratorIterator = new RecursiveIteratorIterator($recursiveIterator);
// Create a limit iterator
$limitIterator = new LimitIterator($recursiveIteratorIterator,2, 5);
// Iterate
foreach ($limitIterator as $key => $value) {
  $innerIterator = $limitIterator->getInnerIterator();
  echo '<pre>Depth: ' .$innerIterator->getDepth() . '</pre>'.PHP_EOL;
  echo '<pre>Key: ' .$key . '</pre>' . PHP_EOL;
  echo '<pre>Value: ' .$value . '</pre>' . PHP_EOL;
}
