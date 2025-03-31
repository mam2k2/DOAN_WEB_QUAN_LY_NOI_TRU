<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_thiet_bi_ktx".
 *
 * @property int $id
 * @property string $ma_thiet_bi
 * @property string $ten_thiet_bi
 * @property int $phong_o_id
 * @property string $tinh_trang
 * @property string $ngay_bao_tri
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class ThietBiKtx extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_thiet_bi_ktx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_thiet_bi', 'ten_thiet_bi'], 'required'],
            [['phong_o_id', 'created_at', 'updated_at'], 'integer'],
            [['ngay_bao_tri'], 'safe'],
            [['ghi_chu'], 'string'],
            [['ma_thiet_bi'], 'string', 'max' => 50],
            [['ten_thiet_bi', 'tinh_trang'], 'string', 'max' => 100],
            [['ma_thiet_bi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ma_thiet_bi' => Yii::t('app', 'Ma Thiet Bi'),
            'ten_thiet_bi' => Yii::t('app', 'Ten Thiet Bi'),
            'phong_o_id' => Yii::t('app', 'Phong O ID'),
            'tinh_trang' => Yii::t('app', 'Tinh Trang'),
            'ngay_bao_tri' => Yii::t('app', 'Ngay Bao Tri'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
