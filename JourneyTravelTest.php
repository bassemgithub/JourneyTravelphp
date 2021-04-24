<?php


function custom_autoloader($class) {
    include 'lib/' . $class . '.php';
    require './vendor/autoload.php';
}

//require './vendor/autoload.php';
//require './lib/journeyTravelFactory.php';
/*
spl_autoload_register('custom_autoloader');
$json_file = "cards.json";
$journeyTravel =journeyTravelFactory::create($json_file);
$journeyTravel->sort();

$json_file_test = "cards_test.json";
$journeyTravel_test =journeyTravelFactory::create($json_file_test);
$journeyTravel_test->sort();

$journeyTravel = $journeyTravel->sortedCards;
$backJourneyTravel = $journeyTravel_test->sortedCards;

class StackTest extends PHPUnit_Framework_TestCase
{
    public function testvisitedcity(): void
    {
        for ($i = 0 ; $i<count($journeyTravel); $i++ ){
            $this->assertSame($journeyTravel[$i]["from"], $backJourneyTravel[count($backJourneyTravel)-$i-1]["to"]);
        }

    }
}
*/

//require './vendor/autoload.php';

spl_autoload_register('custom_autoloader');
$json_file = "cards.json";
$journeyTravel =journeyTravelFactory::create($json_file);
$journeyTravel->sort();

$json_file_test = "cards_test.json";
$journeyTravel_test =journeyTravelFactory::create($json_file_test);
$journeyTravel_test->sort();

$journeyTravel = $journeyTravel->sortedCards;
$backJourneyTravel = $journeyTravel_test->sortedCards;


final class StackTest extends PHPUnit_Framework_TestCase 
{   
    public function setUp() {
        $json_file_test = "cards_test.json";
        $journeyTravel_test =journeyTravelFactory::create($json_file_test);
        $journeyTravel_test->sort();
        $journeyTravel = $journeyTravel->sortedCards;
        $this->journeyTravel = $journeyTravel;
    }
    
    public function testvisitedcity(): void
    {
        for ($i = 0 ; $i<count($this->journeyTravel); $i++ ){
            $this->assertSame($journeyTravel[$i]["from"], $backJourneyTravel[count($backJourneyTravel)-$i-1]["to"]);
        }
    }
}
