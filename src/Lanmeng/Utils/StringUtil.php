<?php namespace Lanmeng\Utils;

class StringUtil
{
    /**
     * 生成指定长度的数字
     * @param int $len
     * @return int
     */
    public static function createFixLenNumber($len = 10)
    {
        $number = '';
        do {
            mt_srand();
            $number .= mt_rand();
        } while (strlen($number) < $len);

        if (strlen($number) > $len) {
            $number = substr($number, 0, $len);
        }

        return $number;
    }

    /**
     * 以行为单位把字符串分割为数组
     * @param $string
     * @return array
     */
    public static function line2Array($string)
    {
        $array = explode("\n", $string);
        foreach ($array as &$item) {
            $item = trim($item);
        }

        return $array;
    }

    /**
     * 以单字为单位把字符串分割为数组
     * @param $string
     * @return array
     */
    public static function stringSplit($string) {
        # Split at all position not after the start: ^
        # and not before the end: $
        return preg_split('/(?<!^)(?!$)/u', $string);
    }
}
