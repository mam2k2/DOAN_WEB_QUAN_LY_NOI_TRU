<?php

namespace common\models\meta;

class ShopMetaBase extends \common\models\ShopMeta {
    private $keyName = "";

    public function setKeyName($key){
        $this->keyName = $key;
    }

    public function getKeyName(){
        return $this->keyName;
    }

    public function setValue($customerId, $value)
    {
        if (is_null($value)) return;
        $oldValue = $this->getValue($customerId);
        if ($oldValue === $value) return;
        if (!is_null($oldValue)) {
            self::find()->where(['key' => $this->getKeyName()])->andWhere(['value' => $oldValue])->andWhere(['shop_id' => $customerId])->one()->delete();
        }
        $metaModel = new self([
            'shop_id' => $customerId,
            'key' => $this->keyName,
            'value' => $value
        ]);
        $metaModel->save();
    }

    public function getValue($customerId)
    {
        $result = self::find()->where(['key' => $this->getKeyName()])->andWhere(['shop_id' => $customerId])->one();
        if ($result === null) {
            return null;
        }
        return $result->value ?? null;
    }
}