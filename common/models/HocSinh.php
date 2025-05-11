<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id user id(auto increment)
 * @property string $username username
 * @property string $auth_key auth key for generate logged in cookie
 * @property string $password_hash crypt password
 * @property string $password_reset_token reset password temp token
 * @property string $email user email
 * @property string $avatar avatar url
 * @property string $access_token token
 * @property int $status user status, (normal:10)
 * @property int $created_at created at
 * @property int $updated_at updated at
 *
 * @property DiemDanh[] $diemDanhs
 * @property PhongOHocSinh[] $phongOHocSinhs
 * @property ThongBaoHeThong[] $thongBaoHeThongs
 * @property ThongTinHocSinh[] $thongTinHocSinhs
 * @property ThuPhiNoiTru[] $thuPhiNoiTrus
 * @property ViPhamNoiQuy[] $viPhamNoiQuies
 * @property YTe[] $yTes
 */
class HocSinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['access_token'], 'string', 'max' => 42],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'user id(auto increment)'),
            'username' => Yii::t('app', 'username'),
            'auth_key' => Yii::t('app', 'auth key for generate logged in cookie'),
            'password_hash' => Yii::t('app', 'crypt password'),
            'password_reset_token' => Yii::t('app', 'reset password temp token'),
            'email' => Yii::t('app', 'user email'),
            'avatar' => Yii::t('app', 'avatar url'),
            'access_token' => Yii::t('app', 'token'),
            'status' => Yii::t('app', 'user status, (normal:10)'),
            'created_at' => Yii::t('app', 'created at'),
            'updated_at' => Yii::t('app', 'updated at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiemDanhs()
    {
        return $this->hasMany(DiemDanh::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongOHocSinhs()
    {
        return $this->hasMany(PhongOHocSinh::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThongBaoHeThongs()
    {
        return $this->hasMany(ThongBaoHeThong::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThongTinHocSinhs()
    {
        return $this->hasMany(ThongTinHocSinh::className(), ['user_id' => 'id']);
    }
    public function getThongTinHocSinh()
    {
        return $this->hasOne(ThongTinHocSinh::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThuPhiNoiTrus()
    {
        return $this->hasMany(ThuPhiNoiTru::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViPhamNoiQuies()
    {
        return $this->hasMany(ViPhamNoiQuy::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYTes()
    {
        return $this->hasMany(YTe::className(), ['user_id' => 'id']);
    }
    public function getHo_va_ten()
    {
        return $this->thongTinHocSinh->ho_va_ten ?? null;
    }

    public function getNgay_sinh()
    {
        return $this->thongTinHocSinh->ngay_sinh ?? null;
    }

    public function getCccd()
    {
        return $this->thongTinHocSinh->cccd ?? null;
    }

    public function getDia_chi()
    {
        return $this->thongTinHocSinh->dia_chi ?? null;
    }

    public function getSdt_ca_nhan()
    {
        return $this->thongTinHocSinh->sdt_ca_nhan ?? null;
    }

    public function getSdt_gia_dinh()
    {
        return $this->thongTinHocSinh->sdt_gia_dinh ?? null;
    }

    public function getTen_day_du()
    {
        return $this->thongTinHocSinh->ten_day_du ?? null;
    }

    public function getQue_quan()
    {
        return $this->thongTinHocSinh->que_quan ?? null;
    }

    public function getTrang_thai()
    {
        return $this->thongTinHocSinh->trang_thai ?? null;
    }

// Dạng mô tả rõ ràng trạng thái
    public function getTrang_thai_text()
    {
        $tt = $this->thongTinHocSinh->trang_thai ?? null;
        return $tt === 0 ? 'Đã tốt nghiệp' : ($tt === 1 ? 'Đã rời đi' : null);
    }

    public function getDiem_trung_binh()
    {
        return $this->thongTinHocSinh->diem_trung_binh ?? null;
    }

    public function getNgay_bat_dau()
    {
        return $this->thongTinHocSinh->ngay_bat_dau ?? null;
    }

    public function getGhi_chu()
    {
        return $this->thongTinHocSinh->ghi_chu ?? null;
    }

}
