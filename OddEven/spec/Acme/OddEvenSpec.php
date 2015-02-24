<?php

namespace spec\Acme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OddEvenSpec extends ObjectBehavior
{

    function it_returns_Even_given_an_even_number()
    {
        $this->translate(4)->shouldReturn("Even");
    }

    function it_returns_Odd_given_an_odd_number()
    {
        $this->translate(9)->shouldReturn("Odd");
    }

    function it_returns_3_given_a_prime_3()
    {
        $this->translate(3)->shouldReturn(3);
    }

    function it_returns_7_given_a_prime_7()
    {
        $this->translate(7)->shouldReturn(7);
    }

    function it_returns_97_given_a_prime_97()
    {
        $this->translate(97)->shouldReturn(97);
    }

    function it_translates_a_sequece_of_numbers_up_to_10()
    {
        $this->translateUpTo(10)->shouldReturn(array(
            1, 2, 3, "Even", 5, "Even", 7, "Even", "Odd", "Even"));
    }

}
