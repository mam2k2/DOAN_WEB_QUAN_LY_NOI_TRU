<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_khu_ktx".
 *
 * @property int $id
 * @property string $ma_khu
 * @property string $ten_khu
 * @property string $vi_tri
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PhongO[] $phongOs
 */
class KhuKtx extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_khu_ktx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_khu', 'ten_khu'], 'required'],
            [['ghi_chu'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['ma_khu'], 'string', 'max' => 50],
            [['ten_khu', 'vi_tri'], 'string', 'max' => 100],
            [['ma_khu'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ma_khu' => Yii::t('app', 'Mã khu'),
            'ten_khu' => Yii::t('app', 'Tên Khu'),
            'vi_tri' => Yii::t('app', 'Vị Trí'),
            'ghi_chu' => Yii::t('app', 'Ghi Chú'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhongOs()
    {
        return $this->hasMany(PhongO::className(), ['khu_id' => 'id']);
    }
}
