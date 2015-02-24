<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BowlingGameSpec extends ObjectBehavior
{
    function it_can_roll_a_shot()
    {
        $this->roll(0);
    }

    function it_can_play_a_game_with_result_zero()
    {
        $this->rollTimes(20, 0);

        $this->score()->shouldReturn(0);    
    }

    function it_can_play_a_game_with_result_20()
    {
        $this->rollTimes(20, 1);

        $this->score()->shouldReturn(20);
    }       

    function it_plays_a_game_with_a_spare()
    {
        $this->roll(5);
        $this->roll(5); // spare result
        $this->roll(7);

        $this->rollTimes(17, 0);

        $this->score()->shouldReturn(24);
    }

    function it_plays_a_game_with_a_strike()
    {
        $this->roll(10); // strike
        $this->roll(5);
        $this->roll(4);

        $this->rollTimes(17, 0);

        $this->score()->shouldReturn(28);
    }

    function it_plays_a_game_with_rolls_2_3_5_5_7_2_10_5_4_and_11_zeros()
    {
        $this->roll(2);
        $this->roll(3);
        $this->roll(5);
        $this->roll(5);
        $this->roll(7);
        $this->roll(2);
        $this->roll(10);
        $this->roll(5);
        $this->roll(4);

        $this->rollTimes(11, 0);

        $this->score()->shouldReturn(59);        
    }

    function it_scores_a_perfect_game()
    {
        $this->rollTimes(12, 10);
        $this->score()->shouldReturn(300);
    }

    private function rollTimes($num_rolls, $pins)
    {
        for ($i=0; $i<$num_rolls ; $i++) 
        { 
            $this->roll($pins);
        }

    }

}   
