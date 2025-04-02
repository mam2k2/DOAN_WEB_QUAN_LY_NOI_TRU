<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_y_te".
 *
 * @property int $id
 * @property int $user_id
 * @property int $ngay_bi_benh
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class YTe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_y_te';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'ngay_bi_benh', 'created_at', 'updated_at'], 'integer'],
            [['ngay_bi_benh'], 'required'],
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
            'ngay_bi_benh' => Yii::t('app', 'Ngay Bi Benh'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
