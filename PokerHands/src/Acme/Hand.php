<?php

namespace Acme;

class Hand
{
    const HIGH_CARD = 1;
    const PAIR = 2;
    const DOUBLE_PAIRS = 3;
    const TRIPS = 4;
    const STRAIGHT = 5;
    const FLUSH = 6;
    const FULL = 7;
    const POKER = 8;
    const STRAIGHT_FLUSH = 9;
    const ACE = 14;

    private $cards = array();

    public function __construct(array $cards)
    {
        foreach ($cards as $card) {
            $this->cards[] = Card::createFromString($card);
        }
    }

    public function getHandRanking()
    {
        if ($this->isStraightFlush()) return self::STRAIGHT_FLUSH;
        if ($this->isPoker()) return self::POKER;
        if ($this->isFullHouse()) return self::FULL;
        if ($this->isFlush()) return self::FLUSH;
        if ($this->isStraight()) return self::STRAIGHT;
        if ($this->isTrips()) return self::TRIPS;
        if ($this->isDoublePairs()) return self::DOUBLE_PAIRS;
        if ($this->isAPair()) return self::PAIR;
        return self::HIGH_CARD;
    }

    public function getOrderedCardRanks()
    {
        foreach ($this->cards as $card) {
            $result[] = $card->getCardRank();
        }
        sort($result);
        return $result;
    }

    private function isAPair()
    {
        return $this->getHandDistribution() == array(2,1,1,1);
    }

    public function isDoublePairs()
    {
        return $this->getHandDistribution() == array(2,2,1);
    }

    private function isTrips()
    {
        return $this->getHandDistribution() == array(3,1,1);
    }

    public function isStraight()
    {
        $cards = $this->getOrderedCardRanks();
        if ($cards[4] == self::ACE) {
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

    private function isFlush()
    {
        foreach ($this->cards as $card) {
            $result[] = $card->getSuit();
        }
        return (count(array_unique($result))) == 1;
    }

    private function isFullHouse()
    {
        return $this->getHandDistribution() == array(3,2);
    }
    private function isPoker()
    {
        return $this->getHandDistribution() == array(4,1);
    }

    private function isStraightFlush()
    {
        return $this->isStraight() && $this->isFlush();
    }


    public function isAGroupedHand()
    {
        return ($this->isAPair() || $this->isTrips()
            || $this->isFullHouse() || $this->isPoker());
    }

    private function getHandDistribution()
    {
        $ranks = array_count_values($this->getOrderedCardRanks());
        arsort($ranks);
        return array_values($ranks);
    }

    private function getDistributedRanksInHand()
    {
        $ranks = array_count_values($this->getOrderedCardRanks());
        arsort($ranks);
        return array_keys($ranks);
    }

    public function getTopRank()
    {
        $ranks = $this->getDistributedRanksInHand();
        return $ranks[0];
    }

    public function getSecondRank()
    {
        $ranks = $this->getDistributedRanksInHand();
        return $ranks[1];
    }

    public function getThirdRank()
    {
        $ranks = $this->getDistributedRanksInHand();
        return $ranks[2];
    }
}
