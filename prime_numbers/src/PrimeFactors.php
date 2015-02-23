<?php

class PrimeFactors {

    public function generate($number)
    {

        $result = array();

        for ($mod = 2; $number > 1; $mod++) {
            for (; $number % $mod == 0; $number /= $mod) {
                $result[] = $mod;
            }
        }

        return $result;

    }

}