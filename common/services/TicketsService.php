<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\TicketsSearch;
use common\models\Tickets;

class TicketsService extends Service implements TicketsServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  TicketsSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Tickets::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Tickets($options);
        $model->loadDefaultValues();
        return $model;
    }
}
