<?php

namespace backend\controllers;

use common\services\BranchServiceInterface;
use common\services\CategoryServiceInterface;
use Yii;
use common\services\ProductServiceInterface;
use common\services\ProductService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
use yii\helpers\ArrayHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var ProductServiceInterface $service */
        /** @var BranchServiceInterface $branchService */
        /** @var CategoryServiceInterface $categoryService */
        $service = Yii::$app->get(ProductServiceInterface::ServiceName);
        $branchService = Yii::$app->get(BranchServiceInterface::ServiceName);
        $categoryService = Yii::$app->get(CategoryServiceInterface::ServiceName);
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function($query, $indexAction) use($service){
                    $result = $service->getList($query);
                    return [
                        'dataProvider' => $result['dataProvider'],
                        'searchModel' => $result['searchModel'],                    ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'doCreate' => function($postData, $createAction) use($service){
                    return $service->create($postData);
                },
                'data' => function($createResultModel, $createAction) use($service,$branchService,$categoryService){
                    $model = $createResultModel === null ? $service->newModel() : $createResultModel;
                    return [
                        'model' => $model,
                        'branchOptions' => $branchService->getOptions(),
                        'categoryOptions' => $categoryService->getCategoryOptions()
                    ];
                }
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'doUpdate' => function($id, $postData, $updateAction) use($service){
                    return $service->update($id, $postData);
                },
                'data' => function($id, $updateResultModel, $updateAction) use($service,$branchService,$categoryService){
                    $model = $updateResultModel === null ? $service->getDetail($id) : $updateResultModel;
                    return [
                        'model' => $model,
                        'branchOptions' => $branchService->getOptions(),
                        'categoryOptions' => $categoryService->getCategoryOptions()
                    ];
                }
            ],
            'delete' => [
                'class' => DeleteAction::className(),
                'doDelete' => function($id, $deleteAction) use($service){
                    return $service->delete($id);
                },
            ],
            'sort' => [
                'class' => SortAction::className(),
                'doSort' => function($id, $sort, $sortAction) use($service){
                    return $service->sort($id, $sort);
                },
            ],
            'view-layer' => [
                'class' => ViewAction::className(),
                'data' => function($id, $viewAction) use($service){
                    return [
                        'model' => $service->getDetail($id),
                    ];
                },
            ],
        ];
    }
}
