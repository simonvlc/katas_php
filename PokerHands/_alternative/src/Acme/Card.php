<?php

namespace Acme;

class Card
{
    private $card_number;
    private $card_suit;
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

    public function __construct($card_number, $card_suit)
    {
        $this->card_number = $card_number;
        $this->card_suit = $card_suit;
    }

    public function getCardRank()
    {
        return $this->ranks_lookup[$this->card_number];
    }

    public static function createFromString($string)
    {
        return new Card(substr($string, 0,1), substr($string, 1,1));
    }
}