<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\DiemDanhySearch;
use common\models\DiemDanh;

class DiemDanhService extends Service implements DiemDanhServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  DiemDanhySearch();
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
