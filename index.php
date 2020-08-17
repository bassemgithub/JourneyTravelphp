<?php
#$cards = require('cards.php');
$string = file_get_contents("cards.json");
$cards = json_decode($string, true);
print_r("cards",$cards);
require('JourneyTravel.php');

$journeyTravel = new JourneyTravel($cards);
$journeyTravel->sort();
$cards = $journeyTravel->formatting();
