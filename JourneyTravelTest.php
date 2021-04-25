<?php

/*
function custom_autoloader($class) {
    include 'lib/' . $class . '.php';
    require './vendor/autoload.php';
}
spl_autoload_register('custom_autoloader');
$json_file = "cards.json";
$journeyTravel =journeyTravelFactory::create($json_file);
$journeyTravel->sort();

$json_file_test = "cards_test.json";
$journeyTravel_test =journeyTravelFactory::create($json_file_test);
$journeyTravel_test->sort();

$journeyTravel = $journeyTravel->sortedCards;
$backJourneyTravel = $journeyTravel_test->sortedCards;
print_r($journeyTravel);
print_r($backJourneyTravel);
*/




require_once 'PHPUnit/Autoload.php';
/**
 * For the test i'm using two array one how have the go journey travel
 * and the second is the return back journey travel passing by the same city crossed
 * in the go journey travel.
 * The goal is to verify that the fist city crossed in the go is the last in the return Back ....
 */
final class StackTest extends PHPUnit_Framework_TestCase 
{   

    private array $journeyTravel ;
    private array $backJourneyTravel;
    public function setUp() {

        // this array created using $journeyTravel->sort() based on the file card.json
        $this->journeyTravel = array(
            array(
                "from" => "Madrid",
                "to" => "Barcelona",
                "type" => "train 78A",
                "seat" => "45B",
                "Baggage" => null,
            ),
            array(
                "from" => "Barcelona",
                "to" => "Gerona Airport",
                "type" => "airport bus",
                "seat" => "No seat assignment",
                "Baggage" => null,
            ),
            array(
                "from" => "Gerona Airport",
                "to" => "Stockholm",
                "type" => "flight SK455",
                "seat" => "Gate 45B, seat 3A",
                "Baggage" => "Baggage drop at ticket counter 344",
            ),
            array(
                "from" => "Stockholm",
                "to" => "New York JFK",
                "type" => "train 78A",
                "seat" => "Gate 22, seat 7B",
                "Baggage" => "Baggage will we automatically transferred from your last leg",
            ),
        );

        // this array created using $journeyTravel->sort() based on the file card_test.json
         $this->backJourneyTravel = array(
            array(
                "to" => "Stockholm",
                "from" => "New York JFK",
                "type" => "train 78A",
                "seat" => "Gate 22, seat 7B",
                "Baggage" => "Baggage will we automatically transferred from your last leg",
            ),
            array(
                "to" => "Gerona Airport",
                "from" => "Stockholm",
                "type" => "flight SK455",
                "seat" => "Gate 45B, seat 3A",
                "Baggage" => "Baggage drop at ticket counter 344",
            ),
            array(
                "to" => "Barcelona",
                "from" => "Gerona Airport",
                "type" => "airport bus",
                "seat" => "No seat assignment",
                "Baggage" => null,
            ),
            array(
                "to" => "Madrid",
                "from" => "Barcelona",
                "type" => "train 78A",
                "seat" => "45B",
                "Baggage" => null,
            )

        );
    }
    
    public function testvisitedcity(): void
    {
        for ($i = 0 ; $i<count($this->journeyTravel); $i++ ){
            $this->assertSame($this->journeyTravel[$i]["from"], $this->backJourneyTravel[count($this->backJourneyTravel)-$i-1]["to"]);
            $this->assertSame($this->journeyTravel[$i]["to"], $this->backJourneyTravel[count($this->backJourneyTravel)-$i-1]["from"]);
        }
    }
}
