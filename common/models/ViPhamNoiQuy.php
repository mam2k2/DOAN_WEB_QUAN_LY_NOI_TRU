<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%vi_pham_noi_quy}}".
 *
 * @property int $id
 * @property int $hoc_sinh_id
 * @property string $loai_vi_pham
 * @property string $mo_ta
 * @property string $ngay_vi_pham
 * @property string $hinh_thuc_xu_ly
 * @property string $nguoi_xu_ly
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ThongTinHocSinh $hocSinh
 */
class ViPhamNoiQuy extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vi_pham_noi_quy}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoc_sinh_id', 'created_at', 'updated_at'], 'integer'],
            [['loai_vi_pham'], 'required'],
            [['mo_ta'], 'string'],
            [['ngay_vi_pham'], 'safe'],
            [['loai_vi_pham', 'hinh_thuc_xu_ly'], 'string', 'max' => 255],
            [['nguoi_xu_ly'], 'string', 'max' => 100],
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
            'loai_vi_pham' => Yii::t('app', 'Loai Vi Pham'),
            'mo_ta' => Yii::t('app', 'Mo Ta'),
            'ngay_vi_pham' => Yii::t('app', 'Ngay Vi Pham'),
            'hinh_thuc_xu_ly' => Yii::t('app', 'Hinh Thuc Xu Ly'),
            'nguoi_xu_ly' => Yii::t('app', 'Nguoi Xu Ly'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHocSinh()
    {
        return $this->hasOne(ThongTinHocSinh::className(), ['id' => 'hoc_sinh_id']);
    }
}
