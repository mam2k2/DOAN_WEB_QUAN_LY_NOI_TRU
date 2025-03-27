<?php

namespace api\models\form;

use yii\base\Model;

class ChangePasswordForm extends Model
{

    public $old_password;
    public $new_password;
    public $confirm_password;
    public function rules()
    {
        return [
            [['old_password', 'new_password', 'confirm_password'], 'required'],
            [['old_password', 'new_password', 'confirm_password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'old_password' => \Yii::t('app', 'Old Password'),
            'new_password' => \Yii::t('app', 'New Password'),
            'confirm_password' => \Yii::t('app', 'Confirm Password'),
        ];
    }
    public function changePassword()
    {
        $user = \Yii::$app->user->identity;
        if ($this->validate()) {
            if ($user->validatePassword($this->old_password)) {
                $user->setPassword($this->new_password);
                $user->generateAuthKey();
                $user->generateAccessToken();
                if ($user->save()) {
                    return true;
                }
            } else {
                $this->addError("old_password", \Yii::t('app', 'Old password is incorrect'));
            }
        }
        return false;
    }
}