<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $payment_type kiểu thanh toán 0-tiền mặt,1-chuyển khoản
 * @property string $note
 * @property int $type_order Tại quầy/bán online
 * @property double $discount
 * @property double $tax
 * @property int $status Trạng thái đơn hàng 0-Huỷ,1-Nháp,2-Nợ,3-Đang vận chuyển,4-Hoàn thành
 * @property int $deleted_note Trạng thái đơn hàng 0-Huỷ,1-Nháp,2-Nợ,3-Đang vận chuyển,4-Hoàn thành
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'payment_type', 'type_order', 'status', 'deleted_note', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['discount', 'tax'], 'number'],
            [['note'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'payment_type' => Yii::t('app', 'kiểu thanh toán 0-tiền mặt,1-chuyển khoản'),
            'note' => Yii::t('app', 'Note'),
            'type_order' => Yii::t('app', 'Tại quầy/bán online'),
            'discount' => Yii::t('app', 'Discount'),
            'tax' => Yii::t('app', 'Tax'),
            'status' => Yii::t('app', 'Trạng thái đơn hàng 0-Huỷ,1-Nháp,2-Nợ,3-Đang vận chuyển,4-Hoàn thành'),
            'deleted_note' => Yii::t('app', 'Trạng thái đơn hàng 0-Huỷ,1-Nháp,2-Nợ,3-Đang vận chuyển,4-Hoàn thành'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }
}
