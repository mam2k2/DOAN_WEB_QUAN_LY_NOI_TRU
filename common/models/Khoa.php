<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%khoa}}".
 *
 * @property int $id
 * @property string $ten_khoa
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Lop[] $lops
 */
class Khoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%khoa}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            [['ten_khoa'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['ten_khoa'], 'string', 'max' => 255],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLops()
    {
        return $this->hasMany(Lop::className(), ['khoa_id' => 'id']);
    }
}
