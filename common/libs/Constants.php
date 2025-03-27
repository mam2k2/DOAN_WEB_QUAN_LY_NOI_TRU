<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-10-16 17:15
 */

namespace common\libs;

use Yii;
use yii\base\InvalidParamException;

class Constants
{

    const YesNo_Yes = 1;
    const YesNo_No = 0;

    public static function getYesNoItems($key = null)
    {
        $items = [
            self::YesNo_Yes => Yii::t('app', 'Yes'),
            self::YesNo_No => Yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }

    public static function getWebsiteStatusItems($key = null)
    {
        $items = [
            self::YesNo_Yes => Yii::t('app', 'Opened'),
            self::YesNo_No => Yii::t('app', 'Closed'),
        ];
        return self::getItems($items, $key);
    }

    const COMMENT_INITIAL = 0;
    const COMMENT_PUBLISH = 1;
    const COMMENT_RUBISSH = 2;

    public static function getCommentStatusItems($key = null)
    {
        $items = [
            self::COMMENT_INITIAL => Yii::t('app', 'Not Audited'),
            self::COMMENT_PUBLISH => Yii::t('app', 'Passed'),
            self::COMMENT_RUBISSH => Yii::t('app', 'Not pass'),
        ];
        return self::getItems($items, $key);
    }

    const TARGET_BLANK = '_blank';
    const TARGET_SELF = '_self';

    public static function getTargetOpenMethod($key = null)
    {
        $items = [
            self::TARGET_BLANK => Yii::t('app', 'Yes'),
            self::TARGET_SELF => Yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }


    const HTTP_METHOD_ALL = 0;
    const HTTP_METHOD_GET = 1;
    const HTTP_METHOD_POST = 2;

    public static function getHttpMethodItems($key = null)
    {
        $items = [
            self::HTTP_METHOD_ALL => 'all',
            self::HTTP_METHOD_GET => 'get',
            self::HTTP_METHOD_POST => 'post',
        ];
        return self::getItems($items, $key);
    }

    const PUBLISH_YES = 1;
    const PUBLISH_NO = 0;

    public static function getArticleStatus($key = null)
    {
        $items = [
            self::PUBLISH_YES => Yii::t('app', 'Publish'),
            self::PUBLISH_NO => Yii::t('app', 'Draft'),
        ];
        return self::getItems($items, $key);
    }

    const INPUT_INPUT = 1;
    const INPUT_TEXTAREA = 2;
    const INPUT_UEDITOR = 3;
    const INPUT_IMG = 4;

    public static function getInputTypeItems($key = null)
    {
        $items = [
            self::INPUT_INPUT => 'input',
            self::INPUT_TEXTAREA => 'textarea',
            self::INPUT_UEDITOR => 'ueditor',
            self::INPUT_IMG => 'image',
        ];
        return self::getItems($items, $key);
    }

    const ARTICLE_VISIBILITY_PUBLIC = 1;
    const ARTICLE_VISIBILITY_COMMENT = 2;
    const ARTICLE_VISIBILITY_SECRET = 3;
    const ARTICLE_VISIBILITY_LOGIN = 4;

    public static function getArticleVisibility($key = null)
    {
        $items = [
            self::ARTICLE_VISIBILITY_PUBLIC => Yii::t('app', 'Public'),
            self::ARTICLE_VISIBILITY_COMMENT => Yii::t('app', 'Reply'),
            self::ARTICLE_VISIBILITY_SECRET => Yii::t('app', 'Password'),
            self::ARTICLE_VISIBILITY_LOGIN => Yii::t('app', 'Login'),
        ];
        return self::getItems($items, $key);
    }

    const Status_Enable = 1;
    const Status_Disable = 0;

    public static function getStatusItems($key = null)
    {
        $items = [
            self::Status_Enable => Yii::t('app', 'Enable'),
            self::Status_Disable => Yii::t('app', 'Disable'),
        ];
        return self::getItems($items, $key);
    }

    public static function getItems($items, $key = null)
    {
        if ($key !== null) {
            if (key_exists($key, $items)) {
                return $items[$key];
            }
            throw new InvalidParamException( 'Unknown key:' . $key );
        }
        return $items;
    }

    const AD_IMG = 1;
    const AD_VIDEO = 2;
    const AD_TEXT = 3;

    public static function getAdTypeItems($key = null)
    {
        $items = [
            self::AD_IMG => 'image',
            self::AD_VIDEO => 'video',
            self::AD_TEXT => 'text',
        ];
        return self::getItems($items, $key);
    }

    const USER_LEVEL_ROOT = "root";
    const USER_LEVEL_GD3 = "gd3"; // Giám đốc 3 *
    const USER_LEVEL_GD2 = "gd2"; // Giám đốc 2 *
    const USER_LEVEL_GD1 = "gd1"; // Giám đốc 1 *
    const USER_LEVEL_TP3 = "tp3";
    const USER_LEVEL_TP2 = "tp2";
    const USER_LEVEL_TP1 = "tp1";
    const USER_LEVEL_NV3 = "nv3";
    const USER_LEVEL_NV2 = "nv2";
    const USER_LEVEL_NV1 = "nv1";
    const USER_LEVEL_CTV = "ctv";

    public static function getUserLevelItems($key = null)
    {
        $items = [
            self::USER_LEVEL_ROOT => Yii::t('app','Công ty'),
            self::USER_LEVEL_GD3 => Yii::t('app','Giám đốc 3*'),
            self::USER_LEVEL_GD2 => Yii::t('app','Giám đốc 2*'),
            self::USER_LEVEL_GD1 => Yii::t('app','Giám đốc 1*'),
            self::USER_LEVEL_TP3 => Yii::t('app','Trưởng phòng 3*'),
            self::USER_LEVEL_TP2 => Yii::t('app','Trưởng phòng 2*'),
            self::USER_LEVEL_TP1 => Yii::t('app','Trưởng phòng 1*'),
            self::USER_LEVEL_NV3 => Yii::t('app','Nhân viên 3*'),
            self::USER_LEVEL_NV2 => Yii::t('app','Nhân viên 2*'),
            self::USER_LEVEL_NV1 => Yii::t('app','Nhân viên 1*'),
            self::USER_LEVEL_CTV => Yii::t('app','CTV'),
        ];
        return self::getItems($items, $key);
    }

    /**
     * TYPE OF unit_transaction
     */
    const UNIT_TRANSACTION_TYPE_BUY = 0;
    const UNIT_TRANSACTION_TYPE_USE = 1;
    const UNIT_TRANSACTION_TYPE_SELL = 2;
    const UNIT_TRANSACTION_TYPE_REWARD = 3;
    public static function getUnitTransactionTypeItems($key = null)
    {
        $items = [
            self::UNIT_TRANSACTION_TYPE_BUY => Yii::t('app','Buy'),
            self::UNIT_TRANSACTION_TYPE_USE => Yii::t('app','Use'),
            self::UNIT_TRANSACTION_TYPE_SELL => Yii::t('app','Sell'),
            self::UNIT_TRANSACTION_TYPE_REWARD => Yii::t('app','Reward'),
        ];
        return self::getItems($items, $key);
    }
}