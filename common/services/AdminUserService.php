<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2020-01-29 15:31
 */

namespace common\services;


use Yii;
use backend\models\form\PasswordResetRequestForm;
use backend\models\form\ResetPasswordForm;
use backend\models\search\AdminUserSearch;
use common\models\AdminUser;
use yii\helpers\ArrayHelper;

class AdminUserService extends Service implements AdminUserServiceInterface
{

    public function getSearchModel(array $options = [])
    {
        return new AdminUserSearch();
    }

    public function getModel($id, array $options = [])
    {
        $model = AdminUser::findOne($id);

        if( isset($options['scenario']) && !empty($options['scenario']) ){
            if($model !== null) {
                $model->setScenario($options['scenario']);
            }
        }

        return $model;
    }

    public function newModel(array $options = [])
    {
        $model = new AdminUser();

        if( isset($options['scenario']) && !empty($options['scenario']) ){
            $model->setScenario($options['scenario']);
        }

        $loadDefaultValues = isset($options['loadDefaultValues']) && is_bool($options['loadDefaultValues']) ? $options['loadDefaultValues'] : true;
        if($loadDefaultValues) {
            $model->loadDefaultValues();
        }

        return $model;
    }

    public function create(array $postData, array $options = [])
    {
        $model = $this->newModel();
        $model->setScenario('create');
        if ( $model->load($postData) && $model->save() ) {
            /** @var RBACServiceInterface $RBACService */
            $RBACService = Yii::$app->get(RBACServiceInterface::ServiceName);
            $result = $RBACService->assignPermission($postData, $model->getId());
            if( $result !== true ){
                Yii::error("create admin user success but assign permission failed:" . print_r($result, true));
            }
            return true;
        } else {
            return $model;
        }
    }
    public function getGiaoVienOptions($options = [])
    {
        $list = ArrayHelper::map(
            AdminUser::find()
                ->select(['id', 'ho_va_ten'])
                ->where($options)
                ->andWhere([
                    'type' => AdminUser::TYPE_GIAO_VIEN
                ])
                ->asArray()
                ->all(),
            'id',
            function ($row) {
                return  $row['ho_va_ten'];
            });
        return $list;
    }

    public function update($id, array $postData, array $options = [])
    {
        $model = $this->getModel($id);
        $scenario = "update";
        $model->setScenario($scenario);
        if ( $model->load($postData) && $model->save() ) {
            /** @var RBACServiceInterface $RBACService */
            $RBACService = Yii::$app->get(RBACServiceInterface::ServiceName);
            $result = $RBACService->assignPermission($postData, $model->getId());
            if( $result !== true ){
                Yii::error("update admin user success but assign permission failed:" . print_r($result, true));
            }
            return true;
        } else {
            return $model;
        }
    }

    public function selfUpdate($id, array $postData, array $options = [])
    {
        $model = $this->getModel($id);
        $scenario = "self-update";
        $model->setScenario($scenario);
        if ( $model->load($postData) && $model->save() ) {
            return true;
        } else {
            return $model;
        }
    }

    public function newPasswordResetRequestForm()
    {
        return new PasswordResetRequestForm();
    }

    public function sendResetPasswordLink($postData)
    {
        $model = $this->newPasswordResetRequestForm();
        if ( $model->load($postData) && $model->validate() ) {
            $result = $model->sendEmail();
            if( $result === false ){
                Yii::error("send reset password link error" . print_r($model, true));
            }
            return $result;
        }
        return $model;
    }

    public function newResetPasswordForm($token)
    {
        return new ResetPasswordForm($token);
    }

    public function resetPassword($token, $postData)
    {
        $model = $this->newResetPasswordForm($token);
        if ( $model->load($postData) && $model->validate() && $model->resetPassword() ) {
            return true;
        }
        return $model;
    }

    public function getAdminUserOptions()
    {
        return ArrayHelper::map(AdminUser::find()->select(['id', 'username'])->all(), 'id', 'username');
        // TODO: Implement getAdminUserOptions() method.
    }
}