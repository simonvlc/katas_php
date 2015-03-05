<?php

namespace Acme;

class PokerHandEvaluator
{
    private $hand1;
    private $hand2;

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
        return $this->hand1->getHandRank() == $this->hand2->getHandRank();
    }

    private function compareHandsWithTheSameRank()
    {
        if ($this->hand1->isAGroupedHand()) {
            return $this->compareGroupedHands();
        }

        if ($this->hand1->isDoublePairs()) {
            return $this->compareDoublePairs();
        }

        if ($this->hand1->isStraight()) {
            return $this->compareStraights();
        }

        return $this->getHandWithTheHighestRank();
    }

    private function compareGroupedHands()
    {
        if ($this->isPairedForTopRank()) {
            return $this->getHandWithTheHighestSecondRank();
        }
        return $this->getHandWithTheHighestRank();
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
            return $this->getHandWithTheHighestRank();
        }
    }

    private function compareStraights()
    {
        return ($this->hand1->getSecondRank()
            > $this->hand2->getSecondRank() ? $this->hand1 : $this->hand2);
    }

    private function isATie()
    {
        return $this->hand1->getOrderedRanks() == $this->hand2->getOrderedRanks();
    }

    private function isPairedForTopRank()
    {
        return $this->hand1->getTopRank() == $this->hand2->getTopRank();
    }

    private function isPairedForSecondRank()
    {
        return $this->hand1->getSecondRank() == $this->hand2->getSecondRank();
    }

    private function getHandWithTheHighestKicker()
    {
        return ($this->hand1->getThirdRank() > $this->hand2->getThirdRank()
            ? $this->hand1 : $this->hand2);
    }

    private function getHandWithTheHighestSecondRank()
    {
        return ($this->hand1->getSecondRank()
                > $this->hand2->getSecondRank() ? $this->hand1 : $this->hand2);
    }

    private function getHandWithTheHighestRank()
    {
        return ($this->hand1->getTopRank()
            > $this->hand2->getTopRank() ? $this->hand1 : $this->hand2);
    }

    private function getBestHand()
    {
        return ($this->hand1->getHandRank() > $this->hand2->getHandRank()
            ? $this->hand1 : $this->hand2);
    }
}
