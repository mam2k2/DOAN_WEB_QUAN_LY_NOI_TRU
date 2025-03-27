<?php

namespace backend\widgets;
use Yii;
use yii\web\View;

class Vue extends \antkaz\vue\Vue{

    public function init()
    {
        parent::init();

        $this->initOptions();
        $this->initClientOptions();
        $this->registerJs();
    }
}