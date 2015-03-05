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

        if ($this->isATie()) return "Tie.";

        if ($this->handsHaveSameRank()) {

            if ($this->hand1->isAGroupedHand()) {
                return $this->compareGroupedHands();
            }

            if ($this->hand1->isDoublePairs()) {
                return $this->compareDoublePairs();
            }

            if ($this->hand1->isStraight()) {
                return $this->compareStraights();
            }

            return $this->hand1->getTopRank()
                > $this->hand2->getTopRank() ? $this->hand1 : $this->hand2;
        }

        return $this->hand1->getHandRank() > $this->hand2->getHandRank()
            ? $this->hand1 : $this->hand2;
    }

    private function handsHaveSameRank()
    {
        return $this->hand1->getHandRank() == $this->hand2->getHandRank();
    }

    private function compareGroupedHands()
    {
        if ($this->hand1->getTopRank() == $this->hand2->getTopRank()) {
            return ($this->hand1->getSecondRank() > $this->hand2->getSecondRank()
                ? $this->hand1 : $this->hand2);
        }
        return ($this->hand1->getTopRank()
            > $this->hand2->getTopRank() ? $this->hand1 : $this->hand2);
    }

    private function compareDoublePairs()
    {
        if ($this->hand1->getTopRank() == $this->hand2->getTopRank()) {
            if ($this->hand1->getSecondRank() == $this->hand2->getSecondRank()) {
                return ($this->hand1->getThirdRank()
                    > $this->hand2->getThirdRank() ? $this->hand1 : $this->hand2);
            }
            return ($this->hand1->getSecondRank()
                > $this->hand2->getSecondRank() ? $this->hand1 : $this->hand2);
        }
        return ($this->hand1->getSecondRank()
            > $this->hand2->getSecondRank() ? $this->hand1 : $this->hand2);
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

}
