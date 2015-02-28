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
    const STRAIGHT_FLUSH = 9;

    public $hand_1 = array();
    public $hand_2 = array();
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

    public function compareHands($hand_1, $hand_2)
    {

        // if tie (ordered_rank1 == ordered_rank2) // maybe array_intersect
        if ($this->isATie($hand_1, $hand_2)) return "Tie";

        if ($this->sameRank($hand_1, $hand_2)) {

            if ($this->hasDoublePairs($hand_1)) {
                return $this->compareDoublePairs($hand_1, $hand_2);
            }

            if ($this->hasAPair($hand_1)
                || $this->hasTrips($hand_1)
                || $this->hasFullHouse($hand_1)
                || $this->hasPoker($hand_1)) {
                return $this->comparePairTripsFullPoker($hand_1, $hand_2);
            }

            if ($this->hasStraight($hand_1)) {
                return $this->compareStraights($hand_1, $hand_2);
            }

            return ($this->getHighestCardRankInAHand($hand_1)
                > $this->getHighestCardRankInAHand($hand_2) ? $hand_1 : $hand_2);
        }

        if ($this->getHandRank($hand_1) > $this->getHandRank($hand_2)) {
            return $hand_1;
        }

        if ($this->getHandRank($hand_1) < $this->getHandRank($hand_2)) {
            return $hand_2;
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
        } else {
            for ($i=0; $i < 4 ; $i++) {
                if ($cards[$i+1] - $cards[$i] != 1)  {
                    return false;
                }
            }
        }
        return true;

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

    private function hasStraightFlush($cards)
    {
        return $this->hasStraight($cards) && $this->hasFlush($cards);
    }




    public function getHandRank($hand)
    {

        if ($this->hasStraightFlush($hand)) return self::STRAIGHT_FLUSH;
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
        return array_keys($ordered_array);
    }

    private function comparePairTripsFullPoker($hand_1, $hand_2)
    {
        $ranks_1 = $this->getOrderedHandRanks($hand_1);
        $ranks_2 = $this->getOrderedHandRanks($hand_2);

        $top_rank_hand_1 = $ranks_1[0];
        $top_rank_hand_2 = $ranks_2[0];

        if ($top_rank_hand_1 == $top_rank_hand_2) { // only runs in pairs
            array_shift($ranks_1);
            array_shift($ranks_2);
            return (max($ranks_1) > max($ranks_2) ? $hand_1 : $hand_2);
        }

        return ($top_rank_hand_1 > $top_rank_hand_2 ? $hand_1 : $hand_2);
    }

    private function compareDoublePairs($hand_1, $hand_2)
    {

        $ranks_1 = $this->getOrderedHandRanks($hand_1);
        $ranks_2 = $this->getOrderedHandRanks($hand_2);

        $top_pair_rank_1 = $ranks_1[0];
        $top_pair_rank_2 = $ranks_2[0];

        if ($top_pair_rank_1 == $top_pair_rank_2) {

            $second_pair_rank_1 = $ranks_1[1];
            $second_pair_rank_2 = $ranks_2[1];

            if ($second_pair_rank_1 == $second_pair_rank_2) {

                return ($ranks_1[2] > $ranks_2[2] ? $hand_1 : $hand_2);

            }

            return ($second_pair_rank_1 > $second_pair_rank_2 ? $hand_1 : $hand_2);

        }

        return ($top_pair_rank_1 > $top_pair_rank_2 ? $hand_1 : $hand_2);
    }

    private function compareStraights($hand_1, $hand_2)
    {
        $ranks_1 = $this->getOrderedRanks($hand_1);
        $ranks_2 = $this->getOrderedRanks($hand_2);

        $second_rank_from_the_top_1 = $ranks_1[3];
        $second_rank_from_the_top_2 = $ranks_2[3];

        return ($second_rank_from_the_top_1 > $second_rank_from_the_top_2 ? $hand_1 : $hand_2);
    }

    private function sameRank($hand_1, $hand_2)
    {
        return $this->getHandRank($hand_1) == $this->getHandRank($hand_2);
    }

    private function isATie($hand_1, $hand_2)
    {
        return $this->getOrderedRanks($hand_1) == $this->getOrderedRanks($hand_2);
    }
}
