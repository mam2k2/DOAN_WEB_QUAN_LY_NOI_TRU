<?php

namespace api\actions;

use api\helper\JwtHelper;
use api\models\forms\LoginForm;
use Dersonsena\JWTTools\JWTTools;
use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\IdentityInterface;
use Yii;

class LoginAction extends Action
{
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'login';

    public $responseSuccess;

    public $modelClass = LoginForm::class;

    public $loginFunction;

    public $responseFail;
    public const DATA_MODEL = ['user_id', 'access_token','versionApp','phoneName','phoneId','platform'];
    public const DATA_MODEL_NEED_APPROVED = ['versionApp','phoneName','phoneId','platform'];

    public function run()
    {
        $postData = $this->getDataPost();
        $loginForm = new LoginForm();
        $loginForm->setAttributes( $postData );
        if ($user = $loginForm->login()) {
            if ($user instanceof IdentityInterface) {
                return [
                    'success' => true,
                    'message'=>'Đăng nhập thành công!',
                    'accessToken' => JwtHelper::genJwtToken($user->accessToken,self::DATA_MODEL),
                    'expiredAt' => Yii::$app->params['user.api.TokenExpire'] + time()
                ];
            } else {
                return [
                    'message'=> "Đăng nhập thất bại",
                    "success" =>  false,
                    "errorDetails"=>$user
                ];
            }
        } else {
            return [
                'message'=> "Đăng nhập thất bại",
                "success" =>  false,
                "errorDetails"=>$loginForm
            ];
        }
    }

}