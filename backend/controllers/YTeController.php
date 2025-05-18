<?php

namespace backend\controllers;

use common\services\ThongTinHocSinhServiceInterface;
use Yii;
use common\services\YTeServiceInterface;
use common\services\YTeService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * YTeController implements the CRUD actions for YTe model.
 */
class YTeController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var YTeServiceInterface $service */
        $service = Yii::$app->get(YTeServiceInterface::ServiceName);
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
                'data' => function($createResultModel, $createAction) use($service){
                    $model = $createResultModel === null ? $service->newModel() : $createResultModel;
                    /** @var ThongTinHocSinhServiceInterface $tTHSService */
                    $tTHSService = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
                    $listTTHS = $tTHSService->getAllNameHocSinh();
                    return [
                        'model' => $model,
                        'listTTHS' => $listTTHS,
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
                    /** @var ThongTinHocSinhServiceInterface $tTHSService */
                    $tTHSService = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
                    $listTTHS = $tTHSService->getAllNameHocSinh();
                    return [
                        'model' => $model,
                        'listTTHS' => $listTTHS,
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
