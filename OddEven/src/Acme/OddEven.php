<?php

namespace Acme;

class OddEven
{

    public function translate($number)
    {

        if ($this->isPrime($number)) return $number;

        if ($number % 2 != 0) return "Odd";
        else return "Even";

    }

    public function translateUpTo($number)
    {
        $result = array();

        for ($i = 1; $i <= $number ; $i++){
            array_push($result, $this->translate($i));
        }

        return $result;

    }

    private function isPrime($number)
    {
        if ($number == 1) return true;
        if ($number == 2) return true;

        for ($i = 2; $i <= $number/2; $i++){
            if ($number % $i == 0) return false;
        }

        return true;
    }

}
