<?php

namespace backend\controllers;

use common\models\DiemDanh;
use common\models\ThongTinHocSinh;
use common\models\User;
use common\services\CategoryServiceInterface;
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
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

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
                    /** @var CategoryServiceInterface $categoryService */
                    $categoryService = Yii::$app->get(CategoryServiceInterface::ServiceName);
                    $thcsList = $categoryService->getCategoryMenu(['parent_id' => 57]);
                    $thptList = $categoryService->getCategoryMenu(['parent_id' => 4]);
                    $tinhThanhList = $categoryService->getCategoryMenu(['parent_id' => 98]);
                    /** @var LopServiceInterface $lopService */
                    $lopService = Yii::$app->get(LopServiceInterface::ServiceName);
                    $lopList = $lopService->getLopOptions();
                    $result = $service->getList($query);
                    return [
                        'dataProvider' => $result['dataProvider'],
                        'searchModel' => $result['searchModel'],
                        'lopList' => $lopList,
                        'tinhThanhList' => $tinhThanhList,
                        'thcsList' => $thcsList,
                        'thptList' => $thptList,
                    ];
                }
            ],
            'danh-sach-cho-duyet' => [
                'class' => IndexAction::className(),
                'data' => function($query, $indexAction) use($service){
                    /** @var CategoryServiceInterface $categoryService */
                    $categoryService = Yii::$app->get(CategoryServiceInterface::ServiceName);
                    $thcsList = $categoryService->getCategoryMenu(['parent_id' => 57]);
                    $thptList = $categoryService->getCategoryMenu(['parent_id' => 4]);
                    $tinhThanhList = $categoryService->getCategoryMenu(['parent_id' => 98]);
                    /** @var LopServiceInterface $lopService */
                    $lopService = Yii::$app->get(LopServiceInterface::ServiceName);
                    $lopList = $lopService->getLopOptions();
                    $result = $service->getListChoDuyet($query);
                    return [
                        'dataProvider' => $result['dataProvider'],
                        'searchModel' => $result['searchModel'],
                        'lopList' => $lopList,
                        'tinhThanhList' => $tinhThanhList,
                        'thcsList' => $thcsList,
                        'thptList' => $thptList,
                    ];
                },
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
                    /** @var CategoryServiceInterface $categoryService */
                    $categoryService = Yii::$app->get(CategoryServiceInterface::ServiceName);
                    $thcsList = $categoryService->getCategoryMenu(['parent_id' => 57]);
                    $thptList = $categoryService->getCategoryMenu(['parent_id' => 4]);
                    $tinhThanhList = $categoryService->getCategoryMenu(['parent_id' => 98]);
                    /** @var PhongOServiceInterface $PhongOService */
                    $PhongOService = Yii::$app->get(PhongOServiceInterface::ServiceName);
                    $phongList = $PhongOService->getAllNamePhong();
                    return [
                        'model' => $model,
                        'listLop' => $lopList,
                        'phongList' => $phongList,
                        'tinhThanhList' => $tinhThanhList,
                        'thcsList' => $thcsList,
                        'thptList' => $thptList,
                    ];
                }
            ],
            'update-cho-duyet' => [
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
                    /** @var CategoryServiceInterface $categoryService */
                    $categoryService = Yii::$app->get(CategoryServiceInterface::ServiceName);
                    $thcsList = $categoryService->getCategoryMenu(['parent_id' => 57]);
                    $thptList = $categoryService->getCategoryMenu(['parent_id' => 4]);
                    $tinhThanhList = $categoryService->getCategoryMenu(['parent_id' => 98]);
                    return [
                        'model' => $model,
                        'listLop' => $lopList,
                        'phongList' => $phongList,
                        'tinhThanhList' => $tinhThanhList,
                        'thcsList' => $thcsList,
                        'thptList' => $thptList,
                    ];
                },
                'successRedirect' => ['thong-tin-hoc-sinh/danh-sach-cho-duyet'],

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
                    /** @var CategoryServiceInterface $categoryService */
                    $categoryService = Yii::$app->get(CategoryServiceInterface::ServiceName);
                    $thcsList = $categoryService->getCategoryMenu(['parent_id' => 57]);
                    $thptList = $categoryService->getCategoryMenu(['parent_id' => 4]);
                    $tinhThanhList = $categoryService->getCategoryMenu(['parent_id' => 98]);
                    return [
                        'model' => $model,
                        'listLop' => $lopList,
                        'phongList' => $phongList,
                        'tinhThanhList' => $tinhThanhList,
                        'thcsList' => $thcsList,
                        'thptList' => $thptList,
                    ];
                },
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
    public function actionActive($id)
    {
        /** @var DiemDanhServiceInterface $diemDanhService */

        $diemDanhService = Yii::$app->get(DiemDanhServiceInterface::ServiceName);
        /** @var ThongTinHocSinhServiceInterface $service */
        $service = Yii::$app->get(ThongTinHocSinhServiceInterface::ServiceName);
        /** @var ThongTinHocSinh $tTHS */
        $tTHS = $service->getDetail($id);
        $tTHS->trang_thai = 1;
        $tTHS->save(false);
//        VarDumper::dump($tTHS,10,true);
//        exit();
        $user = $tTHS->user;
        $userPH = User::findOne(['id' => $tTHS->phu_huynh_user_id]);
        if($user != null){
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            $res = Yii::$app->mailer->compose() // hoặc ->compose('template', ['param' => value])
                ->setFrom(['quyetpro2k2@gmail.com' => 'Truong CĐ GTVT Đường Thủy I'])
                ->setTo($user->email)
                ->setSubject('Tài khoản của bạn đã được duyệt!')
                ->setTextBody('Tài khoản của bạn là : '. $user->username. ' , mật khẩu : 123456A@b') // không bắt buộc nếu có HTML
                ->send();
        }
        if($userPH != null)
        {
            $userPH->status = User::STATUS_ACTIVE;
            $userPH->save();
            $res = Yii::$app->mailer->compose() // hoặc ->compose('template', ['param' => value])
            ->setFrom(['quyetpro2k2@gmail.com' => 'Truong CĐ GTVT Đường Thủy I'])
                ->setTo($userPH->email)
                ->setSubject('Tài khoản của PH bạn đã được duyệt!')
                ->setTextBody('Tài khoản của bạn là : '. $userPH->username. ' , mật khẩu : 123456A@b') // không bắt buộc nếu có HTML
                ->send();

        }

        return Yii::$app->getResponse()->redirect(['thong-tin-hoc-sinh/danh-sach-cho-duyet']);
    }
}
