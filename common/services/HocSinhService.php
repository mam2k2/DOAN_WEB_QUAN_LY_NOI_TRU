<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\HocSinhSearch;
use common\models\HocSinh;
use yii\helpers\ArrayHelper;

class HocSinhService extends Service implements HocSinhServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  HocSinhSearch();
    }

    public function getModel($id, array $options = [])
    {
        return HocSinh::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new HocSinh($options);
        $model->loadDefaultValues();
        return $model;
    }

}
