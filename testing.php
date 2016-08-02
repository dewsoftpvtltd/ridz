<html>
	<head>
		<title>
		INS Admin Panel
		</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">

    </head>
    <body>
    <div style="padding: 30px;">
    <?php
spl_autoload_register(function($class){
   require_once "classes/{$class}.php";
});
$dosomething = new dosomething("Hello World!","100 Years");
//echo $dosomething();
echo "<br><br>";

function runThing($function){
  $stuff = $function();
  echo $stuff;
}

$foo = function(){ echo "I am a function";};
echo "<br><br>";

runThing($dosomething);
echo "<br><br>";
var_export($dosomething);
echo "<br><br>";

$magic = new MagicMethods;
echo "mums:".$magic->mums."<br><br>";
$magic->puns = 3;
echo $magic->buns('name','place')."<br><br>";
echo "luns:".$magic->luns."<br><br>";
//$magic is called in string context
echo $magic.", ". $magic->luns."<br><br>";
$magic(4);//invoke magic
echo "<br><br>";
MagicMethods::runTest('in static context');  // As of PHP 5.3.0
echo "<br><br>";
var_dump($magic);
var_dump(serialize($magic));
$serialized = serialize($magic);
$newMagic = unserialize($serialized);
var_dump($newMagic);
var_dump(serialize($newMagic));

$magic->mums = 'nude girls';
if(isset($magic->mums)){
  echo "\$magic->mums is set to : ";
}else{
  echo "nothing set";
};
echo $magic->mums."<br><br>";
//unset($magic->mums);
echo "<br><br>";

if(isset($magic->mums)){
  echo "\$magic->mums is set to : ";
}else{
  echo "nothing set<br><br>";
};
//print_r($magic->file());
$greeting = $magic->getGreeting();
$greeting();
echo "<br><br>";

$greeting = $newMagic->getGreeting();
$greeting();

session_start();

if(isset($_SESSION['magic'])){
  var_dump($_SESSION['magic']);
};
$_SESSION['magic']= $magic;
//phpinfo(); //find session.save_path and cd into it to nano the cookie file; php serializes data to save to session cookie
unset($magic);

$dwarf = new Dwarf;
$dwarf->setName("Bona");
echo $dwarf->getName()."\n";
echo "hi";
?>
</div>
</body>
</html>
