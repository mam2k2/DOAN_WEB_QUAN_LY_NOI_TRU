<?php
namespace common\helpers;

use Yii;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;
use yii\web\HttpException;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use common\helpers\GDHelper;
use common\helpers\UploadHelper as Upload;

class ImageHelper
{
    public static function upload(UploadedFile $fileInstance, $dir = '', $resizeWidth = null, $resizeHeight = null, $resizeCrop = false)
    {
        $fileName = Upload::getUploadPath($dir) . DIRECTORY_SEPARATOR . Upload::getFileName($fileInstance);

        $uploaded = $resizeWidth
            ? self::copyResizedImage($fileInstance->tempName, $fileName, $resizeWidth, $resizeHeight, $resizeCrop)
            : $fileInstance->saveAs($fileName);

        if(!$uploaded){
            throw new HttpException(500, 'Cannot upload file "'.$fileName.'". Please check write permissions.');
        }

        return Upload::getLink($fileName);
    }

    static function thumb($filename, $width = null, $height = null, $crop = true)
    {
        if($filename && is_file(($filename = Yii::getAlias('@webroot') . $filename)))
        {
            $info = pathinfo($filename);
            $thumbName = $info['filename'] . '-' . md5( filemtime($filename) . (int)$width . (int)$height . (int)$crop ) . '.' . $info['extension'];
            $thumbFile = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . Upload::$UPLOADS_DIR . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $thumbName;
            $thumbWebFile = '/' . Upload::$UPLOADS_DIR . '/thumbs/' . $thumbName;
            if(file_exists($thumbFile)){
                return $thumbWebFile;
            }
            elseif(FileHelper::createDirectory(dirname($thumbFile), 0777) && self::copyResizedImage($filename, $thumbFile, $width, $height, $crop)){
                return $thumbWebFile;
            }
        }
        return '';
    }

    static function copyResizedImage($inputFile, $outputFile, $width, $height = null, $crop = true)
    {
        if (extension_loaded('gd'))
        {
            $image = new GDHelper($inputFile);

            if($height) {
                if($width && $crop){
                    $image->cropThumbnail($width, $height);
                } else {
                    $image->resize($width, $height);
                }
            } else {
                $image->resize($width);
            }
            return $image->save($outputFile);
        }
        elseif(extension_loaded('imagick'))
        {
            $image = new \Imagick($inputFile);

            if($height && !$crop) {
                $image->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1, true);
            }
            else{
                $image->resizeImage($width, null, \Imagick::FILTER_LANCZOS, 1);
            }

            if($height && $crop){
                $image->cropThumbnailImage($width, $height);
            }

            return $image->writeImage($outputFile);
        }
        else {
            throw new HttpException(500, 'Please install GD or Imagick extension');
        }
    }
    public static function uploadBase64(string $base64,$path){
        if(!str_contains($base64,"data:image"))
            throw new BadRequestHttpException(Yii::t("app","Image not valid!"));
        if($imageData = base64_decode($base64)){
            $extension = ".".(self::getImageExtension($base64) ?? "jpg");
            if(!file_exists(Yii::getAlias("@admin")."/uploads"))
                mkdir(Yii::getAlias("@admin")."/uploads");
            if(!file_exists(Yii::getAlias("@admin")."/uploads/images/"))
                mkdir(Yii::getAlias("@admin")."/uploads/images");
            if(!file_exists(Yii::getAlias("@admin")."/uploads/images/$path"))
                mkdir(Yii::getAlias("@admin")."/uploads/images/$path");

            $path = '/uploads/images/' . $path . "/";
            if(!in_array($extension, [".jpg",".png",]))
                throw new BadRequestHttpException(Yii::t("app","Image not valid!". $extension));
            $filename = $path. date('Y-m-d-H-i-s') . Yii::$app->security->generateRandomString(15) . $extension;


            if (!file_put_contents(Yii::getAlias("@admin").$filename,$imageData )) {
                throw new Exception("Image not valid");
            }
            return $filename;
        }
        return "";
    }
    public static function getImageExtension($encodedImage)
    {
        // Tách chuỗi base64 thành hai phần: phần đầu là header và phần sau là nội dung hình ảnh
        $parts = explode(',', $encodedImage);

        // Lấy phần đầu của chuỗi base64
        $header = $parts[0];

        // Tìm kiếm ký tự đầu tiên trong phần đầu là dấu chấm phẩy (;)
        $indexOfSemicolon = strpos($header, ';');

        // Tìm kiếm ký tự đầu tiên trong phần đầu là dấu chấm phẩy (/)
        $indexOfSlash= strpos($header, '/');

        // Lấy phần từ dấu / => ;
        $extension = substr($header, $indexOfSlash + 1,$indexOfSemicolon - $indexOfSlash - 1);

        // Trả về đuôi file của hình ảnh
        return $extension ?? "jpg";

    }
}