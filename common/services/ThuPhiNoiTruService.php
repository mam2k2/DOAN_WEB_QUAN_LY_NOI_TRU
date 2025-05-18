<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ThuPhiNoiTruSearch;
use common\models\BaseModel;
use common\models\ChiTietKhoanThu;
use common\models\ThuPhiNoiTru;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\helpers\VarDumper;

class ThuPhiNoiTruService extends Service implements ThuPhiNoiTruServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ThuPhiNoiTruSearch();
    }

    public function getModel($id, array $options = [])
    {
        return ThuPhiNoiTru::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new ThuPhiNoiTru($options);
        $model->loadDefaultValues();
        return $model;
    }
    public function create(array $postData, array $options = [])
    {

        /** @var ActiveRecord $model */
        $model = $this->newModel($options);
        $model->so_tien = 0;
        if( $model->load($postData) && $model->save() ){
            $res = [];
            foreach ($postData['ChiTietKhoanThu'] as $row) {
                $res[] = new ChiTietKhoanThu();
            }
            Model::loadMultiple($res,['ChiTietKhoanThu'=>$postData['ChiTietKhoanThu']]);
            $soTien = 0;
            foreach ($res as $row) {
                $row->thu_phi_noi_tru_id = $model->id;
                $soTien = $soTien + $row->so_tien;
                if(!$row->save()){
                    VarDumper::dump($row,10,true);
                    exit();
                }
            }
            $model->so_tien = $soTien;
            $model->save();
            return true;
        }
        VarDumper::dump($model,10,true);
        exit();
        return $model;

    }
}
