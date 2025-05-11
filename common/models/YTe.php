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
            [['hoc_sinh_id', 'ngay_bi_benh', 'created_at', 'updated_at'], 'integer'],
            [['ngay_bi_benh'], 'required'],
            [['ghi_chu'], 'string'],
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
            'ngay_bi_benh' => Yii::t('app', 'Ngay Bi Benh'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
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
