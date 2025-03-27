<?php
namespace backend\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class DataHelper
{
    public static function cache($key, $duration, $callable)
    {
        $cache = Yii::$app->cache;
        if($cache->exists($key)){
            $data = $cache->get($key);
        }
        else{
            $data = $callable();

            if($data) {
                $cache->set($key, $data, $duration);
            }
        }
        return $data;
    }

    public static function getLocale()
    {
        return strtolower(substr(Yii::$app->language, 0, 2));
    }

    public static function getLinkDetailModal($url, $label = null, $class = ""){
        return Html::a($label ?? '<i class="fa fa-folder"></i>', 'javascript:void(0)', [
            'title' => Yii::t('yii', 'View'),
            'url' => $url,
            'onclick' => "viewLayer('" . $url . "',$(this))",
            'data-pjax' => '0',
            'class' => $class,
        ]);
    }
}