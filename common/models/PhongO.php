<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_phong_o".
 *
 * @property int $id
 * @property int $khu_id
 * @property string $ma_phong
 * @property string $ten_phong
 * @property int $suc_chua
 * @property int $so_luong_hien_tai
 * @property string $vi_tri
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property KhuKtx $khu
 */
class PhongO extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_phong_o';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['khu_id', 'suc_chua', 'so_luong_hien_tai', 'created_at', 'updated_at'], 'integer'],
            [['ma_phong', 'ten_phong'], 'required'],
            [['ghi_chu'], 'string'],
            [['ma_phong'], 'string', 'max' => 50],
            [['ten_phong', 'vi_tri'], 'string', 'max' => 100],
            [['ma_phong'], 'unique'],
            [['khu_id'], 'exist', 'skipOnError' => true, 'targetClass' => KhuKtx::className(), 'targetAttribute' => ['khu_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'khu_id' => Yii::t('app', 'Khu ID'),
            'ma_phong' => Yii::t('app', 'Ma Phong'),
            'ten_phong' => Yii::t('app', 'Ten Phong'),
            'suc_chua' => Yii::t('app', 'Suc Chua'),
            'so_luong_hien_tai' => Yii::t('app', 'So Luong Hien Tai'),
            'vi_tri' => Yii::t('app', 'Vi Tri'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKhu()
    {
        return $this->hasOne(KhuKtx::className(), ['id' => 'khu_id']);
    }
}
