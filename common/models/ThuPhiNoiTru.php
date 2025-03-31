<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_thu_phi_noi_tru".
 *
 * @property int $id
 * @property int $user_id
 * @property int $khoan_phi_id
 * @property int $phong_id
 * @property string $so_tien
 * @property string $ngay_thu
 * @property string $nguoi_thu
 * @property int $trang_thai 0-Chưa thu,1-Đã thu
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 */
class ThuPhiNoiTru extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_thu_phi_noi_tru';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'khoan_phi_id', 'phong_id', 'trang_thai', 'created_at', 'updated_at'], 'integer'],
            [['khoan_phi_id', 'phong_id', 'so_tien', 'ngay_thu'], 'required'],
            [['so_tien'], 'number'],
            [['ngay_thu'], 'safe'],
            [['ghi_chu'], 'string'],
            [['nguoi_thu'], 'string', 'max' => 100],
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
            'khoan_phi_id' => Yii::t('app', 'Khoan Phi ID'),
            'phong_id' => Yii::t('app', 'Phong ID'),
            'so_tien' => Yii::t('app', 'So Tien'),
            'ngay_thu' => Yii::t('app', 'Ngay Thu'),
            'nguoi_thu' => Yii::t('app', 'Nguoi Thu'),
            'trang_thai' => Yii::t('app', 'Trang Thai'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
