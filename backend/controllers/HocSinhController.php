<?php

namespace backend\controllers;

use common\models\DiemDanh;
use common\services\DiemDanhService;
use common\services\DiemDanhServiceInterface;
use Yii;
use common\services\HocSinhServiceInterface;
use common\services\HocSinhService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * HocSinhController implements the CRUD actions for HocSinh model.
 */
class HocSinhController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var HocSinhServiceInterface $service */
        $service = Yii::$app->get(HocSinhServiceInterface::ServiceName);
        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function($query, $indexAction) use($service){
                    $result = $service->getList($query);
                    return [
                        'dataProvider' => $result['dataProvider'],
                        'searchModel' => $result['searchModel'],
                        ];
                }
            ],
            'create' => [
                'class' => CreateAction::className(),
                'doCreate' => function($postData, $createAction) use($service){
                    return $service->create($postData);
                },
                'data' => function($createResultModel, $createAction) use($service){
                    $model = $createResultModel === null ? $service->newModel() : $createResultModel;
                    return [
                        'model' => $model,
                    ];
                }
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'doUpdate' => function($id, $postData, $updateAction) use($service){
                    return $service->update($id, $postData);
                },
                'data' => function($id, $updateResultModel, $updateAction) use($service){
                    $model = $updateResultModel === null ? $service->getDetail($id) : $updateResultModel;
                    return [
                        'model' => $model,
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
