<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_mon_hoc".
 *
 * @property int $id
 * @property string $ten_mon_hoc
 * @property int $created_at
 * @property int $updated_at
 */
class MonHoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_mon_hoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_mon_hoc'], 'required'],
            [['ten_mon_hoc'], 'string'],
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
            'ten_mon_hoc' => Yii::t('app', 'Ten Mon Hoc'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
