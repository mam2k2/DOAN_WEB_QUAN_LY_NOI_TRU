<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%y_te}}".
 *
 * @property int $id
 * @property int $hoc_sinh_id
 * @property int $ngay_bi_benh
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ThongTinHocSinh $hocSinh
 */
class YTe extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%y_te}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hoc_sinh_id', 'created_at', 'updated_at'], 'integer'],
            [['ngay_bi_benh'], 'required'],
            [['ghi_chu','ngay_bi_benh'], 'string'],
            [['hoc_sinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThongTinHocSinh::className(), 'targetAttribute' => ['hoc_sinh_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Mã'),
            'hoc_sinh_id' => Yii::t('app', 'Mã học sinh'),
            'ngay_bi_benh' => Yii::t('app', 'Ngày bị bệnh'),
            'ghi_chu' => Yii::t('app', 'Ghi chú'),
            'created_at' => Yii::t('app', 'Thời gian tạo'),
            'updated_at' => Yii::t('app', 'Thời gian cập nhật'),
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
