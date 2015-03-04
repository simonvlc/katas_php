<?php

namespace Acme;

class PokerHandEvaluator
{
    private $h1;
    private $h2;

    public function __construct(Hand $h1, Hand $h2)
    {
        $this->h1 = $h1;
        $this->h2 = $h2;
    }

    public function compareHands()
    {

        if ($this->isATie()) return "Tie.";

        if ($this->equalHandRank()) {

            if ($this->h1->isAGroupedHand()) {
                return $this->compareGroupedHands();
            }

            if ($this->h1->isDoublePairs()) {
                return $this->compareDoublePairs();
            }

            if ($this->h1->isStraight()) {
                return $this->compareStraights();
            }

            return $this->h1->getHighestRankInHand()
                > $this->h2->getHighestRankInHand() ? $this->h1 : $this->h2;
        }

        return $this->h1->getHandRank() > $this->h2->getHandRank()
            ? $this->h1 : $this->h2;
    }

    private function equalHandRank()
    {
        return $this->h1->getHandRank() == $this->h2->getHandRank();
    }

    private function compareGroupedHands()
    {
        if ($this->h1->getTopRank() == $this->h2->getTopRank()) {
            return ($this->h1->getSecondRank() > $this->h2->getSecondRank()
                ? $this->h1 : $this->h2);
        }
        return ($this->h1->getTopRank()
            > $this->h2->getTopRank() ? $this->h1 : $this->h2);
    }

    private function compareDoublePairs()
    {
        if ($this->h1->getTopRank() == $this->h2->getTopRank()) {
            if ($this->h1->getSecondRank() == $this->h2->getSecondRank()) {
                return ($this->h1->getThirdRank()
                    > $this->h2->getThirdRank() ? $this->h1 : $this->h2);
            }
            return ($this->h1->getSecondRank()
                > $this->h2->getSecondRank() ? $this->h1 : $this->h2);
        }
        return ($this->h1->getSecondRank()
            > $this->h2->getSecondRank() ? $this->h1 : $this->h2);
    }

    private function compareStraights()
    {
        return ($this->h1->getSecondRank()
            > $this->h2->getSecondRank() ? $this->h1 : $this->h2);
    }

    private function isATie()
    {
        return $this->h1->getOrderedRanks() == $this->h2->getOrderedRanks();
    }

}
