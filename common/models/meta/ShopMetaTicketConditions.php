<?php

namespace common\models\meta;

use common\libs\Constants;

class ShopMetaTicketConditions extends \common\models\ShopMeta {
    private $keyName = "config_ticket_conditions";

    public function setValue($shopId, $value)
    {
        if (is_null($value)) return;
        if(!is_string($value)){
            $value = json_encode($value);
        }
        $oldValue =  $this->getValue($shopId);
        if(!is_null($oldValue)) $oldValue = json_encode($oldValue);
        if ($oldValue === $value) return;
        if (!is_null($oldValue)) {
            self::find()->where(['key' => $this->keyName])->andWhere(['value' => $oldValue])->andWhere(['shop_id' => $shopId])->one()->delete();
        }
        $metaModel = new self([
            'shop_id' => $shopId,
            'key' => $this->keyName,
            'value' => $value
        ]);
        $metaModel->save();
    }

    public function getValue($shopId)
    {
        $result = self::find()->where(['key' => $this->keyName])->andWhere(['shop_id' => $shopId])->one();
        if ($result === null) {
            return null;
        }
        return json_decode($result->value, true) ?? null;
    }

    public function getDefaultValue(){
        return [
            Constants::USER_LEVEL_ROOT => [
                'commission' => 100,
            ],
            Constants::USER_LEVEL_GD3 => [
                'commission' => 15,
            ],
            Constants::USER_LEVEL_GD2 => [
                'commission' => 10,
            ],
            Constants::USER_LEVEL_GD1 => [
                'commission' => 5,
            ],
            Constants::USER_LEVEL_TP3 => [
                'commission' => 15,
            ],
            Constants::USER_LEVEL_TP2 => [
                'commission' => 10,
            ],
            Constants::USER_LEVEL_TP1 => [
                'commission' => 5,
            ],
            Constants::USER_LEVEL_NV3 => [
                'commission' => 15,
            ],
            Constants::USER_LEVEL_NV2 => [
                'commission' => 10,
            ],
            Constants::USER_LEVEL_NV1 => [
                'commission' => 5,
            ],
            Constants::USER_LEVEL_CTV => [
                'commission' => 20
            ]
        ];
    }
}