<?php

namespace Acme;

class FizzBuzz
{
    public function fizzBuzz($number)
    {
        if ($number % 5 == 0 && $number % 3 == 0) return "fizzbuzz";
        if ($number % 3 == 0) return "fizz";
        if ($number % 5 == 0) return "buzz";
        return $number;
    }

    public function fizzBuzzUpTo($number)
    {
        $output = array();

        foreach (range(1, $number) as $i) {
            $output[] = $this->fizzBuzz($i);
        }

        return $output;
    }
}
