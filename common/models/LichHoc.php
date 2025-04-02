<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_lich_hoc".
 *
 * @property int $id
 * @property int $mon_id
 * @property int $thu_trong_tuan
 * @property int $tiet
 * @property string $thoi_gian_bat_dau
 * @property string $thoi_gian_ket_thuc
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class LichHoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_lich_hoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mon_id', 'thu_trong_tuan', 'tiet', 'created_at', 'updated_at'], 'integer'],
            [['thu_trong_tuan', 'tiet'], 'required'],
            [['thoi_gian_bat_dau', 'thoi_gian_ket_thuc'], 'safe'],
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
            'mon_id' => Yii::t('app', 'Mon ID'),
            'thu_trong_tuan' => Yii::t('app', 'Thu Trong Tuan'),
            'tiet' => Yii::t('app', 'Tiet'),
            'thoi_gian_bat_dau' => Yii::t('app', 'Thoi Gian Bat Dau'),
            'thoi_gian_ket_thuc' => Yii::t('app', 'Thoi Gian Ket Thuc'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
