<?php

namespace Acme;

class Card
{
    public $card_number;
    public $suit;
    private $ranks_lookup = array(
        "A" => 14,
        "K" => 13,
        "Q" => 12,
        "J" => 11,
        "T" => 10,
        "9" => 9,
        "8" => 8,
        "7" => 7,
        "6" => 6,
        "5" => 5,
        "4" => 4,
        "3" => 3,
        "2" => 2,
        );

    public function __construct($card_number, $suit)
    {
        $this->card_number = $card_number;
        $this->suit = $suit;
    }

    public function getCardRank()
    {
        return $this->ranks_lookup[$this->card_number];
    }
}