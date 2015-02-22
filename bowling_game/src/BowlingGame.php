<?php

class BowlingGame
{

    protected $score = 0;

    protected $rolls = array();

    public function roll($roll)
    {
        $this->rolls[] = $roll;
    }

    public function score()
    {
        $index = 0;
        $score = 0;

        for ($frame = 1; $frame <= 10 ; $frame++) {             

            if ($this->isStrike($index)) // strike
            {   
                $score += 10 + $this->strikeBonus($index);
                $index += 1;
            }

            elseif ($this->isSpare($index)) // spare
            {
                $score += 10 + $this->spareBonus($index);
                $index += 2;
            }

            else 
            {
                $score += $this->defaultScore($index);
                $index += 2;
            }

        }

        return $score;        
    }

    private function isStrike($index)
    {
        if ($this->rolls[$index] == 10) return true;
    }

    private function isSpare($index)
    {
        if ($this->rolls[$index] + $this->rolls[$index + 1] == 10) return true;
    }

    private function defaultScore($index)
    {
        return $this->rolls[$index] + $this->rolls[$index + 1];
    }

    private function spareBonus($index)
    {
        return $this->rolls[$index + 2];
    }

    private function strikeBonus($index)
    {
        return $this->rolls[$index + 1] + $this->rolls[$index + 2];
    }

}
