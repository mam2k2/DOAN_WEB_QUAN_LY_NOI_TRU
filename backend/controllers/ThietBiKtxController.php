<?php

namespace backend\controllers;

use common\models\PhongO;
use common\services\PhongOServiceInterface;
use Yii;
use common\services\ThietBiKtxServiceInterface;
use common\services\ThietBiKtxService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * ThietBiKtxController implements the CRUD actions for ThietBiKtx model.
 */
class ThietBiKtxController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var ThietBiKtxServiceInterface $service */
        $service = Yii::$app->get(ThietBiKtxServiceInterface::ServiceName);
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
                    /** @var PhongOServiceInterface $phongOService */
                    $phongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $phongOList = $phongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'phongOList' => $phongOList,
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
                    $phongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $phongOList = $phongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'phongOList' => $phongOList,
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
