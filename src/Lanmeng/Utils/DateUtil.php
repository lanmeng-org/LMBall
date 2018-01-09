<?php

namespace Lanmeng\Utils;

use DateTime;

class DateUtil
{
    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $dateTime = DateTime::createFromFormat($format, $date);
        return $dateTime && $dateTime->format($format) == $date;
    }
}
