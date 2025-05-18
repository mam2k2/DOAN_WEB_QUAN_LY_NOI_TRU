<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%thong_bao_he_thong}}".
 *
 * @property int $id
 * @property string $tieu_de
 * @property string $noi_dung
 * @property int $nguoi_gui_id
 * @property string $ngay_gui
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AdminUser $nguoiGui
 * @property User $user
 */
class ThongBaoHeThong extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%thong_bao_he_thong}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tieu_de'], 'required'],
            [['noi_dung'], 'string'],
            [['nguoi_gui_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['ngay_gui'], 'safe'],
            [['tieu_de'], 'string', 'max' => 255],
            [['nguoi_gui_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUser::className(), 'targetAttribute' => ['nguoi_gui_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tieu_de' => Yii::t('app', 'Tieu De'),
            'noi_dung' => Yii::t('app', 'Noi Dung'),
            'nguoi_gui_id' => Yii::t('app', 'Nguoi Gui ID'),
            'ngay_gui' => Yii::t('app', 'Ngay Gui'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNguoiGui()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'nguoi_gui_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
