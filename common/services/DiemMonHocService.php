<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\DiemMonHocSearch;
use common\models\DiemMonHoc;

class DiemMonHocService extends Service implements DiemMonHocServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  DiemMonHocSearch();
    }

    public function getModel($id, array $options = [])
    {
        return DiemMonHoc::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new DiemMonHoc($options);
        $model->loadDefaultValues();
        return $model;
    }
}
