<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%thu_phi_noi_tru}}".
 *
 * @property int $id
 * @property int $hoc_sinh_id
// * @property int $khoan_phi_id
 * @property int $phong_id
 * @property string $so_tien
 * @property string $ngay_thu
 * @property string $nguoi_thu
 * @property int $trang_thai 0-Chưa thu,1-Đã thu
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property KhoanPhi $khoanPhi
 * @property PhongO $phong
 * @property ThongTinHocSinh $hocSinh
 */
class ThuPhiNoiTru extends BaseModel
{
    public const TRANGTHAI_DATHU = 1;
    public const TRANGTHAI_CHUATHU = 0;
    public static function getOptionsTrangThai()
    {
        return [
            self::TRANGTHAI_DATHU => 'Đã thu',
            self::TRANGTHAI_CHUATHU =>  'Chưa thu',
        ];
    }
    public static function getOptionsTrangThaiThaiText(){
        return [
            self::TRANGTHAI_DATHU => '<b class="text-success">Đã thu</b>',
            self::TRANGTHAI_CHUATHU =>  '<b class="text-danger">Chưa thu</b>',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%thu_phi_noi_tru}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoc_sinh_id', 'phong_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [[ 'phong_id', 'so_tien', 'ngay_thu'], 'required'],
            [['so_tien'], 'number'],
            [['ngay_thu'], 'safe'],
            [['ghi_chu'], 'string'],
            [['nguoi_thu'], 'string', 'max' => 100],
            [['phong_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhongO::className(), 'targetAttribute' => ['phong_id' => 'id']],
            [['hoc_sinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThongTinHocSinh::className(), 'targetAttribute' => ['hoc_sinh_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hoc_sinh_id' => Yii::t('app', 'Mã học sinh'),
            'phong_id' => Yii::t('app', 'Mã phòng'),
            'so_tien' => Yii::t('app', 'Số tiền'),
            'ngay_thu' => Yii::t('app', 'Ngày thu'),
            'nguoi_thu' => Yii::t('app', 'Người Thu'),
            'trang_thai' => Yii::t('app', 'Trạng thái'),
            'ghi_chu' => Yii::t('app', 'Ghi chú'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhong()
    {
        return $this->hasOne(PhongO::className(), ['id' => 'phong_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHocSinh()
    {
        return $this->hasOne(ThongTinHocSinh::className(), ['id' => 'hoc_sinh_id']);
    }
    public function getTenHocSinh()
    {
        return $this->hocSinh->ho_va_ten;
    }
    public function getTenPhong()
    {
        return $this->phong->ten_phong;
    }
}
