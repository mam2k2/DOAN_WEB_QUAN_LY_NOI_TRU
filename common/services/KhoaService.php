<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\KhoaSearch;
use common\models\Khoa;
use yii\helpers\ArrayHelper;

class KhoaService extends Service implements KhoaServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  KhoaSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Khoa::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Khoa($options);
        $model->loadDefaultValues();
        return $model;
    }
    public function getOptionsKhoa($options = [])
    {
        $list = ArrayHelper::map(
            Khoa::find()
                ->select(['id', 'ten_khoa'])
                ->where($options)
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['ten_khoa'];
            });
        return $list;
    }
}
