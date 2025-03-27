<?php

namespace api\actions;

use Yii;
use Closure;
use yii\base\Exception;
use yii\rest\Action;

/**
 * Index list page
 *
 * Class IndexAction
 * @package backend\actions
 */
class IndexAction extends Action
{
    public $afterPrepareDataProvider = null;
    /**
     * @var string|array primary key(s) name
     */
    public $primaryKeyIdentity = null;

    /**
     * @var string primary keys(s) from (GET or POST)
     */
    public $primaryKeyFromMethod = "GET";

    /**
     * @var array|\Closure assign to view variables
     */
    public $data;


    /**
     * index list
     *
     * @return string
     * @throws Exception
     */
    public function run()
    {
        //according assigned HTTP Method and param name to get value. will be passed to $this->>data closure.Often there is no need to get value on index, so default value is null.
        $primaryKeys = Helper::getPrimaryKeys($this->primaryKeyIdentity, $this->primaryKeyFromMethod);

        $data = $this->data;
        if( $data instanceof Closure){
            $params = [];
            if( !empty($primaryKeys) ){
                foreach ($primaryKeys as $primaryKey) {
                    array_push($params, $primaryKey);
                }
            }
            array_push($params, Yii::$app->getRequest()->getQueryParams());
            array_push($params, $this);
            //execute closure then assign to view, the closure params like function($_GET, primaryKeyValue1, primaryKeyValue1 ..., IndexAction)
            $data = call_user_func_array( $this->data, $params );
        }else if (!is_array($data) ){
            throw new Exception(__CLASS__ . "::data must be array or closure");
        }

        //default view template is action id
        if($this->afterPrepareDataProvider){
            $data = call_user_func_array($this->afterPrepareDataProvider, [$data]);
        }
        return $data;
    }

}