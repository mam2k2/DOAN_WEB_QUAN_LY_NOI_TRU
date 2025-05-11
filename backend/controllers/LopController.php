<?php

namespace backend\controllers;

use common\services\AdminUserServiceInterface;
use common\services\KhoaServiceInterface;
use Yii;
use common\services\LopServiceInterface;
use common\services\LopService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * LopController implements the CRUD actions for Lop model.
 */
class LopController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var LopServiceInterface $service */
        $service = Yii::$app->get(LopServiceInterface::ServiceName);
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
                    /** @var KhoaServiceInterface $khoaService */
                    $khoaService = Yii::$app->get(KhoaServiceInterface::ServiceName);
                    $listKhoa = $khoaService->getOptionsKhoa();
                    /** @var AdminUserServiceInterface $giaoVienService */
                    $giaoVienService = Yii::$app->get(AdminUserServiceInterface::ServiceName);
                    $listKhoa = $khoaService->getOptionsKhoa();
                    $listGiaoVien = $giaoVienService->getGiaoVienOptions();
                    return [
                        'model' => $model,
                        'listKhoa' => $listKhoa,
                        'listGiaoVien' => $listGiaoVien
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
                    /** @var KhoaServiceInterface $khoaService */
                    $khoaService = Yii::$app->get(KhoaServiceInterface::ServiceName);
                    $listKhoa = $khoaService->getOptionsKhoa();
                    /** @var AdminUserServiceInterface $giaoVienService */
                    $giaoVienService = Yii::$app->get(AdminUserServiceInterface::ServiceName);
                    $listKhoa = $khoaService->getOptionsKhoa();
                    $listGiaoVien = $giaoVienService->getGiaoVienOptions();
                    return [
                        'model' => $model,
                        'listKhoa' => $listKhoa,
                        'listGiaoVien' => $listGiaoVien
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
