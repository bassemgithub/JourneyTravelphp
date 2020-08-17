<?php

class JourneyTravel
{

    private $cards;

    private $sortedCards;

    private $firstCard;

    private $lastCard;

    function __construct($cards)
    {
        $this->cards = $cards;
    }

    public function formatting()
    {
        $result = [];
        foreach ($this->sortedCards as $key => $card) {
            $seat = $card['seat'] != 'No seat assignment' ? ' Seat ' . $card['seat'] : ' No seat assignment';
            $baggage = $card['baggage'] ? '. ' . $card['baggage'] . '.' : '';
            $result[] = 'Take ' . $card['type'] . '. From ' . $card['from'] . ' to ' . $card['to'] . '.' . $seat . $baggage;
            echo 'Take ' . $card['type'] . '. From ' . $card['from'] . ' to ' . $card['to'] . '.' . $seat . $baggage."\n";
        }
        $result[]= "You have arrived at your final destination.";
        echo 'You have arrived at your final destination.';
        return $result;
    }

    public function handleFirstLastCards()
    {
        $arrival = [];
        $departure = [];

        foreach ($this->cards as $key => $card) {
            $arrival[] = $card['to'];
            $departure[] = $card['from'];
        }

        foreach ($this->cards as $key => $card) {
            if (!in_array($card['from'], $arrival)) $this->firstCard = $card;
            if (!in_array($card['to'], $departure)) $this->lastCard = $card;
        }

        //Remove first and last card from cards list.
        foreach ($this->cards as $key => $card) {
            if ($this->firstCard == $card || $this->lastCard == $card) {
                unset($this->cards[$key]);
            }
        }

        $this->sortedCards[] = $this->firstCard;
    }

    public function handleAllCards()
    {
        while (true) {
            foreach ($this->cards as $key => $card) {
                if (end($this->sortedCards)['to'] == $card['from']) {
                    $this->sortedCards[] = $card;
                    unset($this->cards[$key]);
                }
                if (end($this->sortedCards)['to'] == $this->lastCard['from']) {
                    $this->sortedCards[] = $this->lastCard;
                    return $this->sortedCards;
                }
            }
        }

    }
    public function sort()
    {
        $this->handleFirstLastCards();
        $this->handleAllCards();
    }

}
