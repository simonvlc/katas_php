<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TennisSpec extends ObjectBehavior
{
    function it_is_able_to_store_a_tennis_score()
    {
        $this->Score(0,0)->shouldReturn(array("Love","All"));
    }

    function it_assigns_a_point_to_player_A()
    {
        $this->addPointToPlayerA();
       
        $this->Score()->shouldReturn(array("Fifteen","Love"));
    }

    function it_assigns_a_point_to_player_B()
    {
        $this->addPointToPlayerB();
       
        $this->Score()->shouldReturn(array("Love","Fifteen"));
    }

    function it_returns_fifteen_all_for_a_15_15()
    {
        $this->addPointToPlayerA();
        $this->addPointToPlayerB();
       
        $this->Score()->shouldReturn(array("Fifteen", "All"));
    }

    function it_returns_thirty_all_for_a_30_30()
    {
        $this->addPointToPlayerA();
        $this->addPointToPlayerA();
        $this->addPointToPlayerB();
        $this->addPointToPlayerB();
        
        $this->Score()->shouldReturn(array("Thirty", "All"));
    }

    function it_returns_deuce_for_40_40()
    {
        for ($i=0; $i < 3 ; $i++) 
        { 
            $this->addPointToPlayerA();
            $this->addPointToPlayerB();
        }

        $this->Score()->shouldReturn(array("Deuce", ""));
    }

    function it_returns_advantage()
    {
        for ($i=0; $i < 3 ; $i++) 
        { 
            $this->addPointToPlayerA();
            $this->addPointToPlayerB();
        }

        $this->addPointToPlayerA();

        $this->Score()->shouldReturn(array("Advantage", "Thirty"));
    }
}
