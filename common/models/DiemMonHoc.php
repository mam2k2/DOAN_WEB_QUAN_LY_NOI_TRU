<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_diem_mon_hoc".
 *
 * @property int $id
 * @property string $mon_hoc_id
 * @property int $user_id
 * @property string $diem
 * @property int $created_at
 * @property int $updated_at
 */
class DiemMonHoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_diem_mon_hoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mon_hoc_id'], 'required'],
            [['mon_hoc_id'], 'string'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['diem'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mon_hoc_id' => Yii::t('app', 'Mon Hoc ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'diem' => Yii::t('app', 'Diem'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
