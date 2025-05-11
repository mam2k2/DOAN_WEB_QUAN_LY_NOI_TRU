<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\searchPhongOHocSinhSearch;
use common\models\PhongOHocSinh;

class PhongOHocSinhService extends Service implements PhongOHocSinhServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  searchPhongOHocSinhSearch();
    }

    public function getModel($id, array $options = [])
    {
        return PhongOHocSinh::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new PhongOHocSinh($options);
        $model->loadDefaultValues();
        return $model;
    }
}
