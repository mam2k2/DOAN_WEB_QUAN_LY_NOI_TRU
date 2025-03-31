<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ViPhamNoiQuySearch;
use common\models\ViPhamNoiQuy;

class ViPhamNoiQuyService extends Service implements ViPhamNoiQuyServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ViPhamNoiQuySearch();
    }

    public function getModel($id, array $options = [])
    {
        return ViPhamNoiQuy::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new ViPhamNoiQuy($options);
        $model->loadDefaultValues();
        return $model;
    }
}
