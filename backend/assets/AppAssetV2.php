<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAssetV2 extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/static';

    public function init()
    {
        parent::init();
        if (YII_ENV === 'dev') {
            $this->css[] = 'inertia/css/app.css';
            $this->css[] = 'inertia/css/theme-default.css';
            $this->js[] = 'inertia/js/app.js';
        } else {
            $this->css[] = 'inertia/css/app.min.css';
            $this->css[] = 'inertia/css/theme-default.css';
            $this->js[] = 'inertia/js/app.min.js';
        }
    }
}