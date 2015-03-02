<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Hand;

class PokerHandEvaluatorSpec extends ObjectBehavior
{

    private $hand_1;
    private $hand_2;

    function it_compares_two_hands_for_high_card_ace()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "5s", "9c", "Kd"));
        $this->hand_2 = new Hand(array("2c", "3h", "4s", "8c", "Ah"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_high_card_T()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "5s", "9c", "Td"));
        $this->hand_2 = new Hand(array("2c", "3h", "4s", "8c", "9h"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_1);
    }

    function it_compares_two_hands_for_a_pair_win()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "5s", "Ac", "Qd"));
        $this->hand_2 = new Hand(array("2c", "3h", "4s", "Kc", "Kh"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_trips_win()
    {
        $this->hand_1 = new Hand(array("2h", "2d", "3s", "Ac", "5d"));
        $this->hand_2 = new Hand(array("2c", "4h", "4s", "4c", "Ah"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_full_house_win()
    {
        $this->hand_1 = new Hand(array("4h", "4d", "4s", "5c", "5d"));
        $this->hand_2 = new Hand(array("2c", "3c", "4c", "6c", "9c"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_1);
    }

    function it_compares_two_hands_for_poker_win()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "4s", "5c", "6d"));
        $this->hand_2 = new Hand(array("Ac", "Ac", "Ac", "Ac", "3c"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_straight_win()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "4d", "5c", "6d"));
        $this->hand_2 = new Hand(array("2c", "4h", "4s", "4c", "Ah"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_1);
    }

    function it_compares_two_hands_for_straight_starting_in_ace_win()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "6d", "5c", "6d"));
        $this->hand_2 = new Hand(array("Ac", "2h", "3s", "4c", "5h"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_straight_endinf_in_ace_win()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "6d", "5c", "6d"));
        $this->hand_2 = new Hand(array("Tc", "Jh", "Qs", "Kc", "Ah"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_flush_win()
    {
        $this->hand_1 = new Hand(array("2h", "3d", "4d", "5c", "6d"));
        $this->hand_2 = new Hand(array("2c", "3c", "4c", "6c", "9c"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_2);
    }

    function it_compares_two_hands_for_double_pairs_win()
    {
        $this->hand_1 = new Hand(array("2h", "2d", "As", "Ac", "5d"));
        $this->hand_2 = new Hand(array("2c", "3h", "4s", "3c", "Ah"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_1);    }

}
