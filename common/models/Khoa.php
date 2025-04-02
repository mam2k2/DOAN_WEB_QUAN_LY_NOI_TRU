<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_khoa".
 *
 * @property int $id
 * @property string $ten_khoa
 * @property int $created_at
 * @property int $updated_at
 */
class Khoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_khoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_khoa'], 'required'],
            [['ten_khoa'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ten_khoa' => Yii::t('app', 'Ten Khoa'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
