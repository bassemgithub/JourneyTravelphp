<?php declare(strict_types=1);

class journeyTravelFactory extends JourneyTravel
{
    public static function create(string $cards)
    {
        return new JourneyTravel($cards);
    }
}


?>