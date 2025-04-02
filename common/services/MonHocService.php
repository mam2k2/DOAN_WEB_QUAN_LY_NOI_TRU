<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\MonHocSearch;
use common\models\MonHoc;

class MonHocService extends Service implements MonHocServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  MonHocSearch();
    }

    public function getModel($id, array $options = [])
    {
        return MonHoc::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new MonHoc($options);
        $model->loadDefaultValues();
        return $model;
    }
}
