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

    function it_compares_two_hands_for_straight_ending_in_ace_win()
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
        $this->compareHands()->shouldReturn($this->hand_1);
    }

    function it_compares_two_hands_with_a_pair_each() {
        $this->hand_1 = new Hand(array("2h", "3d", "As", "Kc", "Kd"));
        $this->hand_2 = new Hand(array("Qc", "Qh", "Ac", "Kc", "3c"));
        $this->beConstructedWith($this->hand_1, $this->hand_2);
        $this->compareHands()->shouldReturn($this->hand_1);
    }

//     function it_compares_two_hands_with_an_equal_pair_each()
//     {
//         $this->hand_1 = new Hand(array("2h", "3d", "Ks", "Qs", "Qd"));
//         $this->hand_2 = new Hand(array("Qc", "Qh", "7c", "2c", "3c"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_1);
//     }

//     function it_compares_two_hands_with_an_equal_pair_as_a_tie()
//     {
//         $this->hand_1 = new Hand(array("2h", "3d", "Ks", "Qs", "Qd"));
//         $this->hand_2 = new Hand(array("2d", "3h", "Kc", "Qh", "Qc"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn("Tie"));
//     }

//     function it_compares_two_trips()
//     {
//         $this->hand_1 = new Hand(array("2d", "3h", "Kc", "Kh", "Kc"));
//         $this->hand_2 = new Hand(array("Ah", "3d", "Qs", "Qs", "Qd"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_1);
//     }

//     function it_compares_two_full_houses()
//     {
//         $this->hand_1 = new Hand(array("2d", "2h", "Kc", "Kh", "Kc"));
//         $this->hand_2 = new Hand(array("Ah", "Ad", "Qs", "Qs", "Qd"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_1);
//     }

//     function it_compares_two_four_of_a_kind()
//     {
//         $this->hand_1 = new Hand(array("Kd", "Kh", "Kc", "Kh", "Tc"));
//         $this->hand_2 = new Hand(array("Ah", "Ad", "As", "As", "3d"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_2);
//     }

//     function it_compares_two_flushes()
//     {
//         $this->hand_1 = new Hand(array("2c", "3c", "4c", "6c", "7c"));
//         $this->hand_2 = new Hand(array("8c", "Jc", "Qc", "Kc", "Ac"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_2);
//     }

//     function it_compares_two_straights()
//     {
//         $this->hand_1 = new Hand(array("Ah", "2h", "3c", "4c", "5c"));
//         $this->hand_2 = new Hand(array("9c", "Th", "Jc", "Qc", "Kc"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_2);
//     }

//     function it_compares_two_hands_for_straight_flush_win()
//     {
//         $this->hand_1 = new Hand(array("2h", "3h", "4h", "5h", "6h"));
//         $this->hand_2 = new Hand(array("Ac", "Ah", "Ac", "Ac", "Kc"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_1);
//     }

//     function it_compares_two_double_pair_hands()
//     {
//         $this->hand_1 = new Hand(array("2h", "2h", "4h", "4d", "Kh"));
//         $this->hand_2 = new Hand(array("3c", "3h", "5c", "5c", "6c"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_2);
//     }

//     function it_compares_two_equal_double_pair_hands_winning_high_card()
//     {
//         $this->hand_1 = new Hand(array("2s", "2d", "4s", "4d", "Kh"));
//         $this->hand_2 = new Hand(array("2c", "2h", "4c", "4h", "6c"));
//         $this->compareHands($this->hand_1, $this->hand_2)->shouldReturn($this->hand_1);
//     }

}
