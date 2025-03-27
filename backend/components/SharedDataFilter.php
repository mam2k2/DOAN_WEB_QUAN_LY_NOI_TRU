<?php

namespace app\components;

use common\models\AdminUser;
use Yii;
use yii\base\Action;
use yii\base\ActionFilter;
use yii\base\InvalidConfigException;

class SharedDataFilter extends ActionFilter
{
    /**
     * @param Action $action
     * @return bool
     * @throws InvalidConfigException
     * @throws \Throwable
     */
    public function beforeAction($action)
    {
        $shared = [
            'auth' => [
                'user' => $this->getUser()
            ],
            'flash' => $this->getFlashMessages(),
            'errors' => $this->getErrors(),
            'filters' => [
                'search' => null,
                'trashed' => null
            ]
        ];

        Yii::$app->get('inertia')->share($shared);

        return true;
    }

    /**
     * @return array|null
     * @throws \Throwable
     */
    private function getUser()
    {
        $webUser = Yii::$app->getUser();
        if ($webUser->isGuest) {
            return null;
        }

        /** @var AdminUser */
        $user = $webUser->getIdentity();

        $return = [
            'id' => $user->id,
            'email' => $user->email,
            'role' => null,
        ];

        return $return;
    }

    /**
     * @return array
     */
    private function getFlashMessages()
    {
        $flash = [
            'success' => null,
            'error' => null,
        ];
        if (Yii::$app->session->hasFlash('success')) {
            $flash['success'] = Yii::$app->session->getFlash('success');
        }
        if (Yii::$app->session->hasFlash('error')) {
            $flash['error'] = Yii::$app->session->getFlash('error');
        }
        return $flash;
    }

    /**
     * @return object
     */
    private function getErrors()
    {
        $errors = [];
        if (Yii::$app->session->hasFlash('errors')) {
            $errors = (array)Yii::$app->session->getFlash('errors');
        }
        return (object) $errors;
    }

}