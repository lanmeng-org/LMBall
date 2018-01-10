<?php

namespace Lanmeng\Utils;

use GuzzleHttp\Client;

class IPUtil
{
    public static function getIpInfoFromTaobao($ip)
    {
        $apiUrl = "http://ip.taobao.com/service/getIpInfo.php?ip=$ip";

        try {
            $response = (new Client())->get($apiUrl);
            $result = json_decode($response->getBody()->getContents());
        } catch (\Exception $err) {
            \Log::error("file: {$err->getFile()}\n at line: {$err->getLine()}\n error message: {$err->getMessage()}");
            return null;
        }

        if ($result->code != 0) {
            return null;
        }

        return $result->data;
    }
}
