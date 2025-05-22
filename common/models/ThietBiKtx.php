<?php

namespace common\models;

use common\helpers\Util;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "da_thiet_bi_ktx".
 *
 * @property int $id
 * @property string $ma_thiet_bi
 * @property string $ten_thiet_bi
 * @property int $phong_o_id
 * @property string $tinh_trang
 * @property string $ngay_bao_tri
 * @property string $ghi_chu
 * @property string $hinh_anh
 * @property int $created_at
 * @property int $updated_at
 */
class ThietBiKtx extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_thiet_bi_ktx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ma_thiet_bi', 'ten_thiet_bi'], 'required'],
            [['phong_o_id', 'created_at', 'updated_at'], 'integer'],
            [['hinh_anh'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['ngay_bao_tri'], 'safe'],
            [['ghi_chu'], 'string'],
            [['ma_thiet_bi'], 'string', 'max' => 50],
            [['ten_thiet_bi', 'tinh_trang'], 'string', 'max' => 100],
            [['ma_thiet_bi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ma_thiet_bi' => Yii::t('app', 'Mã thiết bị'),
            'ten_thiet_bi' => Yii::t('app', 'Tên thiết bị'),
            'phong_o_id' => Yii::t('app', 'Mã phòng ở'),
            'tinh_trang' => Yii::t('app', 'Tình trạng'),
            'ngay_bao_tri' => Yii::t('app', 'Ngày bảo trì'),
            'ghi_chu' => Yii::t('app', 'Ghi chú'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    public function beforeValidate()
    {
        if($this->hinh_anh !== "0") {//为0表示需要删除图片，Util::handleModelSingleFileUpload()会有判断删除图片
            $this->hinh_anh = UploadedFile::getInstance($this, "hinh_anh");
        }
        return parent::beforeValidate();
    }
    public function beforeSave($insert)
    {
        Util::handleModelSingleFileUpload($this, 'hinh_anh', $insert, '@webroot/../uploads/avatar/');
        return parent::beforeSave($insert);
    }
}
