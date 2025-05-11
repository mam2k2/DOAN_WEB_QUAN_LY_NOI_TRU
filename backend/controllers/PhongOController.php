<?php

namespace backend\controllers;

use common\models\HocSinh;
use common\services\HocSinhService;
use common\services\HocSinhServiceInterface;
use common\services\KhuKtxServiceInterface;
use common\services\ThongTinHocSinhService;
use common\services\ThongTinHocSinhServiceInterface;
use Yii;
use common\services\PhongOServiceInterface;
use common\services\PhongOService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * PhongOController implements the CRUD actions for PhongO model.
 */
class PhongOController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var PhongOServiceInterface $service */
        $service = Yii::$app->get(PhongOServiceInterface::ServiceName);
        /** @var KhuKtxServiceInterface $khuService */

        return [
            'index' => [
                'class' => IndexAction::className(),
                'data' => function($query, $indexAction) use($service){
                    $result = $service->getList($query);
                    $khuService = Yii::$app->get(KhuKtxServiceInterface::ServiceName);
                    $listKhu = $khuService->getAllNameKhu();
                    return [
                        'dataProvider' => $result['dataProvider'],
                        'searchModel' => $result['searchModel'],
                        'listKhu' => $listKhu,
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
                    $khuService = Yii::$app->get(KhuKtxServiceInterface::ServiceName);
                    /** @var KhuKtxServiceInterface $khuService */
                    $listKhu = $khuService->getAllNameKhu();
                    return [
                        'model' => $model,
                        'listKhu' => $listKhu,
                    ];
                }
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'doUpdate' => function($id, $postData, $updateAction) use($service){
                    return $service->update($id, $postData);
                },
                'data' => function($id, $updateResultModel, $updateAction) use($service){
                    $khuService = Yii::$app->get(KhuKtxServiceInterface::ServiceName);
                    $listKhu = $khuService->getAllNameKhu();
                    $model = $updateResultModel === null ? $service->getDetail($id) : $updateResultModel;
                    return [
                        'model' => $model,
                        'listKhu' => $listKhu,
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
    public  function  actionThietBiPhongO($id)
    {

    }
}
