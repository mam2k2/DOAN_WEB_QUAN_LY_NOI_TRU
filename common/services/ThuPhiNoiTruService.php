<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ThuPhiNoiTruSearch;
use common\models\ThuPhiNoiTru;

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
}
