<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\UserSearch;
use common\models\User;

class UserService extends Service implements UserServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  UserSearch();
    }

    public function getModel($id, array $options = [])
    {
        return User::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new User($options);
        $model->loadDefaultValues();
        return $model;
    }
}
