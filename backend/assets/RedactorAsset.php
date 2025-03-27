<?php
namespace backend\assets;

class RedactorAsset extends \yii\web\AssetBundle
{
    public $basePath = "@web";
    public $sourcePath = '@backend/web/static/js/plugins/redactor';
    public $depends = ['yii\web\JqueryAsset'];

    public function init()
    {
        if (YII_DEBUG) {
            $this->js[] = 'redactor.js';
            $this->css[] = 'redactor.css';
        } else {
            $this->js[] = 'redactor.min.js';
            $this->css[] = 'redactor.min.css';
        }
    }

}