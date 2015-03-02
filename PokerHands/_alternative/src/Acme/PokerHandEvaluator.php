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

        if ($this->equalHandRank()) {
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

}
