<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\BranchSearch;
use common\libs\Constants;
use common\models\Branch;
use yii\helpers\ArrayHelper;

class BranchService extends Service implements BranchServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  BranchSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Branch::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Branch($options);
        $model->loadDefaultValues();
        return $model;
    }

    public function getOptions(array $options = []): array
    {

        return ArrayHelper::map(
                Branch::find()
                ->where([
                    'status' => Constants::YesNo_Yes
                ])
                ->andWhere($options)
                ->all(),
            'id', 'name');
    }
}
