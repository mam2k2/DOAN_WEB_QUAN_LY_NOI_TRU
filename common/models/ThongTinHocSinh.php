<?php

namespace common\models;

use common\helpers\Util;
use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%thong_tin_hoc_sinh}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $lop_id
 * @property string $ho_va_ten
 * @property string $ngay_sinh
 * @property string $cccd
 * @property string $dia_chi
 * @property string $sdt_ca_nhan
 * @property string $sdt_gia_dinh
 * @property string $ten_day_du
 * @property string $que_quan
 * @property string $anh_cccd_truoc
 * @property string $anh_cccd_sau
 * @property string $anh_chan_dung
 * @property int $trang_thai 0-Đã Tốt nghiệp,1-Đã rời đi, 2 chờ duyệt
 * @property string $diem_trung_binh
 * @property string $ngay_bat_dau
 * @property string $ghi_chu
 * @property string $truong_thpt
 * @property string $truong_thcs
 * @property string $trinh_do_dao_tao
 * @property int $uu_tien
 * @property int $created_at
 * @property int $phu_huynh_user_id
 * @property int $updated_at
 *
 * @property DiemDanh[] $diemDanhs
 * @property PhongOHocSinh[] $phongOHocSinhs
 * @property Lop $lop
 * @property User $user
 * @property ThuPhiNoiTru[] $thuPhiNoiTrus
 * @property ViPhamNoiQuy[] $viPhamNoiQuies
 * @property YTe[] $yTes
 */
class ThongTinHocSinh extends BaseModel
{
    const KHONG_UU_IEN = 0;
    const HO_NGHEO_VUNG_CAO = 10;
    const THUONG_BINH_LIET_SI = 100;

