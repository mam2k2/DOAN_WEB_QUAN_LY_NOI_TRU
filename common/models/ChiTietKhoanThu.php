<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%chi_tiet_khoan_thu}}".
 *
 * @property int $id
 * @property int $thu_phi_noi_tru_id
 * @property int $khoan_phi_id
 * @property string $so_tien
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property KhoanPhi $khoanPhi
 * @property ThuPhiNoiTru $thuPhiNoiTru
 */
class ChiTietKhoanThu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chi_tiet_khoan_thu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['thu_phi_noi_tru_id', 'khoan_phi_id', 'so_tien'], 'required'],
            [['thu_phi_noi_tru_id', 'khoan_phi_id', 'created_at', 'updated_at'], 'integer'],
            [['so_tien'], 'number'],
            [['ghi_chu'], 'string'],
            [['khoan_phi_id'], 'exist', 'skipOnError' => true, 'targetClass' => KhoanPhi::className(), 'targetAttribute' => ['khoan_phi_id' => 'id']],
            [['thu_phi_noi_tru_id'], 'exist', 'skipOnError' => true, 'targetClass' => ThuPhiNoiTru::className(), 'targetAttribute' => ['thu_phi_noi_tru_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'thu_phi_noi_tru_id' => Yii::t('app', 'Thu Phi Noi Tru ID'),
            'khoan_phi_id' => Yii::t('app', 'Khoan Phi ID'),
            'so_tien' => Yii::t('app', 'So Tien'),
            'ghi_chu' => Yii::t('app', 'Ghi Chu'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKhoanPhi()
    {
        return $this->hasOne(KhoanPhi::className(), ['id' => 'khoan_phi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThuPhiNoiTru()
    {
        return $this->hasOne(ThuPhiNoiTru::className(), ['id' => 'thu_phi_noi_tru_id']);
    }
}
