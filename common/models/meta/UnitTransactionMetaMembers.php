<?php
namespace common\models\meta;
use common\models\UnitTransactionMeta;
use yii\helpers\ArrayHelper;

class UnitTransactionMetaMembers extends UnitTransactionMeta{
    public $keyName = "member";

    public function setMembers($unitTransactionId,$members){
        if(is_string($members)){
            if(empty($members)){
                $loadPorts = [];
            }else{
                $members = str_replace('，',',', $members);
                $members = explode(',', $members);
            }
        }

        $oldMembers = $this->getMembersByTransaction($unitTransactionId);

        $needAdds = array_diff($members, $oldMembers);
        $needRemoves = array_diff($oldMembers, $members);

        foreach ($needAdds as $member){
            $metaModel = new self([
                'unit_transaction_id' => $unitTransactionId,
                'key' => $this->keyName,
                'value' => $member
            ]);
            $metaModel->save();
        }

        foreach ($needRemoves as $member){
            $this->find()->where(['key' => $this->keyName])->andWhere(['value' => $member])->andWhere(['unit_transaction_id' => $unitTransactionId])->one()->delete();
        }
    }

    public function getMembersByTransaction($transactionId){
        $result = $this->find()->select('value')->where(['key' => $this->keyName])->andWhere(['unit_transaction_id' => $transactionId])->asArray()->all();
        if($result === null){
            return [];
        }
        $result = ArrayHelper::getColumn($result, 'value');
        return $result;
    }
}