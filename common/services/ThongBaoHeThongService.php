<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ThongBaoHeThongSearch;
use common\models\ThongBaoHeThong;

class ThongBaoHeThongService extends Service implements ThongBaoHeThongServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ThongBaoHeThongSearch();
    }

    public function getModel($id, array $options = [])
    {
        return ThongBaoHeThong::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new ThongBaoHeThong($options);
        $model->loadDefaultValues();
        return $model;
    }
}
