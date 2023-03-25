<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StringComparison extends Model
{
    public static function calculate($str1, $str2)
    {
        $str1 = preg_replace('/[^a-zA-Z0-9]/', '', $str1);
        $str2 = preg_replace('/[^a-zA-Z0-9]/', '', $str2);

        $vec1 = self::getCharacterFrequency($str1);
        $vec2 = self::getCharacterFrequency($str2);

        $dotProduct = self::dotProduct($vec1, $vec2);
        $magnitude1 = self::magnitude($vec1);
        $magnitude2 = self::magnitude($vec2);

        if ($magnitude1 == 0 || $magnitude2 == 0) {
            return 0;
        } else {
            return $dotProduct / ($magnitude1 * $magnitude2);
        }
    }

    private static function getCharacterFrequency($str)
    {
        $freq = array();
        $len = strlen($str);

        for ($i = 0; $i < $len; $i++) {
            $char = substr($str, $i, 1);
            if (array_key_exists($char, $freq)) {
                $freq[$char]++;
            } else {
                $freq[$char] = 1;
            }
        }

        return $freq;
    }

    private static function dotProduct($vec1, $vec2)
    {
        $dotProduct = 0;
        foreach ($vec1 as $char => $freq1) {
            if (array_key_exists($char, $vec2)) {
                $freq2 = $vec2[$char];
                $dotProduct += $freq1 * $freq2;
            }
        }
        return $dotProduct;
    }

    private static function magnitude($vec)
    {
        $sum = 0;
        foreach ($vec as $char => $freq) {
            $sum += pow($freq, 2);
        }
        return sqrt($sum);
    }
}
