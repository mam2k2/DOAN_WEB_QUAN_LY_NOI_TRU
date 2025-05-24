<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tickets}}".
 *
 * @property int $id
 * @property string $tieu_de
 * @property string $noi_dung
 * @property string $danh_muc
 * @property string $trang_thai
 * @property string $do_khan_cap
 * @property int $user_id
 * @property int $assigned_to
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Attachments[] $attachments
 * @property AdminUser $assignedTo
 * @property User $user
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tickets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tieu_de', 'noi_dung'], 'required'],
            [['noi_dung', 'danh_muc', 'trang_thai', 'do_khan_cap'], 'string'],
            [['user_id', 'assigned_to'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tieu_de'], 'string', 'max' => 255],
            [['assigned_to'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUser::className(), 'targetAttribute' => ['assigned_to' => 'id']],
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
            'danh_muc' => Yii::t('app', 'Danh Muc'),
            'trang_thai' => Yii::t('app', 'Trang Thai'),
            'do_khan_cap' => Yii::t('app', 'Do Khan Cap'),
            'user_id' => Yii::t('app', 'User ID'),
            'assigned_to' => Yii::t('app', 'Assigned To'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachments::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'assigned_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
