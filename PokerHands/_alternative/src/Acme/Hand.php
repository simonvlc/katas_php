<?php

namespace Acme;

class Hand
{
    private $cards = array();

    public function __construct(array $cards)
    {
        foreach ($cards as $card) {
            $this->cards[] = Card::createFromString($card);
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
