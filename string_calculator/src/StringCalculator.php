<?php

class StringCalculator
{

    protected $strings = array();
    protected $result = 0;
    protected static $number_to_string_array = array(
        1 => "1",
        2 => "2",
        3 => "3",
        4 => "4",
        5 => "5",
        6 => "6",
        7 => "7",
        8 => "8",
        9 => "9",
        10 => "10"
    );

    public function add($string)
    {
        $this->strings = explode (",", $string);
    }

    public function calculates()
    {

        $this->result = 0;

        if (empty($this->strings))
        {
            return 0;   
        }

        for ($i=0; $i < count($this->strings) ; $i++) 
        { 

            foreach (self::$number_to_string_array as $number => $string) 
            {
                if ($this->strings[$i] == $string)
                {
                    $this->result += $number;
                }
            }

        }

        return $this->result;
    }
}
