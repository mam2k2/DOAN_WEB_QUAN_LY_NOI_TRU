<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%diem_danh}}".
 *
 * @property int $id
 * @property int $hoc_sinh_id
 * @property int $phong_id
 * @property string $ngay_diem_danh
 * @property string $thoi_gian
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PhongO $phong
 * @property ThongTinHocSinh $hocSinh
 */
class DiemDanh extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%diem_danh}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoc_sinh_id', 'phong_id', 'created_at', 'updated_at'], 'integer'],
            [['ngay_diem_danh'], 'required'],
            [['ngay_diem_danh', 'thoi_gian'], 'safe'],
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
            'ngay_diem_danh' => Yii::t('app', 'Ngày điểm danh'),
            'thoi_gian' => Yii::t('app', 'Thời gian'),
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
