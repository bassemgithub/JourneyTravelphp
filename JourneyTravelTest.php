<?php
use PHPUnit\Framework\TestCase;
require('JourneyTravel.php');
$string = file_get_contents("cards.json");
$cards = json_decode($string, true);
$journeyTravel = new JourneyTravel($cards);
$journeyTravel->sort();
$journey = $journeyTravel->formatting();
// remove the last element from $journey
$journey = array_pop($journey);

$string_test = file_get_contents("cards_test.json");
$cards_test = json_decode($string_test, true);

$journeyTravel_test = new JourneyTravel($cards_test);
$journeyTravel_test->sort();
$journey_test = $journeyTravel_test->formatting();
// remove the last element from $journey_test 
$journey_test = array_pop($journey_test);

class StackTest extends TestCase
{
    public function testvisitedcity()
    {
        for ($i = 0 ; $i<count($journey); $i++ ){
            $this->assertSame($journey[$i], $journey_test[count($journey)-$i-1]);
        }
    }
}