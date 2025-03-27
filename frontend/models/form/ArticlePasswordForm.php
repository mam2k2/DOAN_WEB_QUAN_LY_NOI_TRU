<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-09-04 22:59
 */

namespace frontend\models\form;

use Yii;
use common\models\Article;

class ArticlePasswordForm extends \yii\base\Model
{
    public $password;

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'max'=>20]
        ];
    }

    public function attributeLabels()
    {
        return [
            "password" => Yii::t('app', 'Password'),
        ];
    }

    public function checkPassword($id)
    {
        if( $this->password == Article::findOne($id)['password'] ){
            $session = Yii::$app->getSession();
            $session->set("article_password_" . $id, true);
            return true;
        }
        $this->addError('password', Yii::t('frontend', 'Password error'));
        return false;
    }
}