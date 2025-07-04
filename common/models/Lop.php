<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_lop".
 *
 * @property int $id
 * @property int $khoa_id
 * @property int $chu_nghiem_id
 * @property string $ten_lop
 * @property string $ngay_bat_dau
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class Lop extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_lop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['khoa_id', 'chu_nghiem_id', 'created_at', 'updated_at'], 'integer'],
            [['ngay_bat_dau'], 'required'],
            [['ngay_bat_dau'], 'safe'],
            [['ghi_chu'], 'string'],
            [['ten_lop'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'khoa_id' => Yii::t('app', 'Mã khóa'),
            'chu_nghiem_id' => Yii::t('app', 'Giáo viên chủ nghiệm'),
            'ten_lop' => Yii::t('app', 'Tên lớp'),
            'ngay_bat_dau' => Yii::t('app', 'Ngày bắt đầu'),
            'ghi_chu' => Yii::t('app', 'Ghi chú'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public  function getChuNghiem()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'chu_nghiem_id']);
    }
    public function getTenChuNghiem()
    {
        return $this->chuNghiem->ho_va_ten;
    }
    public function getKhoa()
    {
        return $this->hasOne(Khoa::className(), ['id' => 'khoa_id']);
    }
    public function getTenKhoa()
    {
        return $this->khoa->ten_khoa;
    }
}
