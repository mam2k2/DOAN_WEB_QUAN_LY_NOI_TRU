<?php

namespace backend\modules\v2\controllers;

use app\components\SharedDataFilter;
use Yii;
use tebe\inertia\web\Controller;

/**
 * Default controller for the `v2` module
 */
class BaseController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'main';
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'class' => SharedDataFilter::class
        ]);
    }
}
