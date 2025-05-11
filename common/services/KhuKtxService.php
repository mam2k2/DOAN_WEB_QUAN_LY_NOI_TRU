<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\KhuKtxSearch;
use common\models\KhuKtx;
use yii\helpers\ArrayHelper;

class KhuKtxService extends Service implements KhuKtxServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  KhuKtxSearch();
    }

    public function getModel($id, array $options = [])
    {
        return KhuKtx::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new KhuKtx($options);
        $model->loadDefaultValues();
        return $model;
    }
    public function getAllNameKhu(array $options=[]){
        $list = ArrayHelper::map(
            KhuKtx::find()
                ->select(['id', 'ten_khu'])
                ->where($options)
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['ten_khu'];
            });
        return $list;
    }
}
