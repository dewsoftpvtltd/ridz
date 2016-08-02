<?php

// Create a RecursiveDirectoryIterator
$directoryIterator = new RecursiveDirectoryIterator("./");
// Create a RecursiveIteratorIterator to recursively iterate
$recursiveIterator = new RecursiveIteratorIterator($directoryIterator);
// Create a filter for PHP files
$regexFilter = new RegexIterator($recursiveIterator, '/(.*?)\.(php|phtml|php3|php4|php5)$/');
// Iterate
foreach ($regexFilter as $key => $file) {
  /* @var SplFileInfo $file */
  echo $file->getFilename()."<br>". PHP_EOL;
}
