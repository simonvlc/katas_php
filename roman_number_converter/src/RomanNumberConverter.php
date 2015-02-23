<?php

class RomanNumberConverter
{

    protected static $lookup = array(
        1000 => "M",
        900 => "CM",
        500 => "D",
        400 => "CD",
        100 => "C",
        90 => "XC",
        50 => "L",
        40 => "XL",
        10 => "X",
        9 => "IX",
        5 => "V",
        4 => "IV",
        1 => "I",
    );

    function converts($number)
    {

        $result = "";

        foreach (self::$lookup as $num_value => $glyph) {
            while ($number >= $num_value) {
                $result .= $glyph;
                $number -= $num_value;
            }
        }

        return $result;

    }
}