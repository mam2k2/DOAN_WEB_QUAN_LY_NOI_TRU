<?php

namespace frontend\controllers;

use common\models\ChiTietKhoanThu;
use common\models\DiemDanh;
use common\models\ThongBaoHeThong;
use common\models\ThongTinHocSinh;
use common\models\ThuPhiNoiTru;
use common\models\User;
use common\models\ViPhamNoiQuy;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;

class ThongTinCaNhanController extends Controller
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
    public function actionIndex()
    {
        $user = User::findIdentity(\Yii::$app->user->id);
        $thongTin = ThongTinHocSinh::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->orWhere(['phu_huynh_user_id' => \Yii::$app->user->id])
            ->one();
//        VarDumper::dump($thongTin);
//        exit();
        return $this->render('index', [
            'thongtin' => $thongTin,
        ]);
    }
    public function actionLichSuDongTien()
    {
        $user = User::findIdentity(\Yii::$app->user->id);
        $thongTin = ThongTinHocSinh::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->orWhere(['phu_huynh_user_id' => \Yii::$app->user->id])
            ->one();
        $res = ThuPhiNoiTru::find()->where(['hoc_sinh_id' => $thongTin->id])->all();
        return $this->render('lich-su-dong-tien', [
            'res' => $res,
        ]);
    }
    public function actionThongBao()
    {
        $allThongBao = ThongBaoHeThong::find()->all();
        return $this->render('thong-bao', [
            'allThongBao' => $allThongBao,
        ]);
    }
    public function actionLichSuViPham()
    {
        $thongTin = ThongTinHocSinh::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->orWhere(['phu_huynh_user_id' => \Yii::$app->user->id])
            ->one();
        $viPham = ViPhamNoiQuy::findAll(['hoc_sinh_id' => $thongTin->id]);
        return $this->render('lich-su-vi-pham', [
            'viPham' => $viPham,
        ]);
    }
    public function actionLichSuDiemDanh()
    {
        $thongTin = ThongTinHocSinh::find()
        ->where(['user_id' => \Yii::$app->user->id])
        ->orWhere(['phu_huynh_user_id' => \Yii::$app->user->id])
        ->one();

        $startCurrent = new \DateTime('first day of this month');
        $endCurrent = new \DateTime();

        $startLast = (clone $startCurrent)->modify('-1 month');
        $endLast = (clone $startCurrent)->modify('-1 day');

        $diemDanhs = DiemDanh::find()
            ->select('ngay_diem_danh')
            ->where(['hoc_sinh_id' => $thongTin->id])
            ->andWhere(['between', 'ngay_diem_danh', $startLast->format('Y-m-d 00:00:00'), $endCurrent->format('Y-m-d 23:59:59')])
            ->asArray()
            ->all();

        $ngayDaDiemDanh = array_map(fn($row) => (new \DateTime($row['ngay_diem_danh']))->format('Y-m-d'), $diemDanhs);

        function generateLich($from, $to, $ngayDaDiemDanh) {
            $period = new \DatePeriod($from, new \DateInterval('P1D'), $to->modify('+1 day'));
            $lich = [];

            foreach ($period as $date) {
                $ngay = $date->format('Y-m-d');
                $lich[] = [
                    'ngay' => $ngay,
                    'trang_thai' => in_array($ngay, $ngayDaDiemDanh) ? 'Có mặt' : 'Vắng không phép',
                ];
            }

            return $lich;
        }

        $lichThangTruoc = generateLich($startLast, $endLast, $ngayDaDiemDanh);
        $lichThangNay = generateLich($startCurrent, $endCurrent, $ngayDaDiemDanh);

        return $this->render('lich-su-diem-danh', [
            'lichThangTruoc' => $lichThangTruoc,
            'lichThangNay' => $lichThangNay,
            'thongTin' => $thongTin,
        ]);
    }
    public function actionLichSuChiTiet($id)
    {
        $thongTin = ThongTinHocSinh::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->orWhere(['phu_huynh_user_id' => \Yii::$app->user->id])
            ->one();
        $thuPhi = ThuPhiNoiTru::findOne(['id' => $id]);
        if($thuPhi == null){
            $this->goBack();
        }
        if($thuPhi->hoc_sinh_id != $thongTin->id)
        {
            $this->goBack();
        }
        $thongTinChiTiets = ChiTietKhoanThu::findAll(['thu_phi_noi_tru_id' => $thuPhi->id]);
        return $this->render('lich-su-chi-tiet', [
            'thuPhi' => $thuPhi,
            'thongTinChiTiets' => $thongTinChiTiets,
            'thongTin' => $thongTin,
        ]);
    }
    public function actionPhanAnhYKien($id)
    {
        $thongTin = ThongTinHocSinh::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->orWhere(['phu_huynh_user_id' => \Yii::$app->user->id])
            ->one();
        $thuPhi = ThuPhiNoiTru::findOne(['id' => $id]);
        if($thuPhi == null){
            $this->goBack();
        }
        if($thuPhi->hoc_sinh_id != $thongTin->id)
        {
            $this->goBack();
        }
        $thongTinChiTiets = ChiTietKhoanThu::findAll(['thu_phi_noi_tru_id' => $thuPhi->id]);
        return $this->render('lich-su-chi-tiet', [
            'thuPhi' => $thuPhi,
            'thongTinChiTiets' => $thongTinChiTiets,
            'thongTin' => $thongTin,
        ]);
    }


}