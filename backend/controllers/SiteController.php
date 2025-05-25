<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

namespace backend\controllers;

use common\models\DiemDanh;
use common\models\Lop;
use common\models\ThongTinHocSinh;
use common\models\ThuPhiNoiTru;
use common\models\ViPhamNoiQuy;
use common\services\OrderServiceInterface;
use common\services\ProductServiceInterface;
use common\services\UnitTransactionServiceInterface;
use Yii;
use Exception;
use common\services\CommentServiceInterface;
use common\services\MenuService;
use backend\models\form\LoginForm;
use common\libs\ServerInfo;
use yii\base\UserException;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\HttpException;
use yii\captcha\CaptchaAction;

/**
 * Site default controller
 *
 * - description:
 *          - site/index is index page(framework)
 *          - site/main is the iframe default page
 *          - site/login backend login page
 *          - site/logout backend user logout
 *          - site/language multi language change
 *          - site/error backend error unify handler
 *
 * Class SiteController
 * @package backend\controllers
 */
class SiteController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' =>['login', 'captcha', 'language'],//no need login actions
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],//"@" represent authenticated user; "?" means guest user (not authenticated yet).
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],//logout action only permit POST request
                ],
            ],
        ];
    }

    public function actions()
    {
        $captcha = [
            'class' => CaptchaAction::className(),
            'backColor' => 0x66b3ff,//captcha background color
            'maxLength' => 4,//captcha max count of characters
            'minLength' => 4,//captcha min count of characters
            'padding' => 6,
            'height' => 34,
            'width' => 100,
            'foreColor' => 0xffffff,//captcha character color
            'offset' => 13,//offset between characters
        ];
        if( YII_ENV_TEST ) $captcha = array_merge($captcha, ['fixedVerifyCode'=>'testme']);
        return [
            'captcha' => $captcha,
        ];
    }

    /**
     * backend index page(backend default action)
     *
     * @return string
     * @throws yii\base\InvalidConfigException
     * @throws \Throwable
     */
    public function actionIndex()
    {
        $service = new MenuService();
       $menus = $service->getAuthorizedBackendMenusByUserId(Yii::$app->getUser()->getId());
        return $this->renderPartial('index', [
            "menus" => $menus,
            'identity' => Yii::$app->getUser()->getIdentity(),
        ]);
    }

    /**
     * backend main info page(default right iframe page)
     *
     * @return string
     * @throws yii\base\InvalidConfigException
     */
    function getNgayHocThucTe($startDate, $endDate)
    {
        $ds = [];
        $cur = strtotime($startDate);
        $end = strtotime($endDate);
        while ($cur <= $end) {
            $thu = date('N', $cur); // 1=Thứ 2, 7=CN
            if ($thu <= 5) $ds[] = date('Y-m-d', $cur);
            $cur = strtotime('+1 day', $cur);
        }
        return $ds;
    }

    public function actionMain($startDate = null, $endDate = null)
    {
        $start = date('Y-m-01');
        $end = date('Y-m-d');

        $tongTienThu = ThuPhiNoiTru::find() // bảng chứa dữ liệu thu tiền
            ->where(['between', 'ngay_thu', date('Y-m-01'), date('Y-m-t')])
            ->sum('so_tien') ?: 0;
        $tongTienDangNo = ThuPhiNoiTru::find() // bảng chứa dữ liệu thu tiền
            ->where(['between', 'ngay_thu', date('Y-m-01'), date('Y-m-t')])
            ->andWhere(['trang_thai' => 0])
            ->sum('so_tien') ?: 0;
        $thucNhan = ThuPhiNoiTru::find() // bảng chứa dữ liệu thu tiền
            ->where(['between', 'ngay_thu', date('Y-m-01'), date('Y-m-t')])
            ->andWhere(['trang_thai' => 1])
            ->sum('so_tien') ?: 0;
        $topViPham = ViPhamNoiQuy::find()
            ->alias('vp')
            // JOIN học sinh
            ->innerJoin(ThongTinHocSinh::tableName() . ' hs', 'hs.id = vp.hoc_sinh_id')
            // JOIN lớp qua học sinh
            ->innerJoin(Lop::tableName() . ' l', 'l.id = hs.lop_id')
            ->select([
                'hs.ho_va_ten',
                'l.ten_lop',
                'COUNT(*) AS so_vp',
            ])
//            ->where(['between', 'vp.ngay_vi_pham', $start, $end])
            ->groupBy('vp.hoc_sinh_id')
            ->orderBy(['so_vp' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all();
        $raw = DiemDanh::find()
            ->select(['hoc_sinh_id', 'COUNT(DISTINCT ngay_diem_danh) AS so_co_mat'])
            ->where(['between', 'ngay_diem_danh', $start, $end])
            ->groupBy('hoc_sinh_id')
            ->orderBy(['so_co_mat' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all();
        $ngayHocThucTe = $this->getNgayHocThucTe($start, $end);
        $tongNgayHoc = count($ngayHocThucTe);
        $ids = array_column($raw, 'hoc_sinh_id');
        $hocSinhs = ThongTinHocSinh::find()
            ->with('lop')
            ->where(['id' => $ids])
            ->indexBy('id')
            ->all();

// B4: Tổng hợp dữ liệu
        $topVang = [];
        foreach ($raw as $row) {
            $hs = $hocSinhs[$row['hoc_sinh_id']] ?? null;
            if (!$hs) continue;

            $soCoMat = (int)$row['so_co_mat'];
            $soVang = max(0, $tongNgayHoc - $soCoMat);

            $topVang[] = [
                'ho_va_ten' => $hs->ho_va_ten,
                'ten_lop' => $hs->lop->ten_lop ?? '-',
                'so_co_mat' => $soCoMat,
                'so_vang' => $soVang,

            ];
        }
        $soHocSinh = ThongTinHocSinh::find()->where(['trang_thai' => 1])->count();
//        echo $soHocSinh;
        $tongViPham = ViPhamNoiQuy::find()->where(['between', 'ngay_vi_pham', $start, $end])->count();
        return $this->render('main', [
            'topViPham' => $topViPham,
            'topVang' => $topVang,
            'tongViPham' => $tongViPham,
            'tongTienThu' => $tongTienThu,
            'tongTienDangNo' => $tongTienDangNo,
            'thucNhan' => $thucNhan,
            'soHocSinh' => $soHocSinh,

        ]);
    }

    /**
     * admin login
     *
     * @return string|yii\web\Response
     */
    public function actionLogin()
    {
        if (! Yii::$app->getUser()->getIsGuest()) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * admin logout
     *
     * @return yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->logout(false);

        return $this->goHome();
    }

    /**
     *language change
     *
     */
    public function actionLanguage()
    {
        $language = Yii::$app->getRequest()->get('lang');
        if (isset($language)) {
            $session = Yii::$app->getSession();
            $session->set("language", Html::encode($language));
        }
        $this->goBack(Yii::$app->getRequest()->headers['referer']);
    }

    /**
     * backend unify exception handler
     *
     * @return string
     */
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($exception instanceof Exception) {
            $name = $exception->getName();
        } else {
            $name = Yii::t('yii', 'Error');
        }
        if ($code) {
            $name .= " (#$code)";
        }

        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = Yii::t('yii', 'An internal server error occurred.');
        }
        $statusCode = $exception->statusCode ? $exception->statusCode : 500;
        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render('error', [
                'code' => $statusCode,
                'name' => $name,
                'message' => $message
            ]);
        }
    }

}
