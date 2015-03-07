<?php

namespace Acme;

class Hand
{

    const ACE = 14;
    const LAST_RANK_POSITION = 4;
    const NEXT_TO_LAST_RANK_POSITION = 3;

    private $cards = array();

    public function __construct(array $cards)
    {
        foreach ($cards as $card) {
            $this->cards[] = Card::createFromString($card);
        }
    }

    public function handRanking()
    {
        if ($this->isStraightFlush()) return "straight_flush";
        elseif ($this->isPoker()) return "poker";
        elseif ($this->isFullHouse()) return "full_house";
        elseif ($this->isFlush()) return "flush";
        elseif ($this->isStraight()) return "straight";
        elseif ($this->isTrips()) return "trips";
        elseif ($this->isDoublePairs()) return "double_pairs";
        elseif ($this->isAPair()) return "pair";
        else return "high_card";
    }

    public function isTheSameHand(Hand $other_hand)
    {
        return $this->getOrderedCardRanks() == $other_hand->getOrderedCardRanks();
    }

    public function hasTheSameRanking(Hand $other_hand)
    {
        return $this->handRanking() == $other_hand->handRanking();
    }

    public function isPairedForTopRank(Hand $other_hand)
    {
        return $this->getTopRank() == $other_hand->getTopRank();
    }

    public function isPairedForSecondRank(Hand $other_hand)
    {
        return $this->getSecondRank() == $other_hand->getSecondRank();
    }

    private function getOrderedCardRanks()
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

    private function isDoublePairs()
    {
        return $this->getHandDistribution() == array(2,2,1);
    }

    private function isTrips()
    {
        return $this->getHandDistribution() == array(3,1,1);
    }

    private function isStraight()
    {
        $cards = $this->getOrderedCardRanks();
        if ($cards[self::LAST_RANK_POSITION] == self::ACE) {
            for ($i=0; $i < self::NEXT_TO_LAST_RANK_POSITION ; $i++) {
                if ($cards[$i+1] - $cards[$i] != 1)  {
                    return false;
                }
            }
        } else {
            for ($i=0; $i < self::LAST_RANK_POSITION ; $i++) {
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
