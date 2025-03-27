<?php

namespace common\models\meta;

use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class OrderMetaSeller extends \common\models\OrderMeta {
    public $keyName = "seller";

    public function setSellers($orderId,$sellers){
        if(is_string($sellers)){
            if(empty($sellers)){
                $sellers = [];
            }else{
                $sellers = explode('+', $sellers);
            }
        }
        $sellers = array_map(function($item){
            return json_encode($item);
        }, $sellers);

        $oldSellers = $this->getSellers($orderId);
        $needAdds = array_diff($sellers ?? [],  $oldSellers);
        $needRemoves = array_diff($oldSellers, $sellers ?? []);

        foreach ($needAdds as $item){
            $metaModel = new self([
                'order_id' => $orderId,
                'key' => $this->keyName,
                'value' => $item
            ]);
            $metaModel->save();
        }

        foreach ($needRemoves as $item){
            $this->find()->where(['key' => $this->keyName])->andWhere(['value' => $item])->andWhere(['order_id' => $orderId])->one()->delete();
        }
    }

    public function getSellers($orderId){
        $result = $this->find()->where(['key' => $this->keyName])->andWhere(['order_id' => $orderId])->orderBy(['id'=> 'ASC'])->asArray()->all();
        if($result === null){
            return [];
        }
        $result = ArrayHelper::getColumn($result, 'value');
        return $result;
    }
}