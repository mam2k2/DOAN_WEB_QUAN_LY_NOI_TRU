<?php

namespace common\helpers;

use common\models\BankingData;
use yii\helpers\VarDumper;

class VietQrHelper
{
    public static function getQuickLinkQr($description,$amount = 0){
        $bankData = \Yii::$app->feehi->banking_account ?? "0346444659_TPBANK_NGUYEN DINH QUYET_970423";
        $bankData = explode("_", $bankData);
        $bankNum = $bankData[0];
        $bankName = $bankData[1];
        $accountName = $bankData[2];
        $bankId = $bankData[3] ?? $bankData[1];
        $min = \Yii::$app->feehi->min_deposit ?? 1100000;
        $amount = ($amount < $min ? $min : $amount );
        return [
            'accountNo' => $bankNum,
            'accountName' => $accountName,
            'bankName' => $bankName,
            'amount' => $amount,
            'base64' => self::base64VietQrCreate($bankNum,$accountName,$bankId,$description,$amount),
        ];
    }
    public static function getListBanking(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.vietqr.io/v2/banks',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array()
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response,true);
        $bankingMap = [];
        foreach ($response["data"] as $value) {
            $bankingMap[$value["shortName"]] = new BankingData($value);
        }
        return $bankingMap;
    }
    public static function base64VietQrCreate($bankNum,$accountName,$bankId,$description,$amount = 0){


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.vietqr.io/v2/generate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "accountNo": "'.$bankNum.'",
                "accountName": "'.$accountName.'",
                "acqId": '.$bankId.',
                "addInfo": "'.$description.'",
                "amount": "'.$amount.'",
                "template": "compact"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: connect.sid=s%3Av8YTBkztES2tZ3d7op4TVMZ_HYHjpYuI.TsxBRTE9mAGqsTUd1lopjo8KvQpwLFKnxOohkqr1BZI'
            ),
        ));

        $response = json_decode(curl_exec($curl),true);

        curl_close($curl);
        return $response['data']['qrDataURL'];

    }
}