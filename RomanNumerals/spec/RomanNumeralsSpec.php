<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RomanNumeralsSpec extends ObjectBehavior
{

    function it_converts_1_to_I()
    {
        $this->converts(1)->shouldReturn("I");
    }

    function it_converts_2_to_II()
    {
        $this->converts(2)->shouldReturn("II");
    }

    function it_converts_3_to_III()
    {
        $this->converts(3)->shouldReturn("III");
    }

    function it_converts_5_to_V()
    {
        $this->converts(5)->shouldReturn("V");
    }

    function it_converts_10_to_X()
    {
        $this->converts(10)->shouldReturn("X");
    }
    
    function it_converts_4_to_IV()
    {
        $this->converts(4)->shouldReturn("IV");
    }

    function it_converts_9_to_IX()
    {
        $this->converts(9)->shouldReturn("IX");
    }

    function it_converts_50_to_L()
    {
        $this->converts(50)->shouldReturn("L");
    }

    function it_converts_100_to_C()
    {
        $this->converts(100)->shouldReturn("C");
    }

    function it_converts_500_to_D()
    {
        $this->converts(500)->shouldReturn("D");
    }

    function it_converts_490_to_CDXC()
    {
        $this->converts(490)->shouldReturn("CDXC");
    }

    function it_converts_1499_to_MCDXCIX()
    {
        $this->converts(1499)->shouldReturn("MCDXCIX");
    }

    function it_converts_1999_to_MCDXCIX()
    {
        $this->converts(1999)->shouldReturn("MCMXCIX");
    }

}
