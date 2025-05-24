<?php

namespace frontend\controllers;

use common\models\ThongTinHocSinh;
use common\models\Tickets;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TicketsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'logout', 'lich-su-dong-tien', 'thong-bao'],
                'rules' => [
                    // Trang chỉ dành cho người đã đăng nhập
                    [
                        'actions' => ['index', 'lich-su-dong-tien', 'thong-bao'],
                        'allow' => true,
                        'roles' => ['@'], // @ = đã đăng nhập
                    ],
                    // Cho phép logout nếu đã đăng nhập
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'], // Cho phép POST và GET nếu cần
                ],
            ],
        ];
    }
    public function actionCreate()
    {
        $model = new Tickets();

        if ($model->load(\Yii::$app->request->post()))
        {
            if($model->isAnDanh == false){
                $model->user_id = Yii::$app->user->identity->id;

            }

            if ($model->save()) {
                \Yii::$app->session->setFlash('success', 'Yêu cầu đã được gửi thành công.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    protected function findModel($id)
    {
        if (($model = Tickets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Không tìm thấy yêu cầu.');
    }
    public function actionIndex()
    {
        $query = Tickets::find()->where([
            'user_id' => \Yii::$app->user->id
        ])
        ->orderBy(['created_at' => SORT_DESC]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Chỉ cho sửa nếu trạng thái là "mới"
        if ($model->trang_thai !== 'open') {
            Yii::$app->session->setFlash('warning', 'Chỉ được phép sửa các yêu cầu chưa được duyệt.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Yêu cầu đã được cập nhật.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

}