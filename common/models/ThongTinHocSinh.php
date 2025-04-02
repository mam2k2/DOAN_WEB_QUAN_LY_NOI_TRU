<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_thong_tin_hoc_sinh".
 *
 * @property int $id
 * @property int $user_id
 * @property int $lop_id
 * @property string $ngay_sinh
 * @property string $que_quan
 * @property int $trang_thai 0-Đã Tốt nghiệp,1-Đã rời đi
 * @property string $diem_trung_binh
 * @property string $ngay_bat_dau
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class ThongTinHocSinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_thong_tin_hoc_sinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'lop_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['ngay_sinh', 'ngay_bat_dau'], 'required'],
            [['ngay_sinh', 'ngay_bat_dau'], 'safe'],
            [['diem_trung_binh'], 'number'],
            [['ghi_chu'], 'string'],
            [['que_quan'], 'string', 'max' => 255],
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
            'ngay_sinh' => Yii::t('app', 'Ngay Sinh'),
            'que_quan' => Yii::t('app', 'Que Quan'),
            'trang_thai' => Yii::t('app', 'Trang Thai'),
            'diem_trung_binh' => Yii::t('app', 'Diem Trung Binh'),
            'ngay_bat_dau' => Yii::t('app', 'Ngay Bat Dau'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
