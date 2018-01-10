<?php

namespace Lanmeng\Utils;

class UserAgentUtil
{
    public static function parseInfo($userAgent)
    {
        return [
            'os'      => self::parseOS($userAgent),
            'browser' => self::parseBrowser($userAgent),
        ];
    }

    public static function parseOS($userAgent)
    {
        $osArr = [
            'iPhone OS'               => 'iPhone/iPod',
            'OS \d+_\d+_\d+'          => 'iPad',
            'hpwOS'                   => 'WebOs',
            'SymbianOS'               => 'SymbianOS',
            'Windows Phone OS'        => 'Windows Phone',
            'BlackBerry'              => 'BlackBerry',
            'Openwave'                => 'Openwave',
            'SunOS'                   => 'Solaris',
            'Android'                 => 'Android',
            'FreeBSD'                 => 'FreeBSD',
            'Mac(\s*)OS(\s*)X'        => 'Mac',
            'Linux'                   => 'Linux',
            'Windows(\s*)NT(\s*)10'   => 'Windows 10',
            'Windows(\s*)NT(\s*)6\.1' => 'Windows 7',
            'Windows(\s*)NT(\s*)6\.0' => 'Windows Vista',
            'Windows(\s*)NT(\s*)5\.2' => 'Windows 2003',
            'Windows(\s*)NT(\s*)5\.1' => 'Windows XP',
            'Windows(\s*)ME'          => 'Windows ME',
            'Windows(\s*)98'          => 'Windows 98',
            'MSIE'                    => 'Windows',
        ];

        return self::pregMatch($osArr, $userAgent);
    }

    public static function parseBrowser($userAgent)
    {
        $browserArr = [
            '360SE'                  => '360安全浏览器',
            'AvantBrowser'           => 'Avant',
            'GreenBrowser'           => '绿色浏览器',
            'XMetaSr'                => '搜狗浏览器',
            'TencentTraveler'        => '腾讯TT',
            'TheWorld'               => '世界之窗',
            'Maxthon'                => '傲游',
            'MQQBrowser'             => 'QQ浏览器 Android',
            'UCWEB'                  => 'UC浏览器',
            'IEMobile'               => 'IEMobile',
            'BlackBerry'             => 'BlackBerry',
            'wOSBrowser'             => 'WebOSBrowser',
            'MSIE(\s*)9\.0'          => 'IE 9.0',
            'MSIE(\s*)8\.0'          => 'IE 8.0',
            'MSIE(\s*)7\.0'          => 'IE 7.0',
            'MSIE(\s*)6\.0'          => 'IE 6.0',
            'Firefox'                => 'Firefox',
            'Opera'                  => 'Opera',
            'Chrome'                 => 'Chrome',
            'U;.*Mac(\s*)OS.*Safari' => 'Safari',
            'Nokia' => 'Nokia',
        ];

        return self::pregMatch($browserArr, $userAgent);
    }

    // 匹配值
    protected static function pregMatch($pregArr, $userAgent)
    {
        foreach ($pregArr as $key => $value) {
            if (preg_match("/$key/", $userAgent)) {
                return $value;
            }
        }

        return null;
    }
}
