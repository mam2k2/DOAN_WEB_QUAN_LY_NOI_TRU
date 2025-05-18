<?php

namespace backend\controllers;

use common\models\DiemDanh;
use common\models\ThongTinHocSinh;
use common\services\DiemDanhServiceInterface;
use common\services\LopServiceInterface;
use common\services\PhongOServiceInterface;
use Yii;
use common\services\ThongTinHocSinhServiceInterface;
use common\services\ThongTinHocSinhService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
use yii\filters\VerbFilter;

/**
 * ThongTinHocSinhController implements the CRUD actions for ThongTinHocSinh model.
 */
class ThongTinHocSinhController extends \yii\web\Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'diem-danh' => ['GET'], // chỉ chấp nhận GET
                ],
            ],
        ]);
    }

    public function actions()
    {
        /** @var ThongTinHocSinhServiceInterface $service */
        $service = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
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
                    /** @var LopServiceInterface $lopService */
                    $lopService = Yii::$app->get(LopServiceInterface::ServiceName);
                    $lopList = $lopService->getLopOptions();
                    /** @var PhongOServiceInterface $PhongOService */
                    $PhongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $phongList = $PhongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'listLop' => $lopList,
                        'phongList' => $phongList,
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
                    /** @var LopServiceInterface $lopService */
                    $lopService = Yii::$app->get(LopServiceInterface::ServiceName);
                    $lopList = $lopService->getLopOptions();
                    /** @var PhongOServiceInterface $PhongOService */
                    $PhongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $phongList = $PhongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'listLop' => $lopList,
                        'phongList' => $phongList,
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
    public function actionDiemDanh($id)
    {
        /** @var DiemDanhServiceInterface $diemDanhService */

        $diemDanhService = Yii::$app->get(DiemDanhServiceInterface::ServiceName);
        /** @var ThongTinHocSinhServiceInterface $service */
        $service = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
        /** @var ThongTinHocSinh $tTHS */
        $tTHS = $service->getDetail($id);
        if($tTHS != null)
        {
            if($tTHS->trang_thai != 1)
            {
                return Yii::$app->getResponse()->redirect(['thong-tin-hoc-sinh/index']);
            }
            if($tTHS->daDiemDanh == false)
            {
                $model = new DiemDanh();
                $model->hoc_sinh_id = $id;
                $model->phong_id = $tTHS->phong_id;
                $model->ngay_diem_danh =date('Y-m-d H:i:s');
                $model->thoi_gian = date('Y-m-d H:i:s');
                $model->save();
            }
        }
        return Yii::$app->getResponse()->redirect(['thong-tin-hoc-sinh/index']);
    }
}
