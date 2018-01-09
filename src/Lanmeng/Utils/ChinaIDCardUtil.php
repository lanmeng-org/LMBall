<?php

namespace Lanmeng\Utils;

/**
 * Class ChinaIDCardUtil
 * 中国公民身份证工具类
 * @package Bigecko\Utils
 */
class ChinaIDCardUtil
{
    public static function isValidIdNo($idNo)
    {
        return self::isIdNoPattern($idNo)
            && self::isValidProvinceId($idNo)
            && self::isValidBirthday($idNo)
            && self::checkIdNoLastNum($idNo);
    }

    /**
     * 二代身份证正则表达式
     * @param $idNo
     * @return bool
     */
    public static function isIdNoPattern($idNo) {
        $pattern = '/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([\d|x|X]{1})$/';
        return (bool)preg_match($pattern, $idNo);
    }

    /**
     * 检查身份证省份代码
     * @param $provinceId
     * @return bool
     */
    public static function isValidProvinceId($idNo)
    {
        $provinceId = substr($idNo, 0, 2);
        $provinceCodes = [
            '11', '12', '13', '14', '15', '21', '22',
            '23', '31', '32', '33', '34', '35', '36', '37', '41', '42', '43',
            '44', '45', '46', '50', '51', '52', '53', '54', '61', '62', '63',
            '64', '65', '71', '81', '82', '91',
        ];

        return in_array($provinceId, $provinceCodes);
    }

    /**
     * 检查身份证中的生日
     * @param $idNo
     * @return bool
     */
    public static function isValidBirthday($idNo)
    {
        $birthDay = substr($idNo, 6, 8);

        return DateUtil::validateDate($birthDay, 'Ymd');
    }

    public static function checkIdNoLastNum($idNo)
    {
        if(strlen($idNo) != 18){
            return false;
        }

        $signNum = substr($idNo, -1);

        return strtolower($signNum) == self::lastSignNum($idNo);
    }

    public static function lastSignNum($idNo)
    {
        $sigma = 0;
        $wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        $ai = array('1', '0', 'x', '9', '8', '7', '6', '5', '4', '3', '2');
        for ($i = 0;$i < 17;$i++) {
            $sigma += $idNo{$i} * $wi[$i];
        }

        return $ai[$sigma % 11];
    }
}
