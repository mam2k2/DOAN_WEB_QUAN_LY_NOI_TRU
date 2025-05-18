<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\KhoanPhiSearch;
use common\models\KhoanPhi;
use yii\helpers\ArrayHelper;

class KhoanPhiService extends Service implements KhoanPhiServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  KhoanPhiSearch();
    }

    public function getModel($id, array $options = [])
    {
        return KhoanPhi::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new KhoanPhi($options);
        $model->loadDefaultValues();
        return $model;
    }
    public function getOptionsKhoanPhi($options = [])
    {
        $list = ArrayHelper::map(
            KhoanPhi::find()
                ->select(['id', 'ten_khoan_phi','loai_phi'])
                ->where($options)
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['ten_khoan_phi']."(".$row['loai_phi'].")";
            });
        return $list;
    }
    public function getGiaKhoanPhi($options = [])
    {
        $list = ArrayHelper::map(
            KhoanPhi::find()
                ->select(['id', 'so_tien'])
                ->where($options)
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['so_tien'];
            });
        return $list;
    }
}
