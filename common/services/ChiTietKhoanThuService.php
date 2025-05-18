<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ChiTietKhoanThuSearch;
use common\models\ChiTietKhoanThu;

class ChiTietKhoanThuService extends Service implements ChiTietKhoanThuServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ChiTietKhoanThuSearch();
    }

    public function getModel($id, array $options = [])
    {
        return ChiTietKhoanThu::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new ChiTietKhoanThu($options);
        $model->loadDefaultValues();
        return $model;
    }
}
