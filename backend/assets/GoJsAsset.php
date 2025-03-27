<?php
namespace backend\assets;

class GoJsAsset extends \yii\web\AssetBundle
{
    public $basePath = "@web";
    public $sourcePath = '@backend/web/static/plugins/gojs';
    public $depends = ['yii\web\JqueryAsset'];

    public function init()
    {
        $this->js[] = 'go.js';
        $this->js[] = 'extensions/DataInspector.js';
        $this->css[] = 'extensions/DataInspector.css';
    }

}