    public $usernamePH;
    public $acceptRules;
    public $username;
    public $emailPH;
    public $email;
    public $passwordPH;
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%thong_tin_hoc_sinh}}';
    }
    public static function getUuTien()
    {
        return [
            self::KHONG_UU_IEN => "Không",
            self::HO_NGHEO_VUNG_CAO => "Hộ nghèo & Vùng cao",
            self::THUONG_BINH_LIET_SI => "Thương binh/ liệt sĩ"
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['acceptRules'], 'boolean'],
            [['acceptRules'], 'compare', 'compareValue' => true, 'message' => 'Bạn phải đồng ý với nội quy.'],
            [['user_id', 'lop_id', 'trang_thai', 'created_at', 'updated_at','phong_id','phu_huynh_user_id','uu_tien'], 'integer'],
            [['ho_va_ten', 'ngay_sinh', 'ngay_bat_dau','email','uu_tien','emailPH','cccd','truong_thcs',"truong_thpt","trinh_do_dao_tao"], 'required'],
            [['anh_chan_dung','anh_cccd_sau','anh_cccd_truoc'], 'required','when' => function ($model) {
                return $model->isNewRecord;
            }, 'whenClient' => "function (attribute, value) {
        return $('form').data('is-new') === 1;
    }"],
            [['ngay_sinh', 'ngay_bat_dau'], 'safe'],
            [['cccd'],'unique'],
            [['diem_trung_binh'], 'number'],
            [['ghi_chu'], 'string'],
            [['anh_chan_dung','anh_cccd_sau','anh_cccd_truoc'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['ho_va_ten', 'cccd', 'email','dia_chi', 'sdt_ca_nhan', 'sdt_gia_dinh', 'ten_day_du', 'que_quan','username','password','passwordPH','truong_thcs',"truong_thpt","trinh_do_dao_tao"], 'string', 'max' => 255],
            [['lop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lop::className(), 'targetAttribute' => ['lop_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['phu_huynh_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['phu_huynh_user_id' => 'id']],
            ['password', 'string', 'min' => 6, 'skipOnEmpty' => true],
            ['passwordPH', 'string', 'min' => 6, 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Mã'),
            'user_id' => Yii::t('app', 'Mã học sinh'),
            'lop_id' => Yii::t('app', 'Mã lớp'),
            'ho_va_ten' => Yii::t('app', 'Họ và tên'),
            'ngay_sinh' => Yii::t('app', 'Ngày sinh'),
            'cccd' => Yii::t('app', 'Số CCCD'),
            'dia_chi' => Yii::t('app', 'Địa chỉ'),
            'sdt_ca_nhan' => Yii::t('app', 'Sdt cá nhân'),
            'sdt_gia_dinh' => Yii::t('app', 'Sđt gia đình'),
            'ten_day_du' => Yii::t('app', 'Tên đầy đủ'),
            'que_quan' => Yii::t('app', 'Quê quán'),
            'anh_cccd_truoc' => Yii::t('app', 'Ảnh CCCD trước'),
            'anh_cccd_sau' => Yii::t('app', 'Ảnh CCCD sau'),
            'anh_chan_dung' => Yii::t('app', 'Ảnh chân dung'),
            'trang_thai' => Yii::t('app', 'Trạng thái'),
            'diem_trung_binh' => Yii::t('app', 'Điểm trung binh'),
            'ngay_bat_dau' => Yii::t('app', 'Ngày bt đầu'),
            'ghi_chu' => Yii::t('app', 'Ghi chú'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'phu_huynh_user_id' => Yii::t('app', 'Phụ huynh'),
            'trinh_do_dao_tao' => 'Trình độ đào tạo',
            'truong_thcs' => 'Trường THCS',
            'truong_thpt' => 'Trường THPT',
            "uu_tien" => "Ưu tiên"
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiemDanhs()
    {
        return $this->hasMany(DiemDanh::className(), ['hoc_sinh_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongOHocSinhs()
    {
        return $this->hasMany(PhongOHocSinh::className(), ['hoc_sinh_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLop()
    {
        return $this->hasOne(Lop::className(), ['id' => 'lop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThuPhiNoiTrus()
    {
        return $this->hasMany(ThuPhiNoiTru::className(), ['hoc_sinh_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViPhamNoiQuies()
    {
        return $this->hasMany(ViPhamNoiQuy::className(), ['hoc_sinh_id' => 'id']);
    }
    public function getPhongO()
    {
        return $this->hasOne(PhongO::className(), ['id' => 'phong_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYTes()
    {
        return $this->hasMany(YTe::className(), ['hoc_sinh_id' => 'id']);
    }
    public function beforeValidate()
    {
//        VarDumper::dump(Yii::getAlias('@webroot'));
//        exit();
        if($this->anh_chan_dung !== "0") {//为0表示需要删除图片，Util::handleModelSingleFileUpload()会有判断删除图片
            $this->anh_chan_dung = UploadedFile::getInstance($this, "anh_chan_dung");
        }
        if($this->anh_cccd_truoc !== "0") {//为0表示需要删除图片，Util::handleModelSingleFileUpload()会有判断删除图片
            $this->anh_cccd_truoc = UploadedFile::getInstance($this, "anh_cccd_truoc");
        }
        if($this->anh_cccd_sau !== "0") {//为0表示需要删除图片，Util::handleModelSingleFileUpload()会有判断删除图片
            $this->anh_cccd_sau = UploadedFile::getInstance($this, "anh_cccd_sau");
        }
        return parent::beforeValidate();
    }
    public function beforeSave($insert)
    {
        Util::handleModelSingleFileUpload($this, 'anh_chan_dung', $insert, '@webroot/../uploads/avatar/');
        Util::handleModelSingleFileUpload($this, 'anh_cccd_truoc', $insert, '@webroot/../uploads/avatar/');
        Util::handleModelSingleFileUpload($this, 'anh_cccd_sau', $insert, '@webroot/../uploads/avatar/');

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
    public function getEmail()
    {
        return $this->user ? $this->user->email : null;
    }
    public function afterFind()
    {

        if ($this->user) {
            $this->email = $this->user->email;
            $this->username = $this->user->username;
        }
        $phuHuynh = User::findOne($this->phu_huynh_user_id);
        if ($phuHuynh) {
            $this->emailPH = $phuHuynh->email;
            $this->usernamePH = $phuHuynh->username;
        }
        parent::afterFind(); // TODO: Change the autogenerated stub
    }
    public function getTenPhong()
    {
        return $this->phongO == null ?   null : $this->phongO->ten_phong;
    }
    public function getDaDiemDanh()
    {
        $startOfDay = date('Y-m-d 00:00:00');
        $endOfDay = date('Y-m-d 23:59:59');

        $result = DiemDanh::find()
            ->where(['hoc_sinh_id' => $this->id])
            ->andWhere(['between', 'ngay_diem_danh', $startOfDay, $endOfDay])
            ->one();
       return !is_null( $result);
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        $phongOHocSinh = PhongOHocSinh::find()->where([
            'hoc_sinh_id' => $this->id,
            'phong_id' => $this->phong_id,
            'trang_thai' => 1
        ])->one();

        if($phongOHocSinh == null)
        {
            $phongOHocSinhs = PhongOHocSinh::find()->where([ 'hoc_sinh_id' => $this->id, 'trang_thai' => 1 ])->all();
            foreach($phongOHocSinhs as $phongOHocSinh){
                $phongOHocSinh->trang_thai = 0;
                $phongOHocSinh->save();
            }
            $phongOHocSinh = new PhongOHocSinh();
            $phongOHocSinh->hoc_sinh_id = $this->id;
            $phongOHocSinh->phong_id = $this->phong_id;
            $phongOHocSinh->trang_thai = 1;
            $phongOHocSinh->thoi_gian_bat_dau = date('Y-m-d');
            $phongOHocSinh->save();

//            VarDumper::dump($phongOHocSinh,10,true);
//            exit();
        }
    }
    public function validateSucChua($attribute, $params)
    {
        $phong = \common\models\PhongO::findOne($this->phong_id); // đổi namespace nếu cần

        if ($phong === null) {
            $this->addError($attribute, 'Phòng được chọn không tồn tại.');
            return;
        }
        $phongOHocSinh = PhongOHocSinh::find()->where([
            'hoc_sinh_id' => $this->id,
            'phong_id' => $this->phong_id,
            'trang_thai' => 1
        ])->one();

        if($phongOHocSinh == null)
        {
            $soLuongHienTai = PhongO::find()
                ->where(['id' => $this->phong_id])
                ->count();

            if ($soLuongHienTai + 1 > $phong->suc_chua) {
                $this->addError($attribute, "Phòng đã đầy. Sức chứa tối đa: {$phong->suc_chua}.");
            }
        }

    }
    public function getTrangThaiText()
    {
        return self::TrangThaiList()[$this->trang_thai] ?? 'Không xác định';
    }
    public function getTrangThaiBadgeColor()
    {
        switch ($this->trang_thai) {
            case 1: return 'success';     // Đang học
            case 2: return 'warning';     // Bảo lưu
            case 3: return 'info';        // Chờ duyệt
            case 0: return 'secondary';   // Đã tốt nghiệp
            default: return 'dark';
        }
    }
    public static function TrangThaiList()
    {
        return [
            0 => 'Đã tốt nghiệp',
            1 => 'Đang học',
            2 => 'Bảo lưu',
            3 => 'Chờ duyệt'
        ];
    }
    public function afterDelete()
    {
        if($this->user != null)
        {
            $user = $this->user;
            $user->status = User::STATUS_DELETED;
            $user->save();
        }
        $userPhuHuynh = User::findOne(['id' => $this->phu_huynh_user_id]);
        if($userPhuHuynh != null)
        {
            $userPhuHuynh->status = User::STATUS_DELETED;
            $userPhuHuynh->save();
        }
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }

}
