<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalcStatsSpec extends ObjectBehavior
{

    function it_returns_the_minimum_value_given_an_array_of_numbers()
    {
        $this->minimun(array(1,2,3,4))->shouldReturn(1);
    }

    function it_returns_the_maximum_value_given_an_array_of_numbers()
    {
        $this->maximum(array(1,2,3,4))->shouldReturn(4);
    }

    function it_returns_the_number_of_elements_in_the_sequence()
    {
        $this->countElements(array(1,2,3,4))->shouldReturn(4);
    }

    function it_returns_the_average_value_of_the_sequence()
    {
        $this->average(array(1,2,3,4))->shouldReturn(2.5);
    }
}
