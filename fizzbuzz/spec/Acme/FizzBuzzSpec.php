<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FizzBuzzSpec extends ObjectBehavior
{
    function it_returns_1_for_1()
    {
        $this->fizzBuzz(1)->shouldReturn(1);
    }

    function it_returns_2_for_2()
    {
        $this->fizzBuzz(2)->shouldReturn(2);
    }

    function it_returns_fizz_for_3()
    {
        $this->fizzBuzz(3)->shouldReturn("fizz");
    }

    function it_returns_buzz_for_5()
    {
        $this->fizzBuzz(5)->shouldReturn("buzz");
    }

    function it_returns_buzz_for_10()
    {
        $this->fizzBuzz(10)->shouldReturn("buzz");
    }

    function it_returns_fizzbuzz_for_15()
    {
        $this->fizzBuzz(15)->shouldReturn("fizzbuzz");
    }

    function it_runs_fizzbuzz_in_a_sequence()
    {
        $this->fizzBuzzUpTo(5)->shouldReturn(array(1,2,"fizz",4,"buzz"));
    }

}
