<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-12-27 14:53
 */

namespace common\helpers;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class Util
{
    /**
     * 处理单模型单文件上传
     *
     * @param ActiveRecord $model
     * @param $field
     * @param $insert
     * @param $uploadPath
     * @param array $options
     *                  $options[thumbSizes] array 需要截图的尺寸，如[['w'=>100,'h'=>100]]
     *                  $options['filename'] string 新文件名，默认自动生成
     * @return bool
     * @throws \yii\base\Exception
     */
    public static function handleModelSingleFileUpload(ActiveRecord &$model, $field, $insert, $uploadPath, $options=[])
    {
        $upload = UploadedFile::getInstance($model, $field);
        /* @var $cdn \feehi\cdn\TargetInterface */
        $cdn = Yii::$app->get('cdn');
        if ($upload !== null) {
            $uploadPath = Yii::getAlias($uploadPath);
            if( strpos(strrev($uploadPath), '/') !== 0 ) $uploadPath .= '/';
            if (! FileHelper::createDirectory($uploadPath)) {
                $model->addError($field, "Create directory failed " . $uploadPath);
                return false;
            }
            $fullName = isset($options['filename']) ? $uploadPath . $options['filename'] : $uploadPath . date('YmdHis') . '_' . uniqid() . '.' . $upload->getExtension();
            if (! $upload->saveAs($fullName)) {
                $model->addError($field, Yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => Yii::t('app', ucfirst($field))]) . ': ' . $fullName);
                return false;
            }
            $model->$field = str_replace(Yii::getAlias('@webroot'), '', $fullName);
            $cdn->upload($fullName, $model->$field);
            if(isset($options['thumbSizes'])) self::thumbnails($fullName, $options['thumbSizes']);
            if( !$insert ){
                $file = Yii::getAlias('@webroot') . $model->getOldAttribute($field);
                if( file_exists($file) && is_file($file) ) unlink($file);
                if( $cdn->exists( $model->getOldAttribute($field) ) ) $cdn->delete($model->getOldAttribute($field));
                if(isset($options['thumbSizes'])) self::deleteThumbnails($file, $options['thumbSizes']);
            }
        } else {
            if( $model->$field === '0' ){//删除
                $file = Yii::getAlias('@webroot') . $model->getOldAttribute($field);
                if( file_exists($file) && is_file($file) ) unlink($file);
                if( $cdn->exists( $model->getOldAttribute($field) ) ) $cdn->delete($model->getOldAttribute($field));
                if(isset($options['thumbSizes'])) self::deleteThumbnails($file, $options['thumbSizes']);
                $model->$field = '';
            }else {
                if($insert) {
                    $model->$field = '';
                }else{
                    $model->$field = $model->getOldAttribute($field);
                }
            }
        }
    }

    /**
     * 处理单模型单文件非常态上传
     *
     * @param ActiveRecord $model
     * @param $field
     * @param $uploadPath
     * @param $oldFullName
     * @param array $options
     * @return bool
     * @throws yii\base\Exception
     */
    public static function handleModelSingleFileUploadAbnormal(ActiveRecord &$model, $field, $uploadPath, $oldFullName, $options=[])
    {
        if( !isset($options['successDeleteOld']) ) $options['successDeleteOld'] = true;//成功后删除旧文件
        if( !isset($options['deleteOldFile']) ) $options['deleteOldFile'] = false;//删除旧文件
        $upload = UploadedFile::getInstance($model, $field);
        /* @var $cdn \feehi\cdn\TargetInterface */
        $cdn = Yii::$app->get('cdn');
        if ($upload !== null) {
            $uploadPath = Yii::getAlias($uploadPath);
            if( strpos(strrev($uploadPath), '/') !== 0 ) $uploadPath .= '/';
            if (! FileHelper::createDirectory($uploadPath)) {
                $model->addError($field, "Create directory failed " . $uploadPath);
                return false;
            }
            $fullName = isset($options['filename']) ? $uploadPath . $options['filename'] : $uploadPath . date('YmdHis') . '_' . uniqid() . '.' . $upload->getExtension();
            if (! $upload->saveAs($fullName)) {
                $model->addError($field, Yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', ucfirst($field))]) . ': ' . $fullName);
                return false;
            }
            $model->$field = str_replace(Yii::getAlias('@frontend/web'), '', $fullName);
            $cdn->upload($fullName, $model->$field);
            if(isset($options['thumbSizes'])) self::thumbnails($fullName, $options['thumbSizes']);
            if( $options['successDeleteOld'] && $oldFullName ){
                $file = Yii::getAlias('@frontend/web') . $oldFullName;
                if( file_exists($file) && is_file($file) ) unlink($file);
                if( $cdn->exists( $oldFullName ) ) $cdn->delete($oldFullName);
                if(isset($options['thumbSizes'])) self::deleteThumbnails($file, $options['thumbSizes']);
            }
        } else {
            if( $model->$field === '0' ){//删除
                $file = Yii::getAlias('@frontend/web') . $oldFullName;
                if( file_exists($file) && is_file($file) ) unlink($file);
                if( $cdn->exists( $oldFullName ) ) $cdn->delete($oldFullName);
                if(isset($options['thumbSizes'])) self::deleteThumbnails($file, $options['thumbSizes']);
                $model->$field = '';
            }else {
                $model->$field = $oldFullName;
            }
        }
        if( $options['deleteOldFile'] ){
            $file = Yii::getAlias('@frontend/web') . $oldFullName;
            if( file_exists($file) && is_file($file) ) unlink($file);
            if( $cdn->exists( $oldFullName ) ) $cdn->delete($oldFullName);
            if(isset($options['thumbSizes'])) self::deleteThumbnails($file, $options['thumbSizes']);
        }
    }

    /**
     * 生成各个尺寸的缩略图
     *
     * @param $fullName string 原图路径
     * @param array $thumbSizes 二维数组 如 [["w"=>110,"height"=>"20"],["w"=>200,"h"=>"30"]]则生成两张缩量图，分别为宽110高20和宽200高30
     * @throws yii\base\InvalidConfigException
     */
    public static function thumbnails($fullName, array $thumbSizes)
    {
        foreach ($thumbSizes as $info){
            $thumbFullName = self::getThumbName($fullName, $info['w'], $info['h']);
            Image::thumbnail($fullName, $info['w'], $info['h'])->save($thumbFullName);
            /** @var $cdn \feehi\cdn\TargetInterface */
            $cdn = Yii::$app->get('cdn');
            $cdn->upload($thumbFullName, str_replace(Yii::getAlias('@frontend/web'), '', $thumbFullName));
        }
    }

    /**
     * 删除各个尺寸的缩略图
     *
     * @param $fullName string 原图图片路径
     * @param $thumbSizes array 二维数组 如 [["w"=>110,"height"=>"20"],["w"=>200,"h"=>"30"]]则生成两张缩量图，分别为宽110高20和宽200高30
     * @param $deleteOrigin bool 是否删除原图
     * @throws yii\base\InvalidConfigException
     */
    public static function deleteThumbnails($fullName, array $thumbSizes, $deleteOrigin=false)
    {
       foreach ($thumbSizes as $info){
            $thumbFullName = self::getThumbName($fullName, $info['w'], $info['h']);
            if( file_exists($thumbFullName) && is_file($thumbFullName) ) unlink($thumbFullName);
            $cdn = Yii::$app->get('cdn');
            $cdn->delete(str_replace(Yii::getAlias("@frontend/web"), '', $thumbFullName));
        }
        if( $deleteOrigin ){
            file_exists($fullName) && unlink($fullName);
        }
    }

    /**
     * 根据原图路径生成缩略图路径
     *
     * @param $fullName string 原图路径
     * @param $width int 长
     * @param $height int 宽
     * @return string 如/path/to/uploads/article/xx@100x20.png
     */
    public static function getThumbName($fullName, $width, $height)
    {
        $dotPosition = strrpos($fullName, '.', mb_strlen(Yii::getAlias('@frontend')));
        $thumbExt = "@" . $width . 'x' . $height;
        if( $dotPosition === false ){
            $thumbFullName = $fullName . $thumbExt;
        }else{
            $thumbFullName = substr_replace($fullName,$thumbExt, $dotPosition, 0);
        }
        return $thumbFullName;
    }

    public static function getViewTemplate($type="article")
    {
        if( $type == "article" ){
            $files = Yii::$app->params['article.template.directory'];
        }else if ($type == "page"){
            $files = Yii::$app->params['page.template.directory'];
        }else if($type == "category"){
            $files = Yii::$app->params['category.template.directory'];
        }else{
            throw new Exception("Unknown " . $type);
        }
        $templates = [];
        foreach ($files as $key => $file){
            if( !is_int($key) ) {
                $templates[str_replace(Yii::getAlias("@frontend/views"), "", $key)] = $file;
            }else{
                $templates[str_replace(Yii::getAlias("@frontend/views"), "", $file)] = $file;
            }
        }
        return $templates;
    }

    public static function assembleAbsoluteURL($params = [], $scheme = null){
        $params = (array) $params;
        $url = Yii::$app->getUrlManager()->createUrl($params);
        if (strpos($url, '://') === false) {
            $hostInfo = Yii::$app->feehi->website_url;
            if (strncmp($url, '//', 2) === 0) {
                $url = substr($hostInfo, 0, strpos($hostInfo, '://')) . ':' . $url;
            } else {
                $url = $hostInfo . $url;
            }
        }

        $url = Url::ensureScheme($url, $scheme);
        if( strpos($url, "//") === 0 ){
            $url = "http:" . $url;
        }
        return $url;
    }
}
