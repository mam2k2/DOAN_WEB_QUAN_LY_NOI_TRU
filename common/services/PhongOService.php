<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\PhongOSearch;
use common\models\PhongO;
use yii\helpers\ArrayHelper;

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
    public function getAllNamePhong(array $options=[]){
        $list = ArrayHelper::map(
            PhongO::find()
                ->select(['id', 'ma_phong', 'ten_phong'])
                ->where($options)
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['ma_phong']. " - ". $row['ten_phong'];
            });
        return $list;
    }

}
