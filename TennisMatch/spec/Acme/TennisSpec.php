<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Player;

class TennisSpec extends ObjectBehavior
{

    protected $john;
    protected $jane;

    function let()
    {
        $this->john = new Player("John Doe", 0);
        $this->jane = new Player("Jane Doe", 0);

        $this->beConstructedWith($this->john, $this->jane);
    } 

    function it_returns_a_scoreless_match()
    {
        $this->score()->shouldReturn("Love-All");
    }

    function it_returns_fifteen_love_for_a_1_0_match()
    {
        $this->john->earnPoints(1);
        $this->score()->shouldReturn("Fifteen-Love");
    }

    function it_returns_thirty_love_for_2_0_match()
    {
        $this->john->earnPoints(2);
        $this->score()->shouldReturn("Thirty-Love");
    }

    function it_returns_forty_love_for_3_0_match()
    {
        $this->john->earnPoints(3);
        $this->score()->shouldReturn("Forty-Love");
    }

    function it_returns_fifteen_all_for_a_1_1_match()
    {
        $this->john->earnPoints(1);
        $this->jane->earnPoints(1);
        $this->score()->shouldReturn("Fifteen-All");
    }

    function it_returns_a_winner_for_4_0_match()
    {
        $this->john->earnPoints(4);
        $this->score()->shouldReturn("John Doe wins the match");
    }

    function it_returns_a_winner_for_0_4_match()
    {
        $this->jane->earnPoints(4);
        $this->score()->shouldReturn("Jane Doe wins the match");
    }

    function it_returns_a_deuce_for_3_3_match()
    {
        $this->john->earnPoints(3);
        $this->jane->earnPoints(3);
        $this->score()->shouldReturn("Deuce");
    }

    function it_returns_an_advantage_for_4_3_match()
    {
        $this->john->earnPoints(4);
        $this->jane->earnPoints(3);
        $this->score()->shouldReturn("John Doe has the advantage");
    }

    function it_returns_an_advantage_for_3_4_match()
    {
        $this->john->earnPoints(3);
        $this->jane->earnPoints(4);
        $this->score()->shouldReturn("Jane Doe has the advantage");
    }

    function it_returns_deuce_for_6_6_match()
    {
        $this->john->earnPoints(4);
        $this->jane->earnPoints(4);
        $this->score()->shouldReturn("Deuce");
    }

    function it_returns_advantage_for_a_7_6_match()
    {
        $this->john->earnPoints(7);
        $this->jane->earnPoints(6);
        $this->score()->shouldReturn("John Doe has the advantage");
    }

    function it_returns_a_winner_for_a_8_6_match()
    {
        $this->john->earnPoints(8);
        $this->jane->earnPoints(6);
        $this->score()->shouldReturn("John Doe wins the match");
    }
}
