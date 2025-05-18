<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\DiemDanhSearch;
use common\models\DiemDanh;

class DiemDanhService extends Service implements DiemDanhServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  DiemDanhSearch();
    }

    public function getModel($id, array $options = [])
    {
        return DiemDanh::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new DiemDanh($options);
        $model->loadDefaultValues();
        return $model;
    }
}
