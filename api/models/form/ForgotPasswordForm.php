<?php

namespace api\models\form;

use api\models\User;
use yii\base\Model;

class ForgotPasswordForm extends Model
{
    public $email;
    private $_user;
    public function rules()
    {
        return[
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'exist',
                'targetClass' => User::className(),
                'message' => \Yii::t('app', 'This email address has already been taken')
            ],
            ];
    }
    private function getUser(){
        if($this->_user === null){
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }
    public function sendLinkResetPassword(){
        if($this->validate()){
            $user = $this->getUser();
            if($user){
                if(!User::isPasswordResetTokenValid($user->password_reset_token)){
                    $user->generatePasswordResetToken();
                }
                if($user->save()){
                   if($user->sendMailResetPassword()) {
                       return $user;
                   }else{
                       $this->addError("email", 'Lỗi gửi mail!');
                       return false;
                   }
                }
            }
        }
        return false;
    }
}