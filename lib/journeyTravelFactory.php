<?php

class journeyTravelFactory extends JourneyTravel
{
    public static function create($cards)
    {
        return new JourneyTravel($cards);
    }
}


?>