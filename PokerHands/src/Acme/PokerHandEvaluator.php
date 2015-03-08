<?php

namespace Acme;

class PokerHandEvaluator
{
    private $hand1;
    private $hand2;
    private $hand_rankings_to_value_lookup = array(
        "high_card" => 1,
        "pair" => 2,
        "double_pairs" => 3,
        "trips" => 4,
        "straight" => 5,
        "flush" => 6,
        "full_house" => 7,
        "poker" => 8,
        "straight_flush" => 9
    );

    public function __construct(Hand $hand1, Hand $hand2)
    {
        $this->hand1 = $hand1;
        $this->hand2 = $hand2;
    }

    public function compareHands()
    {
        if ($this->isATie()) {
            return "Tie.";
        }

        if ($this->handsHaveSameRank()) {
            return $this->compareHandsWithTheSameRank();
        }

        return $this->getBestHand();
    }

    private function handsHaveSameRank()
    {
        return $this->hand1->getHandRanking() == $this->hand2->getHandRanking();
    }

    private function compareHandsWithTheSameRank()
    {
        switch ($this->hand1->getHandRanking()) {
            case 'pair':
            case 'trips':
            case 'full_house':
            case 'poker':
                return $this->compareGroupedHands();
                break;
            case 'double_pairs':
                return $this->compareDoublePairs();
                break;
            case 'straight':
                return $this->compareStraights();
                break;
            default:
                return $this->hand1->compareTopRank($this->hand2);
                break;
        }
    }

    private function compareGroupedHands()
    {
        if ($this->isPairedForTopRank()) {
            return $this->getHandWithTheHighestSecondRank();
        }
        return $this->compareRegularHands();
    }

    private function compareDoublePairs()
    {
        if ($this->isPairedForTopRank()) {
            if ($this->isPairedForSecondRank()) {
                return $this->getHandWithTheHighestKicker();
            } else {
                return $this->getHandWithTheHighestSecondRank();
            }
        } else {
            return $this->compareRegularHands();
        }
    }

    private function compareStraights()
    {
        return $this->hand1->compareSecondRank($this->hand2);
    }

    private function isATie()
    {
        return $this->hand1->isTied($this->hand2);
    }

    private function isPairedForTopRank()
    {
        return $this->hand1->hasTheSameTopRank($this->hand2);
    }

    private function isPairedForSecondRank()
    {
        return $this->hand1->hasTheSameSecondRank($this->hand2);
    }

    private function getHandWithTheHighestKicker()
    {
        return $this->hand1->compareThirdRank($this->hand2);
    }

    private function getHandWithTheHighestSecondRank()
    {
        return $this->hand1->compareSecondRank($this->hand2);
    }

    private function compareRegularHands()
    {
        return $this->hand1->compareTopRank($this->hand2);
    }

    private function getBestHand()
    {
        return ($this->hand_rankings_to_value_lookup[$this->hand1->getHandRanking()]
            > $this->hand_rankings_to_value_lookup[$this->hand2->getHandRanking()]
            ? $this->hand1 : $this->hand2);
    }
}
