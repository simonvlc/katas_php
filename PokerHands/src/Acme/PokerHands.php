<?php

namespace Acme;

class PokerHands
{

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
        $hand_rank_1 = $this->getHandRank($hand1);
        $hand_rank_2 = $this->getHandRank($hand2);

        if ($hand_rank_1 > $hand_rank_2)
            return $hand1;
        elseif ($hand_rank_1 < $hand_rank_2)
            return $hand2;
        else { // same handRank
            if ($this->getHighestCardRankInAHand($hand1) >
                $this->getHighestCardRankInAHand($hand2))
                return $hand1;
            return $hand2;
        }
    }

    private function getCardRank($card)
    {
        foreach ($this->card_ranks as $key => $value) {
            if (preg_match("/$key/", $card) == true)
                return $value;
        }
    }

    private function getHighestCardRankInAHand($cards)
    {
        $ranked_cards = $this->convertCardsToRanks($cards);
        return max($ranked_cards);
    }

    private function hasAPair($cards)
    {
        if ($this->countPairs($cards) >= 1) {
            return true;
        }
    }

    public function hasDoublePairs($cards)
    {
        if ($this->countPairs($cards) == 2) {
            return true;
        }
    }

    private function hasTrips($cards)
    {
        if ($this->countDifferentRanks($cards) == 3 && $this->countPairs($cards) != 2) {
            return true;
        }
    }

    private function hasStraight($cards)
    {
        // check straight starting in ace
        $ordered_cards = $this->convertCardsToRanks($cards);
        sort($ordered_cards);
        for ($i=0; $i < 4 ; $i++) {
            if ($ordered_cards[$i+1] - $ordered_cards[$i] > 1) return false;
        }
        return true;
    }

    private function hasFlush($cards)
    {
        for ($i=0; $i < 1 ; $i++) {
            for ($j=$i + 1; $j < 5; $j++) {
                if (!$this->sameSuit($cards[$i], $cards[$j])) return false;
            }
        }
        return true;
    }

    private function hasFullHouse($cards)
    {

        if ($this->countDifferentRanks($cards) == 2 && $this->hasAPair($cards)) {
            return true ;
        }

        return false;
    }

    public function hasPoker($cards)
    {
        if ($this->hasOnlyTwoRanks($cards)) {
            return true;
        }
    }

    private function getHandRank($hand)
    {
        if ($this->hasPoker($hand)) return 8;
        if ($this->hasFullHouse($hand)) return 7;
        if ($this->hasFlush($hand)) return 6;
        if ($this->hasStraight($hand)) return 5;
        if ($this->hasTrips($hand)) return 4;
        if ($this->hasDoublePairs($hand)) return 3;
        if ($this->hasAPair($hand)) return 2;
        return 1;
    }

    private function getCardSuit($card)
    {
        return (substr($card, 1, 1));
    }

    private function convertCardsToRanks($cards)
    {
        $result = array();
        foreach ($cards as $card) {
            $result[] = $this->getCardRank($card);
        }
        return $result;
    }

    private function sameSuit($card1, $card2)
    {
        return $this->getCardSuit($card1) == $this->getCardSuit($card2);
    }

    private function sameRank($card1, $card2)
    {
        return $this->getCardRank($card1) == $this->getCardRank($card2);
    }

    private function hasOnlyTwoRanks($cards)
    {
        return count(array_unique($cards)) == 2;
    }

    private function countDifferentRanks($cards)
    {
        $ranked_cards = $this->convertCardsToRanks($cards);
        return count(array_unique($ranked_cards));
    }

    private function countPairs($cards)
    {
        $count = 0;
        for ($i=0; $i < count($cards); $i++) {
            for ($j=$i+1; $j < count($cards); $j++) {
                if ($this->sameRank($cards[$i], $cards[$j])) {
                    $count++;
                }
            }
        }
        return $count;
    }

}
