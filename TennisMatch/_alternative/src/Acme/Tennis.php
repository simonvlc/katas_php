<?php

namespace Acme;

class Tennis
{

    private $player1_score = 0;
    private $player2_score = 0;

    private $player1_name = "Player 1";
    private $player2_name = "Player 2";

    private $translations = array(
        0 => "Love",
        1 => "Fifteen",
        2 => "Thirty",
        3 => "Forty"
        );

    public function score()
    {

        if ($this->someoneHasWon()) {
            return $this->leadingPlayerName() . " won";
        }

        if ($this->someoneHasAdvantage()) {
            return $this->leadingPlayerName() . " advantage";
        }

        if ($this->gameInDeuce()) {
            return "Deuce";
        }

        if ($this->gameIsTied()) {
            return $this->translations[$this->player1_score] . "-All";
        }

        return $this->gameScore();

    }

    public function player1Scores()
    {
        $this->player1_score ++;
    }

    public function player2Scores()
    {
        $this->player2_score ++;
    }

    private function gameIsTied()
    {
        return $this->player1_score == $this->player2_score;
    }

    private function gameInDeuce()
    {
        return $this->gameIsTied() && $this->sixOrMorePointsScored();
    }

    private function someoneHasAdvantage()
    {
        return $this->sixOrMorePointsScored() && $this->someoneIsLeading();
    }

    private function someoneHasWon()
    {
        return $this->someoneHasScoredFourPointsOrMore()
            && $this->someoneLeadsByTwo();
    }

    private function gameScore() {
        return $this->translations[$this->player1_score] . "-" .
            $this->translations[$this->player2_score];
    }

    private function leadingPlayerName()
    {
        if ($this->player1_score > $this->player2_score) {
            return $this->player1_name;
        }
        else if ($this->player2_score > $this->player1_score) {
            return $this->player2_name;
        }
    }

    private function sixOrMorePointsScored()
    {
        return $this->player1_score + $this->player2_score >= 6;
    }

    private function someoneIsLeading()
    {
        return abs($this->player1_score - $this->player2_score) != 0;
    }

    private function someoneHasScoredFourPointsOrMore()
    {
        return max($this->player1_score, $this->player2_score) >= 4;
    }

    private function someoneLeadsByTwo()
    {
        return abs($this->player1_score - $this->player2_score) >= 2;
    }
}