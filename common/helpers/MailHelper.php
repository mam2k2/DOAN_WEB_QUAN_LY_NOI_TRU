<?php

namespace common\helpers;

class MailHelper
{
    public static function send($to, $subject, $body)
    {
        $mail = \Yii::$app->mailer->compose();
        $mail->setTo($to);
        $mail->setSubject($subject);
        $mail->setHtmlBody($body);
        return $mail->send();
    }
}