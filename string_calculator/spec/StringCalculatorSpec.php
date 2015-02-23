<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_adds_zero_strings()
    {
        $this->calculates()->shouldReturn(0);
    }

    function it_adds_1()
    {
        $this->add('1');
        $this->calculates()->shouldReturn(1);
    }

    function it_adds_1_and_2()
    {
        $this->add('1,2');
        $this->calculates()->shouldReturn(3);
    }

    function it_adds_1_and_2_and_3()
    {
        $this->add('1,2,3');
        $this->calculates()->shouldReturn(6);
    }

    function it_adds_10_and_1()
    {
        $this->add('10,1');
        $this->calculates()->shouldReturn(11);  
    }

    function it_adds_11_and_1()
    {
        $this->add('22,1');
        $this->calculates()->shouldReturn(23);  
    }

    function it_adds_25_and_20()
    {
        $this->add('25,20');
        $this->calculates()->shouldReturn(45);  
    }

    function it_adds_111_and_11_and_1()
    {
        $this->add('111,11,1');
        $this->calculates()->shouldReturn(123);
    }
}