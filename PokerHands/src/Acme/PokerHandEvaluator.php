<?php

namespace Acme;

class PokerHandEvaluator
{
    const HIGH_CARD = 1;
    const PAIR = 2;
    const DOUBLE_PAIR = 3;
    const TRIPS = 4;
    const STRAIGHT = 5;
    const FLUSH = 6;
    const FULL_HOUSE = 7;
    const POKER = 8;
    const STRAIGHT_FLUSH = 9;

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

        if ($this->handsHaveSameRanking()) {
            return $this->compareHandsWithTheSameRank();
        }

        return $this->handWithTheHighestRanking();
    }

    private function computeHandRanking(Hand $hand)
    {
        if ($hand->isStraightFlush()) return self::STRAIGHT_FLUSH;
        elseif ($hand->isPoker()) return self::POKER;
        elseif ($hand->isFullHouse()) return self::FULL_HOUSE;
        elseif ($hand->isFlush()) return self::FLUSH;
        elseif ($hand->isStraight()) return self::STRAIGHT;
        elseif ($hand->isTrips()) return self::TRIPS;
        elseif ($hand->isDoublePairs()) return self::DOUBLE_PAIR;
        elseif ($hand->isAPair()) return self::PAIR;
        else return self::HIGH_CARD;
    }

    private function handsHaveSameRanking()
    {
        return $this->computeHandRanking($this->hand1)
            == $this->computeHandRanking($this->hand2);
    }

    private function compareHandsWithTheSameRank()
    {
        switch ($this->computeHandRanking($this->hand1)) {
            case self::PAIR:
            case self::TRIPS:
            case self::FULL_HOUSE:
            case self::POKER:
                return $this->compareGroupedHands();
                break;
            case self::DOUBLE_PAIR:
                return $this->compareDoublePairs();
                break;
            case self::STRAIGHT:
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

    private function handWithTheHighestRanking()
    {
        return ($this->computeHandRanking($this->hand1)
            > $this->computeHandRanking($this->hand2)
            ? $this->hand1 : $this->hand2);
    }
}
