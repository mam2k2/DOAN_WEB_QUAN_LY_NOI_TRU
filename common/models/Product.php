<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $branch_id
 * @property double $price_import
 * @property double $price_export
 * @property double $tax_percentage
 * @property double $quantity
 * @property double $note
 * @property double $desc
 * @property int $type Loại sản phẩm (1 : Sản phẩm, 2 : Gói tập)
 * @property double $SKU
 * @property int $unit
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property int $created_at
 * @property int $updated_at
 * @property int $deleted_at
 */
class Product extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'branch_id', 'type', 'unit', 'status', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name'], 'required'],
            [['price_import', 'price_export', 'tax_percentage', 'quantity', 'note', 'desc', 'SKU'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'price_import' => Yii::t('app', 'Price Import'),
            'price_export' => Yii::t('app', 'Price Export'),
            'tax_percentage' => Yii::t('app', 'Tax Percentage'),
            'quantity' => Yii::t('app', 'Quantity'),
            'note' => Yii::t('app', 'Note'),
            'desc' => Yii::t('app', 'Desc'),
            'type' => Yii::t('app', 'Loại sản phẩm (1 : Sản phẩm, 2 : Gói tập)'),
            'SKU' => Yii::t('app', 'Sku'),
            'unit' => Yii::t('app', 'Unit'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }
}
