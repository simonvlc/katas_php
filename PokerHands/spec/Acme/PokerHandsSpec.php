<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PokerHandsSpec extends ObjectBehavior
{
    function it_calculates_a_rank_for_an_ace()
    {
        $this->getCardRank("Ah")->shouldEqual(14);
    }

    function it_calculates_a_rank_for_a_king()
    {
        $this->getCardRank("Kd")->shouldEqual(13);
    }

    function it_calculates_a_rank_for_a_3()
    {
        $this->getCardRank('3s')->shouldEqual(3);
    }

    function it_calculates_a_rank_for_a_2()
    {
        $this->getCardRank("2s")->shouldEqual(2);
    }

    function it_compares_two_hands_for_high_card_ace()
    {
        $this->hand1 = array("2h", "3d", "5s", "9c", "Kd");
        $this->hand2 = array("2c", "3h", "4s", "8c", "Ah");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand2);
    }

    function it_compares_two_hands_for_high_card_10()
    {
        $this->hand1 = array("2h", "3d", "5s", "9c", "10d");
        $this->hand2 = array("2c", "3h", "4s", "8c", "9h");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand1);
    }


    function it_compares_two_hands_for_a_pair_win()
    {
        $this->hand1 = array("2h", "3d", "5s", "Ac", "Qd");
        $this->hand2 = array("2c", "3h", "4s", "Kc", "Kh");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand2);
    }

    // function it_compares_two_hands_with_a_pair_each_hand()
    // {
    //     $this->hand1 = array("2h", "3d", "5s", "Kc", "Kd");
    //     $this->hand2 = array("2c", "3h", "4s", "Ac", "Ah");
    //     $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand1);
    // }

    function it_compares_two_hands_for_double_pairs_win()
    {
        $this->hand1 = array("2h", "2d", "As", "Ac", "5d");
        $this->hand2 = array("2c", "3h", "4s", "3c", "Ah");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand1);
    }

    function it_compares_two_hands_for_trips_win()
    {
        $this->hand1 = array("2h", "2d", "3s", "Ac", "5d");
        $this->hand2 = array("2c", "4h", "4s", "4c", "Ah");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand2);
    }

    function it_compares_two_hands_for_straight_win()
    {
        $this->hand1 = array("2h", "3d", "4d", "5c", "6d");
        $this->hand2 = array("2c", "4h", "4s", "4c", "Ah");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand1);
    }

    function it_compares_two_hands_for_flush_win()
    {
        $this->hand1 = array("2h", "3d", "4d", "5c", "6d");
        $this->hand2 = array("2c", "3c", "4c", "6c", "9c");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand2);
    }

    function it_compares_two_hands_for_full_house_win()
    {
        $this->hand1 = array("4h", "4d", "4s", "5c", "5d");
        $this->hand2 = array("2c", "3c", "4c", "6c", "9c");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand1);
    }

    function it_compares_two_hands_for_poker_win()
    {
        $this->hand1 = array("2h", "3d", "4s", "5c", "6d");
        $this->hand2 = array("Ac", "Ac", "Ac", "Ac", "3c");
        $this->compareHands($this->hand1, $this->hand2)->shouldReturn($this->hand2);
    }

    // function it_compares_two_pairs_and_wins_the_highest_one()
    // function it_compares_two_equal_pairs_and_wins_the_highest_card()
    // function it_compares_two_double_pairs_and_wins_the_highest_one()
    // function it_compares_two_equal_double_pairs_and_wins_the_highest_card()
    // function it_compares_two_trips_and_wins_the_highest_one()
    // function it_compares_tow_straights_and_wins_the_highest_one()
    // function it_compares_two_flushes_and_wins_the_one_with_the_high_card()


}