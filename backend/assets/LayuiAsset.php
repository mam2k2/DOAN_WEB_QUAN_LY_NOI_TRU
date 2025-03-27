<?php
namespace backend\assets;

class LayuiAsset extends \yii\web\AssetBundle
{
    public $basePath = "@web";
    public $sourcePath = '@backend/web/static/plugins/layui';
    public $depends = ['yii\web\JqueryAsset'];

    public function init()
    {
        $this->js[] = 'layui.js';
        $this->css[] = 'css/luyui.css';
    }

}