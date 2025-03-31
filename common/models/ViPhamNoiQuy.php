<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_vi_pham_noi_quy".
 *
 * @property int $id
 * @property int $user_id
 * @property string $loai_vi_pham
 * @property string $mo_ta
 * @property string $ngay_vi_pham
 * @property string $hinh_thuc_xu_ly
 * @property string $nguoi_xu_ly
 * @property int $created_at
 * @property int $updated_at
 */
class ViPhamNoiQuy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_vi_pham_noi_quy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'loai_vi_pham'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['mo_ta'], 'string'],
            [['ngay_vi_pham'], 'safe'],
            [['loai_vi_pham', 'hinh_thuc_xu_ly'], 'string', 'max' => 255],
            [['nguoi_xu_ly'], 'string', 'max' => 100],
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
            'loai_vi_pham' => Yii::t('app', 'Loai Vi Pham'),
            'mo_ta' => Yii::t('app', 'Mo Ta'),
            'ngay_vi_pham' => Yii::t('app', 'Ngay Vi Pham'),
            'hinh_thuc_xu_ly' => Yii::t('app', 'Hinh Thuc Xu Ly'),
            'nguoi_xu_ly' => Yii::t('app', 'Nguoi Xu Ly'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
