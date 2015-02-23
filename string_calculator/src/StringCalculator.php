<?php

class StringCalculator
{

    const MAX_NUMBER_ALLOWED = 1000;

    public function add($numbers)
    {

        $result = 0;

        $numbers = $this->extractNumbersFromString($numbers);

        foreach ($numbers as $number)
        {
            
            $this->guardAgainsNegativeNumbers($number);

            if ($number >= self::MAX_NUMBER_ALLOWED) continue;

            $result += $number;
        }

        return $result;
    }

    private function guardAgainsNegativeNumbers($number)
    {
        if ($number < 0) throw new Exception("We don't deal with negative numbers");
    }

    private function extractNumbersFromString($numbers)
    {
        return preg_split('/\s*(,|\\\n)\s*/', $numbers);
    }
}
