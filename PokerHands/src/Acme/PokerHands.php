<?php

namespace Acme;

class PokerHands
{
    const PAIR = 2;
    const DOUBLE_PAIRS = 3;
    const TRIPS = 4;
    const STRAIGHT = 5;
    const FLUSH = 6;
    const FULL = 7;
    const POKER = 8;

    public $hand1 = array();
    public $hand2 = array();
    private $card_ranks = array(
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

    public function compareHands($hand1, $hand2)
    {

        if ($this->getHandType($hand1) == $this->getHandType($hand2)) {

            // if ($this->getHandType($hand1) == self::DOUBLE_PAIRS) {
            //     return (max($this->getPairs($hand1))
            //         > max($this->getPairs($hand2)) ? $hand1 : $hand2);
            //     // else return highcard of the non paired card
            // }

            if ($this->getHandType($hand1) == self::PAIR) {
                $aux = $this->getOrderedHandRanks($hand1);
                $rank1 = $aux[0];

                $aux = $this->getOrderedHandRanks($hand2);
                $rank2 = $aux[0];

                // var_dump($rank1);
                // var_dump($rank2);
            }

            return ($this->getHighestCardRankInAHand($hand1)
                > $this->getHighestCardRankInAHand($hand2) ? $hand1 : $hand2);
        }

        if ($this->getHandType($hand1) > $this->getHandType($hand2)) {
            return $hand1;
        }

        if ($this->getHandType($hand1) < $this->getHandType($hand2)) {
            return $hand2;
        }
    }

    private function getHighestCardRankInAHand($cards)
    {
        return max($this->getOrderedRanks($cards));
    }

    private function hasAPair($cards)
    {
        return $this->getGroupedHandRanks($cards) == array(2,1,1,1);
    }

    public function hasDoublePairs($cards)
    {
        return $this->getGroupedHandRanks($cards) == array(2,2,1);
    }

    private function hasTrips($cards)
    {
        return $this->getGroupedHandRanks($cards) == array(3,1,1);
    }

    private function hasStraight($cards)
    {

        $cards = $this->getOrderedRanks($cards);
        if ($cards[4] == 14) { // ace
            for ($i=0; $i < 3 ; $i++) {
                if ($cards[$i+1] - $cards[$i] != 1)  {
                    return false;
                }
            }
            return true;
        }
        if ($cards[4] - $cards[0] == 4) return true;

    }

    private function hasFlush($cards)
    {
        return $this->countSuits($cards) == 1;
    }

    private function hasFullHouse($cards)
    {
        return $this->getGroupedHandRanks($cards) == array(3,2);
    }

    private function hasPoker($cards)
    {
        return $this->getGroupedHandRanks($cards) == array(4,1);
    }




    private function getHandType($hand)
    {
        if ($this->hasPoker($hand)) return self::POKER;
        if ($this->hasFullHouse($hand)) return self::FULL;
        if ($this->hasFlush($hand)) return self::FLUSH;
        if ($this->hasStraight($hand)) return self::STRAIGHT;
        if ($this->hasTrips($hand)) return self::TRIPS;
        if ($this->hasDoublePairs($hand)) return self::DOUBLE_PAIRS;
        if ($this->hasAPair($hand)) return self::PAIR;
        return 1;
    }

    private function getCardRank($card)
    {
        foreach ($this->card_ranks as $key => $value) {
            if (preg_match("/$key/", $card) == true)
                return $value;
        }
    }

    private function getCardSuit($card)
    {
        return (substr($card, 1, 1));
    }

    private function getOrderedRanks($cards)
    {
        $result = array();
        foreach ($cards as $card) {
            $result[] = $this->getCardRank($card);
        }
        sort($result);
        return $result;
    }

    private function countSuits($cards)
    {
        $result = array();
        foreach ($cards as $card) {
            $result[] = $this->getCardSuit($card);
        }

        if (count(array_unique($result)) == 1) return true;
    }

    private function getGroupedHandRanks($cards)
    {
        $ordered_array = array_count_values($this->getOrderedRanks($cards));
        arsort($ordered_array);
        return array_values($ordered_array);
    }

    private function getOrderedHandRanks($cards)
    {
        $ordered_array = array_count_values($this->getOrderedRanks($cards));
        arsort($ordered_array);
        var_dump(array_keys($ordered_array));
        return array_keys($ordered_array);
    }



}
