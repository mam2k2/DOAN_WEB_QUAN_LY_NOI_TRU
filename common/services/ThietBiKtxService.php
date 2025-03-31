<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ThietBiKtxSearch;
use common\models\ThietBiKtx;

class ThietBiKtxService extends Service implements ThietBiKtxServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ThietBiKtxSearch();
    }

    public function getModel($id, array $options = [])
    {
        return ThietBiKtx::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new ThietBiKtx($options);
        $model->loadDefaultValues();
        return $model;
    }
}
