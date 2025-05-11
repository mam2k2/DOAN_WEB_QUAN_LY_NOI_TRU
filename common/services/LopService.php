<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\LopSearch;
use common\models\Lop;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class LopService extends Service implements LopServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  LopSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Lop::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Lop($options);
        $model->loadDefaultValues();
        return $model;
    }
    public function getLopOptions($options= [])
    {
        $list = ArrayHelper::map(
            Lop::find()
                ->select(['{{%lop}}.id', '{{%lop}}.ten_lop','{{%admin_user}}.ho_va_ten'])
                ->join('inner join', '{{%admin_user}}', '{{%admin_user}}.id = {{%lop}}.chu_nghiem_id')
                ->where($options)
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['ten_lop'] .' - GVCN : '.$row['ho_va_ten'];
            });
        return $list;
    }
}
