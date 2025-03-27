<?php
use common\helpers\Util;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Util::assembleAbsoluteURL(['admin-user/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

<?= yii::t('app', 'Follow the link below to reset your password') ?>:

<?= explode("-",$user->email_verify_token)[0] ?>
