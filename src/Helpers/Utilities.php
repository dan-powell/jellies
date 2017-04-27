<?php

namespace DanPowell\Jellies\Helpers;

class Utilities
{

    // Distributes an integer $amount amongst x number of $points
    public static function distributePoints($points, $amount = 1)
    {

        $array = [];
        for($i = 0; $i < $points; $i++) {
            $array[$i] = 0;
        }

        for($i = 0; $i < $amount; $i++) {
            // Choose a random stat
            $index = array_rand($array);
            $array[$index] = $array[$index] + 1;
        }

        return $array;
    }

    // Returns a single value from an array of numbers
    // $attributes & $weightings must both be index arrays
    public static function singleValueFromArray($attributes, $weightings)
    {
        /* Each $attribute is multiplied by the corresponding value in the $weightings array (if there is one)

        For example:
        $attribute->strength * $weightings->strength

        This is especially handy for coming up with one value from a number of different stats:

        (toughness * 0.2) + (constitution * 0.4) + (willpower * 0.1) =
        */

        $base = 0;
        // Loop through each stat type
        foreach($attributes as $key => $attribute) {
            // Does the stat type have a constant we can use?
            if (isset($weightings[$key]) && $weightings[$key] > 0) {
                // Add the stat value
                $base += ($attributes[$key] * $weightings[$key]);
            }
        }

        return $base;
    }

}
