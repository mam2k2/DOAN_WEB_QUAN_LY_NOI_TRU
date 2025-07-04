<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2020-01-29 15:31
 */

namespace common\services;

interface AdminUserServiceInterface extends ServiceInterface
{
    const ServiceName = 'adminUserService';

    const scenarioCreate = "create";
    const scenarioUpdate = "update";
    const scenarioSelfUpdate = "self-update";

    public function selfUpdate($id, array $postData, array $options=[]);

    public function newPasswordResetRequestForm();

    public function sendResetPasswordLink($postData);

    public function newResetPasswordForm($token);

    public function resetPassword($token, $postData);

    /**
     * @return array
     */
    public function getAdminUserOptions();
    public function getGiaoVienOptions($options = []);
}