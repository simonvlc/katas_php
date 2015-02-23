<?php

class StringCalculator
{

    protected $input_strings = array();
    protected $result = 0;
    protected static $number_to_string_array = array(
        0 => "0",
        1 => "1",
        2 => "2",
        3 => "3",
        4 => "4",
        5 => "5",
        6 => "6",
        7 => "7",
        8 => "8",
        9 => "9"
    );

    public function add($string)
    {
        $this->input_strings = explode (",", $string);
    }

    public function calculates()
    {

        $result = 0;

        if (!$this->stringsToConvert())
        {
            return 0;   
        }

        for ($string=0; $string < count($this->stringsToConvert()) ; $string++) 
        { 

            $string_length = strlen($this->stringToConvert($string));

            for ($char = 0; $char < $string_length; $char++) { 

                $multiplier = pow (10, $string_length - 1 - $char);
                
                foreach (self::$number_to_string_array as $number => $character) 
                {

                    if ($this->charToConvert($string, $char) == $character)
                    {
                        
                        $result += (int) ($number * $multiplier);
                    }
                }

            }

        }

        return $result;
    }

    private function stringsToConvert()
    {
        return $this->input_strings;
    }

    private function stringToConvert($index)
    {
        return $this->input_strings[$index];
    }

    private function charToConvert($index, $char)
    {
        return $this->input_strings[$index][$char];
    }

}
