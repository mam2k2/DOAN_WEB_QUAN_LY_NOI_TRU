<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\YTeSearch;
use common\models\YTe;

class YTeService extends Service implements YTeServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  YTeSearch();
    }

    public function getModel($id, array $options = [])
    {
        return YTe::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new YTe($options);
        $model->loadDefaultValues();
        return $model;
    }
}
