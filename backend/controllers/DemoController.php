<?php

namespace backend\controllers;

use tebe\inertia\web\Controller;

class DemoController extends Controller
{
    public function actionIndex()
    {
        $params = [
            'data' => [],
            'links' => []
        ];
        return $this->inertia('demo/index', $params);
    }
}