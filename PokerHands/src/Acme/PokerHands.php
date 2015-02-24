<?php

namespace Acme;

class PokerHands
{

    public $hand1 = array();
    public $hand2 = array();
    private $cardRank = array(
        "A" => 14,
        "K" => 13,
        "Q" => 12,
        "J" => 11,
        "10" => 10,
        "9" => 9,
        "8" => 8,
        "7" => 7,
        "6" => 6,
        "5" => 5,
        "4" => 4,
        "3" => 3,
        "2" => 2,
        );
    // private $handRank = array(
    //     "HighCard" => 1,
    //     "Pair" => 2
    //     );

    public function getCardRank($card)
    {
        foreach ($this->cardRank as $key => $value) {
            if (preg_match("/$key/", $card) == 1)
                return $value;
        }
    }

    public function compareHands($hand1, $hand2)
    {
        $handRank1 = $this->getHandRank($hand1);
        $handRank2 = $this->getHandRank($hand2);

        if ($handRank1 > $handRank2)
            return $hand1;
        elseif ($handRank1 < $handRank2)
            return $hand2;
        else { // same handRank
            if ($this->getHighestCardRankInAHand($hand1) > $this->getHighestCardRankInAHand($hand2))
                return $hand1;
            return $hand2;
        }
    }

    private function getHighestCardRankInAHand($hand)
    {
        $highestRank = 0;
        foreach ($hand as $card) {
            if ($this->getCardRank($card) > $highestRank)
                $highestRank = $this->getCardRank($card);
        }
        return $highestRank;
    }

    private function handContainsAPair($hand)
    {
        for ($i = 0; $i < 5; $i++) {
            for ($j = $i + 1; $j < 5; $j++) {
                if ($this->getCardRank($hand[$i]) == $this->getCardRank($hand[$j]))
                    return true;
            }
        }
        return false;
    }

    public function handContainsADoublePair($hand)
    {
        $pair = 0;
        for ($i = 0; $i < 5; $i++) {
            for ($j = $i + 1; $j < 5; $j++) {
                if ($this->getCardRank($hand[$i]) == $this->getCardRank($hand[$j])) {
                    $pair++;
                    $i = $j;
                    $j++;
                    if ($pair == 2)
                        return true;
                }
            }
        }
        return false;
    }

    private function handContainsTrips($hand)
    {
        $trips = 0;
        for ($i = 0; $i < 5; $i++) {
            for ($j = $i + 1; $j < 5; $j++) {
                if ($this->getCardRank($hand[$i]) == $this->getCardRank($hand[$j]))
                    $trips++;
                    if ($trips == 3)
                        return true;
            }
        }
        return false;
    }

    private function handContainsAStraight($hand)
    {
        $orderedHand = array();
        foreach ($hand as $card) {
            $orderedHand[] = $this->getCardRank($card);
        }
        sort($orderedHand);
        for ($i=0; $i < 4 ; $i++) {
            if ($orderedHand[$i+1] - $orderedHand[$i] > 1) return false;
        }
        return true;
    }

    private function handContainsAFlush($hand)
    {
        for ($i=0; $i < 1 ; $i++) {
            for ($j = $i + 1; $j < 5; $j++) {
                if ($this->getCardSuit($hand[$i]) != $this->getCardSuit($hand[$j])) return false;
            }
        }
        return true;
    }

    private function getHandRank($hand)
    {
        if ($this->handContainsAFlush($hand)) return 6;
        if ($this->handContainsAStraight($hand)) return 5;
        if ($this->handContainsTrips($hand)) return 4;
        if ($this->handContainsADoublePair($hand)) return 3;
        if ($this->handContainsAPair($hand)) return 2; // pair
        return 1; // high card
    }

    private function getCardSuit($card)
    {
        return (substr($card, 1, 1));
    }

}
