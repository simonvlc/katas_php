<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Hand;

class PokerHandEvaluatorSpec extends ObjectBehavior
{

    private $h1;
    private $h2;

    function it_compares_two_hands_for_high_card_ace()
    {
        $this->h1 = new Hand(array("2h", "3d", "5s", "9c", "Kd"));
        $this->h2 = new Hand(array("2c", "3h", "4s", "8c", "Ah"));
        $this->beConstructedWith($this->h1, $this->h2);
        $this->compareHands()->shouldReturn($this->h2);
    }

}
