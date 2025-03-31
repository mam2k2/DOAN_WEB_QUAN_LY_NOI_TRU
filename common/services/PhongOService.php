<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\PhongOSearch;
use common\models\PhongO;

class PhongOService extends Service implements PhongOServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  PhongOSearch();
    }

    public function getModel($id, array $options = [])
    {
        return PhongO::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new PhongO($options);
        $model->loadDefaultValues();
        return $model;
    }
}
