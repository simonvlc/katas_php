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
                return $this->highestGroupedHand();
                break;
            case self::DOUBLE_PAIR:
                return $this->highestDoublePairHand();
                break;
            case self::STRAIGHT:
                return $this->highestStraightHand();
                break;
            default:
                return $this->highestRegularHand();
                break;
        }
    }

    private function highestGroupedHand()
    {
        if ($this->isPairedForTopRank()) {
            return $this->hand1->compareSecondRank($this->hand2);
        }
        return $this->hand1->compareTopRank($this->hand2);
    }

    private function highestDoublePairHand()
    {
        if ($this->isPairedForTopRank()) {
            if ($this->isPairedForSecondRank()) {
                return $this->hand1->compareThirdRank($this->hand2);
            } else {
                return $this->hand1->compareSecondRank($this->hand2);
            }
        } else {
            return $this->hand1->compareTopRank($this->hand2);
        }
    }

    private function highestStraightHand()
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

    private function highestRegularHand()
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
