<?php

namespace backend\widgets;

use kartik\number\NumberControl as NumberControllerBase;

class BVControl extends NumberControllerBase{
    public function init()
    {
        $this->maskedInputOptions = [
            'prefix' => 'BV',
            'suffix' => '',
            'allowMinus' => true,
            'groupSeparator' => ',',
        ];
        parent::init(); // TODO: Change the autogenerated stub
    }
}