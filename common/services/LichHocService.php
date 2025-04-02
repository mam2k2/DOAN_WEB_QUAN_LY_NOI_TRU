<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\LichHocSearch;
use common\models\LichHoc;

class LichHocService extends Service implements LichHocServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  LichHocSearch();
    }

    public function getModel($id, array $options = [])
    {
        return LichHoc::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new LichHoc($options);
        $model->loadDefaultValues();
        return $model;
    }
}
