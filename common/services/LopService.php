<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\LopSearch;
use common\models\Lop;

class LopService extends Service implements LopServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  LopSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Lop::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Lop($options);
        $model->loadDefaultValues();
        return $model;
    }
}
