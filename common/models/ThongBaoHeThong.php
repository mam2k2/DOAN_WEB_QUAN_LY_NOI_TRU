<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "da_thong_bao_he_thong".
 *
 * @property int $id
 * @property string $tieu_de
 * @property string $noi_dung
 * @property int $nguoi_gui_id
 * @property int $ngay_gui
 * @property string $doi_tuong_nhan
 * @property int $created_at
 * @property int $updated_at
 */
class ThongBaoHeThong extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'da_thong_bao_he_thong';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tieu_de'], 'required'],
            [['noi_dung'], 'string'],
            [['nguoi_gui_id', 'ngay_gui', 'created_at', 'updated_at'], 'integer'],
            [['tieu_de'], 'string', 'max' => 255],
            [['doi_tuong_nhan'], 'string', 'max' => 50],
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
            'doi_tuong_nhan' => Yii::t('app', 'Doi Tuong Nhan'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
