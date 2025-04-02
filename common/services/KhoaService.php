<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\KhoaSearch;
use common\models\Khoa;

class KhoaService extends Service implements KhoaServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  KhoaSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Khoa::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Khoa($options);
        $model->loadDefaultValues();
        return $model;
    }
}
