<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_khoan_phi".
 *
 * @property int $id
 * @property string $ten_khoan_phi
 * @property int $loai_phi 0-Cố định,1-Linh hoạt
 * @property string $so_tien
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class KhoanPhi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_khoan_phi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_khoan_phi'], 'required'],
            [['loai_phi', 'created_at', 'updated_at'], 'integer'],
            [['so_tien'], 'number'],
            [['ghi_chu'], 'string'],
            [['ten_khoan_phi'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ten_khoan_phi' => Yii::t('app', 'Ten Khoan Phi'),
            'loai_phi' => Yii::t('app', 'Loai Phi'),
            'so_tien' => Yii::t('app', 'So Tien'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
