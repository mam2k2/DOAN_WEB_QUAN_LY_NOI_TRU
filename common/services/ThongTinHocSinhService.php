<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ThongTinHocSinhSearch;
use common\models\ThongTinHocSinh;

class ThongTinHocSinhService extends Service implements ThongTinHocSinhServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ThongTinHocSinhSearch();
    }

    public function getModel($id, array $options = [])
    {
        return ThongTinHocSinh::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new ThongTinHocSinh($options);
        $model->loadDefaultValues();
        return $model;
    }
}
