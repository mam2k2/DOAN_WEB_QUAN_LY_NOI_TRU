<?php

namespace api\models\form;

use api\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use yii\web\BadRequestHttpException;

class ReSendVerifyEmailForm extends Model
{
    /**
     * @var \api\models\User
     */
    private $_user;
    public $email;


    /**
     * Creates a form model given a token.
     *
     * @param  string $token
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($email, $config = [])
    {
        if (empty($email) || ! is_string($email)) {
            throw new BadRequestHttpException(\Yii::t("app","Email cannot be blank."));
        }
        $this->_user = User::findByEmail($email);
        if (! $this->_user) {
            throw new BadRequestHttpException(\Yii::t("app","Email not valid"));
        }

        parent::__construct($config);
    }

    public function sendEmailVerify(){
        if ( $this->_user->isVeri()) {
            $this->addError("email",\Yii::t("app","Email has been verified."));
            return false;
        }
        $this->_user->updateAttributes(['email_verify_token' => \Yii::$app->security->generateRandomString() . '_' . time()]);
        if(!$this->_user->sendMailConfirm()) {
            $this->addError("email",\Yii::t("app","Failed to send email."));
            return false;
        }
        return true;
    }

}