<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringCalculatorSpec extends ObjectBehavior
{

    function it_adds_an_empty_string_to_zero()
    {
        $this->add('')->shouldEqual(0);
    }

    function it_adds_a_string_1_for_1()
    {
        $this->add('1')->shouldEqual(1);
    }

    function it_adds_two_strings_1_and_2_for_3()
    {
        $this->add('1,2')->shouldEqual(3);
    }

    function it_adds_three_strings_1_2_3_for_6()
    {
        $this->add('1,2,3')->shouldEqual(6);
    }

    function it_should_ignore_numbers_greater_than_1000()
    {
        $this->add('1,2,1000')->shouldEqual(3);
    }

    function it_should_throw_an_exception_if_we_add_a_negative_number()
    {
        $this->shouldThrow('\Exception')->duringAdd('1,-2,3');
    }

}