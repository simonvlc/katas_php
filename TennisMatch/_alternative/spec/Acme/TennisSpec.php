<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TennisSpec extends ObjectBehavior
{
    function it_should_return_a_scoreless_game()
    {
        $this->score()->shouldReturn("Love-All");
    }

    function it_should_return_a_fifteen_love_score()
    {
        $this->player1Scores();
        $this->score()->shouldReturn("Fifteen-Love");
    }

    function it_should_returns_a_fifteen_all_score()
    {
        $this->tieScoreAt(1);
        $this->score()->shouldReturn("Fifteen-All");
    }

    function it_should_returns_deuce_for_a_forty_forty_game()
    {
        $this->tieScoreAt(3);
        $this->score()->shouldReturn("Deuce");
    }

    function it_should_returns_an_advantage()
    {
        $this->tieScoreAt(3);
        $this->player1Scores();
        $this->score()->shouldReturn("Player 1 advantage");
    }

    function it_should_returns_a_player1_win()
    {
        $this->tieScoreAt(3);
        $this->player1Scores();
        $this->player1Scores();
        $this->score()->shouldReturn("Player 1 won");
    }

    private function tieScoreAt($number)
    {
        for ($i=0; $i < $number; $i++) {
            $this->player1Scores();
            $this->player2Scores();
        }
    }

}
