<?php

namespace api\controllers;

use api\models\form\ForgotPasswordForm;
use api\models\form\LoginForm;
use api\models\form\ReSendVerifyEmailForm;
use api\models\form\SignupForm;
use common\libs\Constants;
use common\models\User;
use common\services\BalanceVolatilityServiceInterface;
use Dotenv\Exception\ValidationException;
use Yii;
use yii\web\IdentityInterface;

class SiteController extends BaseController
{
    public $modelClass = "common\models\Article";
    public $optionals = ['index', 'send-mail', 'login', 'register', 'forgot-password'];

    public function actions()
    {
        return [];
    }

    public function verbs()
    {
        return [
            'index' => ['GET', 'HEAD'],
            'send-mail' => ['GET'],
            'login' => ['POST'],
            'register' => ['POST'],
            'forgot-password' => ['POST'],
            'load-data' => ['GET']
        ];
    }
    public function actionLogin()
    {
        $loginForm = new LoginForm();
        $loginForm->setAttributes( Yii::$app->getRequest()->post() );
        if ($user = $loginForm->login()) {
            if ($user instanceof IdentityInterface) {
                return [
                    'accessToken' => $user->access_token,
                    "message" =>  Yii::t("app","Login success"),
                    'expiredAt' => Yii::$app->params['user.apiTokenExpire'] + time()
                ];
            } else {
                Yii::$app->response->statusCodeByException = 422;
                return [
                    "message" => Yii::t("app","Login fail"),
                    "errorDetail" => $loginForm
                ];
            }
        } else {
            Yii::$app->response->statusCodeByException = 422;
            return [
                "message" => Yii::t("app","Login fail"),
                "errorDetail" => $loginForm
            ];
        }

    }

    /**
     * 注册
     *
     * POST /register
     * {"username":"xxx", "password":"xxxxxxx", "email":"x@x.com"}
     *
     * @return array
     */
    public function actionRegister()
    {
        $signupForm = new SignupForm();
        $signupForm->load( Yii::$app->getRequest()->post(),"" );
        $transaction = Yii::$app->db->beginTransaction();
        try{
            if( ($user = $signupForm->signup()) instanceof User){
                $transaction->commit();
                return [
                    "success" => true,
                    "message" => Yii::t("app","Sign up success"),
                    "username" => $user->username,
                    "email" => $user->email
                ];
            }else{
                throw new \Exception('Error');
            }
        }catch (\Exception $e){
            $transaction->rollBack();
            Yii::$app->response->statusCode = 422;
            return [
                "success" => false,
                "message" => Yii::t("app","Sign up fail"),
                "errorDetails" => $signupForm
            ];
        }
    }
    public function actionForgotPassword()
    {
        $signupForm = new ForgotPasswordForm();
        $signupForm->load( Yii::$app->getRequest()->post(),"" );
        if( ($user = $signupForm->sendLinkResetPassword()) instanceof User){
            return [
                "success" => true,
                "message" => Yii::t("app","Email has sent success"),
                "email" => $user->email
            ];
        }else{
            Yii::$app->response->statusCode = 404;
            return [
                "success" => false,
                "message" => Yii::t("app","Failed to send email"),
                "errorDetails" => $signupForm
            ];
        }
    }
    public function actionSendMail($email)
    {
        try {
            $reSendForm = new ReSendVerifyEmailForm($email);
        }catch (ValidationException $e){
            Yii::$app->response->statusCode = 422;
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        if($reSendForm->sendEmailVerify()){
            return [
                "success" => true,
                "message" => Yii::t("app","Email has sent success"),
                "email" => $email
            ];
        }else{
            Yii::$app->response->statusCode = 404;
            return [
                "success" => false,
                "message" => Yii::t("app","Failed to send email"),
                "errorDetails" => $reSendForm
            ];
        }
    }
    public function actionLoadData(){
        $user = Yii::$app->getUser()->getIdentity();
        return [
            "user" => $user
        ];
    }
}