<?php
function custom_autoloader($class) {
  include 'lib/' . $class . '.php';
}
 
spl_autoload_register('custom_autoloader');

$json_file = "cards.json";
$journeyTravel =journeyTravelFactory::create($json_file);
$journeyTravel->sort();
print $journeyTravel;
