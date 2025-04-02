<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_phong_o_hoc_sinh".
 *
 * @property int $id
 * @property int $user_id
 * @property int $phong_id
 * @property string $thoi_gian_bat_dau
 * @property int $trang_thai 0-Đã rời đi,1-Đang ở
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class PhongOHocSinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_phong_o_hoc_sinh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'phong_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['phong_id', 'thoi_gian_bat_dau'], 'required'],
            [['thoi_gian_bat_dau'], 'number'],
            [['ghi_chu'], 'string'],
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
            'phong_id' => Yii::t('app', 'Phong ID'),
            'thoi_gian_bat_dau' => Yii::t('app', 'Thoi Gian Bat Dau'),
            'trang_thai' => Yii::t('app', 'Trang Thai'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
