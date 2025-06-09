<?php

namespace common\models;

use common\helpers\Util;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "da_phong_o".
 *
 * @property int $id
 * @property int $khu_id
 * @property string $ma_phong
 * @property string $ten_phong
 * @property int $suc_chua
 * @property int $so_luong_hien_tai
 * @property string $vi_tri
 * @property string $ghi_chu
 * @property int $created_at
 * @property int $phan_loai
 * @property string $hinh_anh
 * @property int $updated_at
 *
 * @property KhuKtx $khu
 */
class PhongO extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_phong_o';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['khu_id', 'suc_chua', 'so_luong_hien_tai', 'created_at', 'updated_at','phan_loai'], 'integer'],
            [['ma_phong', 'ten_phong','khu_id','phan_loai'], 'required'],
            [['ghi_chu'], 'string'],
            [['hinh_anh'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['ma_phong'], 'string', 'max' => 50],
            [['ten_phong', 'vi_tri'], 'string', 'max' => 100],
            [['ma_phong'], 'unique'],
            [['khu_id'], 'exist', 'skipOnError' => true, 'targetClass' => KhuKtx::className(), 'targetAttribute' => ['khu_id' => 'id']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'khu_id' => Yii::t('app', 'Khu'),
            'ma_phong' => Yii::t('app', 'Mã phòng'),
            'ten_phong' => Yii::t('app', 'Tên phòng'),
            'suc_chua' => Yii::t('app', 'Sức chứa'),
            'so_luong_hien_tai' => Yii::t('app', 'Số lượng hiện tại'),
            'vi_tri' => Yii::t('app', 'Vị trí'),
            'ghi_chu' => Yii::t('app', 'Ghi chú'),
            'phan_loai' => Yii::t('app', 'Phân loại'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKhu()
    {
        return $this->hasOne(KhuKtx::className(), ['id' => 'khu_id']);
    }
    public function getThietBiKtxs()
    {
        return $this->hasMany(ThietBiKtx::className(), ['phong_o_id' => 'id']);
    }
    public function getPhongOHocSinhs()
    {
        return $this->hasMany(PhongOHocSinh::className(), ['phong_o_id' => 'id  ']);
    }
    public function getTen_khu()
    {
        return $this->khu ? $this->khu->ten_khu : null;
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
    public function getHinhAnhUrl(){
        $avatarUrl = Yii::$app->getRequest()->getBaseUrl() . '/static/img/profile_small.jpg';
        if ($this->avatar) {
            $avatarUrl = Yii::$app->params['site']['url'] . $this->avatar;
        }
        return $avatarUrl;
    }
    public function getSoLuongHienTaiPhong()
    {
        $this->so_luong_hien_tai = ThongTinHocSinh::find()->where(['phong_o_id' => $this->id])->count();
        $this->save();
        return $this->so_luong_hien_tai;
    }
}
