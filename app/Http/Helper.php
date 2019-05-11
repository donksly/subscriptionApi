<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/11/2019
 * Time: 18:08
 */

namespace App\Http;

class Helper
{
    public function subscriptionStatus($flag)
    {
        $responseStr = 'new';
        switch ($responseStr) {
            case $flag == 1:
                $responseStr = 'subscribed';
                break;
            case $flag == 2:
                $responseStr = 'unsubscribed';
                break;
            default:
                $responseStr = 'new';
                break;
        }
        return $responseStr;
    }

    public function formatDateTime($dateStr)
    {
        if ($dateStr == '' || is_null($dateStr)) {
            return "Null";
        } else {
            return date("F jS, Y - g:ia", strtotime($dateStr));
        }
    }
}