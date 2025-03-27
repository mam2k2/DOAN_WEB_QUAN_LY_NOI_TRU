<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-07-09 00:59
 */

namespace common\helpers;


class StringHelper extends \yii\helpers\StringHelper
{

    /**
     * encode string with UTF-8
     *
     * @param $str
     * @return string
     */
    public static function encodingWithUtf8($str)
    {
        $cur_encoding = mb_detect_encoding($str);
        if ($cur_encoding == "UTF-8" && mb_check_encoding($str, "UTF-8")) {
            return $str;
        } else {
            return utf8_encode($str);
        }
    }

    public static function getRandomString($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[self::cryptoRandSecure(0, $max - 1)];
        }

        return $token;
    }

    public static function cryptoRandSecure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1)
            return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }
}