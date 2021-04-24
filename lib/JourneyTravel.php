<?php
class JourneyTravel
{

    private array $cards;

    private array $sortedCards =[];

    private array $firstCard;

    private array $lastCard;

    private array $arrival = [];
    
    private array $departure = [];

    private string $result ="";

    private string $json_directory = __DIR__ ."/../json/";

    function __construct(string  $cards)
    {   
        $this->cards = json_decode(file_get_contents($this->json_directory.$cards), true);
    }
    
    public function __get($property) {
        if (property_exists($this, $property)) {
          return $this->$property;
        }
      }
    
    public function __set($property, $value) {
        if (property_exists($this, $property)) {
          $this->$property = $value;
        }

        return $this;
    }
     
    public function  __ToString()
    {
        
        foreach ($this->sortedCards as $key => $card) {
            $seat = $card['seat'] != 'No seat assignment' ? ' Seat ' . $card['seat'] : ' No seat assignment';
            $baggage = $card['baggage'] ? '. ' . $card['baggage'] . '.' : '';
            $this->result .= 'Take ' . $card['type'] . '. From ' . $card['from'] . ' to ' . $card['to'] . '.' . $seat . $baggage ."\n";
        }
        $this->result .= "You have arrived at your final destination.";
        return $this->result;
    }

    public function handleFirstLastCards()
    {
        #$arrival = [];
        #$departure = [];

        foreach ($this->cards as $key => $card) {
            $this->arrival[] = $card['to'];
            $this->departure[] = $card['from'];
        }

        foreach ($this->cards as $key => $card) {
            if (!in_array($card['from'], $this->arrival)) $this->firstCard = $card;
            if (!in_array($card['to'], $this->departure)) $this->lastCard = $card;
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
