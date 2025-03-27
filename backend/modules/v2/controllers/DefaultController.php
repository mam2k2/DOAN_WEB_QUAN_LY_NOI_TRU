<?php

namespace backend\modules\v2\controllers;

use backend\modules\v2\models\form\LoginForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `v2` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->inertia('Dashboard/Index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $postData = Yii::$app->request->post();
        $model = new LoginForm();
        if ($model->load($postData, '')) {
            if ($model->login()) {
                return $this->goBack();
            }
            Yii::$app->session->setFlash('errors', $model->getErrors());
        }

        return $this->inertia('Auth/Login');
    }
}
