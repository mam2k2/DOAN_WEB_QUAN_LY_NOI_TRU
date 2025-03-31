<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\KhuKtxSearch;
use common\models\KhuKtx;

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
}
