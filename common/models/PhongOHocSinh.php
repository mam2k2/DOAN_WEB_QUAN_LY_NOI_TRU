<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%phong_o_hoc_sinh}}".
 *
 * @property int $id
 * @property int $hoc_sinh_id
 * @property int $phong_id
 * @property string $thoi_gian_bat_dau
 * @property int $trang_thai 0-Đã rời đi,1-Đang ở
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PhongO $phong
 * @property ThongTinHocSinh $hocSinh
 */
class PhongOHocSinh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%phong_o_hoc_sinh}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoc_sinh_id', 'phong_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['phong_id', 'thoi_gian_bat_dau'], 'required'],
            [['thoi_gian_bat_dau'], 'date', 'format' => 'php:Y-m-d'],
            [['ghi_chu'], 'string'],
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
            'hoc_sinh_id' => Yii::t('app', 'Hoc Sinh ID'),
            'phong_id' => Yii::t('app', 'Phong ID'),
            'thoi_gian_bat_dau' => Yii::t('app', 'Thoi Gian Bat Dau'),
            'trang_thai' => Yii::t('app', '0-Đã rời đi,1-Đang ở'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
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
}
