<?php

namespace Acme;

class Hand
{
    private $cards = array();

    public function __construct(array $cards)
    {
        foreach ($cards as $card) {
            array_push($this->cards, new Card(substr($card, 0,1), substr($card, 1,1)));
        }
    }

    public function getHighestRankInHand()
    {
        $aux = $this->getOrderedRanks();
        return max($aux);
    }

    private function getOrderedRanks()
    {
        $result = array();
        foreach ($this->cards as $card) {
            $result[] = $card->getCardRank();
        }
        sort($result);
        return $result;
    }

}
