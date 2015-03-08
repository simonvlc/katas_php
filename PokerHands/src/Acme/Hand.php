<?php

namespace Acme;

class Hand
{

    const ACE = 14;
    const LAST_RANK_IN_HAND = 4;
    const NEXT_TO_LAST_RANK_IN_HAND = 3;

    private $cards = array();

    public function __construct(array $cards)
    {
        foreach ($cards as $card) {
            $this->cards[] = Card::createFromString($card);
        }
    }

    public function isTied(Hand $other_hand)
    {
        return $this->orderedCardRanksInHand() == $other_hand->orderedCardRanksInHand();
    }

    public function hasTheSameTopRank(Hand $other_hand)
    {
        return $this->getTopRank() == $other_hand->getTopRank();
    }

    public function hasTheSameSecondRank(Hand $other_hand)
    {
        return $this->getSecondRank() == $other_hand->getSecondRank();
    }

    public function compareTopRank(Hand $other_hand)
    {
        return ($this->getTopRank() > $other_hand->getTopRank()
            ? $this : $other_hand);
    }

    public function compareSecondRank(Hand $other_hand)
    {
        return ($this->getSecondRank() > $other_hand->getSecondRank()
            ? $this : $other_hand);
    }

    public function compareThirdRank(Hand $other_hand)
    {
        return ($this->getThirdRank() > $other_hand->getThirdRank()
            ? $this : $other_hand);
    }

    private function orderedCardRanksInHand()
    {
        foreach ($this->cards as $card) {
            $result[] = $card->getCardRank();
        }
        sort($result);
        return $result;
    }

    public function isAPair()
    {
        return $this->getHandDistribution() == array(2,1,1,1);
    }

    public function isDoublePairs()
    {
        return $this->getHandDistribution() == array(2,2,1);
    }

    public function isTrips()
    {
        return $this->getHandDistribution() == array(3,1,1);
    }

    public function isStraight()
    {
        $cards = $this->orderedCardRanksInHand();
        if ($cards[self::LAST_RANK_IN_HAND] == self::ACE) {
            for ($i=0; $i < self::NEXT_TO_LAST_RANK_IN_HAND ; $i++) {
                if ($cards[$i+1] - $cards[$i] != 1)  {
                    return false;
                }
            }
        } else {
            for ($i=0; $i < self::LAST_RANK_IN_HAND ; $i++) {
                if ($cards[$i+1] - $cards[$i] != 1)  {
                    return false;
                }
            }
        }
        return true;
    }

    public function isFlush()
    {
        foreach ($this->cards as $card) {
            $result[] = $card->getSuit();
        }
        return (count(array_unique($result))) == 1;
    }

    public function isFullHouse()
    {
        return $this->getHandDistribution() == array(3,2);
    }
    public function isPoker()
    {
        return $this->getHandDistribution() == array(4,1);
    }

    public function isStraightFlush()
    {
        return $this->isStraight() && $this->isFlush();
    }

    private function getHandDistribution()
    {
        $ranks = array_count_values($this->orderedCardRanksInHand());
        arsort($ranks);
        return array_values($ranks);
    }

    private function getDistributedRanksInHand()
    {
        $ranks = array_count_values($this->orderedCardRanksInHand());
        arsort($ranks);
        return array_keys($ranks);
    }

    private function getTopRank()
    {
        $ranks = $this->getDistributedRanksInHand();
        return $ranks[0];
    }

    private function getSecondRank()
    {
        $ranks = $this->getDistributedRanksInHand();
        return $ranks[1];
    }

    private function getThirdRank()
    {
        $ranks = $this->getDistributedRanksInHand();
        return $ranks[2];
    }
}
