<?php

namespace Acme;

class Tennis
{
    private $player1;

    private $player2;

    private $lookup = array(
        0 => "Love",
        1 => "Fifteen",
        2 => "Thirty",
        3 => "Forty"
        );

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function score()
    {

        if ($this->someoneAlreadyWon())
            return $this->leadingPlayerName() . " wins the match";

        if ($this->someoneHasAdvantage())
            return $this->leadingPlayerName() . " has the advantage";

        if ($this->gameIsInDeuce())
            return "Deuce";

        if ($this->gameIsTied())
            return $this->lookup[$this->player1->points] . "-All";

        return $this->regularScore();

    }

    private function gameIsTied()
    {
        return $this->player1->points == $this->player2->points;
    }

    private function gameIsInDeuce()
    {
        return $this->sixOrMorePointsScored() && $this->gameIsTied();
    }

    private function regularScore()
    {
        return $this->lookup[$this->player1->points] . "-" .
            $this->lookup[$this->player2->points];
    }

    private function sixOrMorePointsScored()
    {
        return $this->player1->points + $this->player2->points >= 6;
    }

    private function someoneAlreadyWon()
    {
        return (max($this->player1->points, $this->player2->points) >= 4 &&
            $this->isSomeoneLeading() >= 2);
    }

    private function isSomeoneLeading()
    {
        return abs($this->player1->points - $this->player2->points);
    }

    private function leadingPlayerName()
    {
        return ($this->player1->points > $this->player2->points ?
            $this->player1->name : $this->player2->name);
    }

    private function someoneHasAdvantage()
    {
        return $this->sixOrMorePointsScored() && $this->isSomeoneLeading();
    }
}