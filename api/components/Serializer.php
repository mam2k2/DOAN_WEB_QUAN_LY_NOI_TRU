<?php

namespace api\components;

class Serializer extends \yii\rest\Serializer
{
    /**
     * {@inheritdoc}
     */
    protected function serializeDataProvider($dataProvider)
    {
        $output = parent::serializeDataProvider($dataProvider);

        if (!is_array($output)) return $output;

        return [
            'success' => true,
            'code'=>\Yii::$app->response->statusCode,
            'result' =>  $output
        ] ;
    }
}