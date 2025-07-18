<?php

namespace backend\controllers;

use common\models\ChiTietKhoanThu;
use common\models\PhongO;
use common\services\KhoanPhiServiceInterface;
use common\services\LopServiceInterface;
use common\services\PhongOServiceInterface;
use common\services\ThongTinHocSinhServiceInterface;
use Yii;
use common\services\ThuPhiNoiTruServiceInterface;
use common\services\ThuPhiNoiTruService;
use backend\actions\CreateAction;
use backend\actions\UpdateAction;
use backend\actions\IndexAction;
use backend\actions\DeleteAction;
use backend\actions\SortAction;
use backend\actions\ViewAction;
/**
 * ThuPhiNoiTruController implements the CRUD actions for ThuPhiNoiTru model.
 */
class ThuPhiNoiTruController extends \yii\web\Controller
{
    public function actions()
    {
        /** @var ThuPhiNoiTruServiceInterface $service */
        $service = Yii::$app->get(ThuPhiNoiTruServiceInterface::ServiceName);
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

                    $modelsChiTiet = [new ChiTietKhoanThu()];
                    /** @var KhoanPhiServiceInterface $khoanPhiService */
                    $khoanPhiService = Yii::$app->get(KhoanPhiServiceInterface::ServiceName);
                    $listKhoan = $khoanPhiService->getOptionsKhoanPhi();
                    $listGia = $khoanPhiService->getGiaKhoanPhi();
                    /** @var ThongTinHocSinhServiceInterface $tTHSService */
                    $tTHSService = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
                    $listTTHS = $tTHSService->getAllNameHocSinh();
                    /** @var PhongOServiceInterface $phongOService */
                    $phongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $listPhongO= $phongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'modelsChiTiet' => $modelsChiTiet,
                        'listKhoan' => $listKhoan,
                        'listTTHS' => $listTTHS,
                        'listPhongO' => $listPhongO,
                        'listGia' => $listGia,
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
                    $modelsChiTiet = ChiTietKhoanThu::findAll(['thu_phi_noi_tru_id' => $id]);
                    /** @var KhoanPhiServiceInterface $khoanPhiService */
                    $khoanPhiService = Yii::$app->get(KhoanPhiServiceInterface::ServiceName);
                    $listKhoan = $khoanPhiService->getOptionsKhoanPhi();
                    $listGia = $khoanPhiService->getGiaKhoanPhi();
                    /** @var ThongTinHocSinhServiceInterface $tTHSService */
                    $tTHSService = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
                    $listTTHS = $tTHSService->getAllNameHocSinh();
                    /** @var PhongOServiceInterface $phongOService */
                    $phongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $listPhongO= $phongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'modelsChiTiet' => $modelsChiTiet,
                        'listKhoan' => $listKhoan,
                        'listTTHS' => $listTTHS,
                        'listPhongO' => $listPhongO,
                        'listGia' => $listGia,
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
