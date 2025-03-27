<?php
namespace common\helpers;
class CodeHelper{
    const PrefixUserCode = "CV";
    const PrefixOrderCode = "OD";
    const PrefixProductCode = "PD";
    const PrefixUserDepositCode = "VODYUD";
    const PrefixUserWithdrawCode = "VODYUW";

    public static function generateUserCode(){
        return self::PrefixUserCode.StringHelper::getRandomString(8);
    }
    public static function generateOrderCode(){
        return self::PrefixOrderCode.StringHelper::getRandomString(8);
    }
    public static function generateProductCode(){
        return self::PrefixProductCode.StringHelper::getRandomString(8);
    }

    public static function generateUserDepositCode(){
        return self::PrefixUserDepositCode.StringHelper::getRandomString(8);
    }

    public static function generateUserWithdrawCode(){
        return self::PrefixUserWithdrawCode.StringHelper::getRandomString(8);
    }
}