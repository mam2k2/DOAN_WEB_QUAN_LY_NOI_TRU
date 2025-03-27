<?php
namespace common\services;
/**
* This is the template for generating CRUD service class of the specified model.
*/

use backend\models\search\ProductSearch;
use common\models\Product;

class ProductService extends Service implements ProductServiceInterface{
    public function getSearchModel(array $query=[], array $options=[])
    {
         return new  ProductSearch();
    }

    public function getModel($id, array $options = [])
    {
        return Product::findOne($id);
    }

    public function newModel(array $options = [])
    {
        $model = new Product($options);
        $model->loadDefaultValues();
        return $model;
    }
}
