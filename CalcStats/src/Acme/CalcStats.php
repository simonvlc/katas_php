<?php

namespace Acme;

class CalcStats
{

    public function minimun($numbers)
    {
        return min($numbers);
    }

    public function maximum($numbers)
    {
        return max($numbers);
    }

    public function countElements($numbers)
    {
        return count($numbers);
    }

    public function average($numbers)
    {
        return array_sum($numbers) / $this->countElements($numbers);
    }
}
