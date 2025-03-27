<?php

namespace common\helpers;

class BankAccountHelper
{
    public static function rederAccountNumber($accountNumber,$accountName,$accountName, $bankName)
    {
       return $accountNumber . '_' . $accountName . '_' . $bankName."_".self::parseBankBinByBankName($bankName);
    }
    public static function parseBankBinByBankName($accountNumber)
    {
        $bankingMap = VietQrHelper::getListBanking();
        return $bankingMap[$accountNumber]->bin ?? null;
    }
    public static function parseBankAccountData($accountNumber)
    {
        $accountNumber = explode('_', $accountNumber);
        return [
            'account_number' => $accountNumber[0],
            'account_name' => $accountNumber[1],
            'bank_name' => $accountNumber[2],
            'bank_code' => $accountNumber[3],
        ];
    }
}