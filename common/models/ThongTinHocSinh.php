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
 * @property int $created_at
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
class ThongTinHocSinh extends \yii\db\ActiveRecord
{
    public $username;
    public $email;
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%thong_tin_hoc_sinh}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'lop_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['ho_va_ten', 'ngay_sinh', 'ngay_bat_dau','email','cccd','username'], 'required'],
            [['ngay_sinh', 'ngay_bat_dau'], 'safe'],
            [['diem_trung_binh'], 'number'],
            [['ghi_chu'], 'string'],
            [['anh_chan_dung','anh_cccd_sau','anh_cccd_truoc'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['ho_va_ten', 'cccd', 'email','dia_chi', 'sdt_ca_nhan', 'sdt_gia_dinh', 'ten_day_du', 'que_quan','username','password'], 'string', 'max' => 255],
            [['lop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lop::className(), 'targetAttribute' => ['lop_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['password', 'string', 'min' => 6, 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'lop_id' => Yii::t('app', 'Lop ID'),
            'ho_va_ten' => Yii::t('app', 'Ho Va Ten'),
            'ngay_sinh' => Yii::t('app', 'Ngay Sinh'),
            'cccd' => Yii::t('app', 'Cccd'),
            'dia_chi' => Yii::t('app', 'Dia Chi'),
            'sdt_ca_nhan' => Yii::t('app', 'Sdt Ca Nhan'),
            'sdt_gia_dinh' => Yii::t('app', 'Sdt Gia Dinh'),
            'ten_day_du' => Yii::t('app', 'Ten Day Du'),
            'que_quan' => Yii::t('app', 'Que Quan'),
            'anh_cccd_truoc' => Yii::t('app', 'Anh Cccd Truoc'),
            'anh_cccd_sau' => Yii::t('app', 'Anh Cccd Sau'),
            'anh_chan_dung' => Yii::t('app', 'Anh Chan Dung'),
            'trang_thai' => Yii::t('app', '0-Đã Tốt nghiệp,1-Đã rời đi, 2 chờ duyệt'),
            'diem_trung_binh' => Yii::t('app', 'Diem Trung Binh'),
            'ngay_bat_dau' => Yii::t('app', 'Ngay Bat Dau'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYTes()
    {
        return $this->hasMany(YTe::className(), ['hoc_sinh_id' => 'id']);
    }
    public function beforeValidate()
    {
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
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

}
