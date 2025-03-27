<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace api\actions;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;

/**
 * CreateAction implements the API endpoint for creating a new model from the given data.
 *
 * For more details and usage information on CreateAction, see the [guide article on rest controllers](guide:rest-controllers).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UpdateAction extends \api\actions\Action
{
    /**
     * @var string the scenario to be assigned to the new model before it is validated and saved.
     */
    public $scenario = Model::SCENARIO_DEFAULT;
    /**
     * @var string the name of the view action. This property is needed to create the URL when the model is successfully created.
     */
    public $viewAction = 'view';

    public $doUpdate;
    public $minCountData = 0;


    /**
     * Creates a new model.
     * @return \yii\db\ActiveRecordInterface the model newly created
     * @throws ServerErrorHttpException if there is any error when creating the model
     */
    public function run($id)
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }
        $postData = $this->getDataPost();
        $result = false;
        if($this->doUpdate){
            $data = [];
            if (is_array($postData)) {
                if($this->typeData == Action::RAW_BODY && count($postData) == $this->minCountData)
                    throw new BadRequestHttpException("Dữ liệu truyền tải không hợp lệ");
                $formName = explode('\\',$this->modelClass);
                $formName = $formName[count($formName) -1];
                foreach ($postData as $key => $item) {
                    $data[$formName][$key] = $item;
                }
                $result = call_user_func($this->doUpdate,$id, $data);
            }
        }

        /* @var $model \yii\db\ActiveRecord */
        if ($result === true) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            //$id = implode(',', $model->getPrimaryKey(true));
            //$response->getHeaders()->set('Location', Url::toRoute([$this->viewAction, 'id' => $id], true));
            if($this->doSuccess){
                return call_user_func($this->doSuccess, $result);
            }
            return  [
                'success'=>true,
                'message'=>"Cập nhật đối tượng thành công",
            ];
        }elseif ($result == false){
            return [
                'success'=>false,
                'message'=>"Lỗi hệ thống!",
            ];
        }
        elseif (!$result->hasErrors()) {
            /**
             * @var $result Model
             */
            Yii::$app->response->statusCode = 500;
            return [
                'success'=>false,
                'message'=>"Lỗi hệ thống!",
            ];
        }
        if($this->doFail){
            return call_user_func($this->doFail, $result);
        }

        return [ 'success' => false,'message' => "Cập nhật đối tượng thất bại","errorDetails" => $result];
    }
}
