<?php

namespace Acme;

class Tennis
{
    const PLAYER_A = 0;
    const PLAYER_B = 1;

    protected $score = array(0,0);
    protected $translations = array(
        0 => "Love",
        1 => "Fifteen",
        2 => "Thirty",
        3 => "Forty",
        4 => "Advantage",
        5 => "Winner"
        );

    public function score()
    {

        return $this->translateScore($this->score);

    }

    public function addPointToPlayerA()
    {

        $this->score[self::PLAYER_A] += 1;

    }

    public function addPointToPlayerB()
    {

        $this->score[self::PLAYER_B] += 1;

    }

    private function translateScore($score)
    {

        foreach ($this->translations as $key => $translation) 

        {

            if ($this->score[self::PLAYER_A] == $key) 
            {

                $this->translateScorePlayerA($this->score, $translation);

            }

            if ($this->score[self::PLAYER_B] == $key) 
            {

                $this->translateScorePlayerB($this->score, $translation);

            }
            
            if ($this->score[self::PLAYER_A] == $this->score[self::PLAYER_B])
            {

                $this->translateTie($this->score);

            }


        }

        return $this->score;
    }

    private function translateScorePlayerA($score, $translation)
    {

        $this->score[self::PLAYER_A] = $translation;

    }

    private function translateScorePlayerB($score, $translation)
    {

        $this->score[self::PLAYER_B] = $translation;

    }

    private function translateTie($score)
    {

        if ($this->score[self::PLAYER_A] == 3) // if deuce
        {

            $this->score[self::PLAYER_A] = "Deuce";
            $this->score[self::PLAYER_B] = "";

        }

        else
        {   

            $this->score[self::PLAYER_B] = 'All';

        }   
    }

}
