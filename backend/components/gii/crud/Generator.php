<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2018-10-08 22:17
 */

namespace backend\components\gii\crud;

use Yii;
use ReflectionClass;
use yii\db\Schema;
use yii\gii\CodeFile;
use yii\helpers\StringHelper;

class Generator extends \yii\gii\generators\crud\Generator
{
    /**
     * @param string $attribute
     * @return string
     */
    public function generateActiveSearchField($attribute)
    {
        $tableSchema = $this->getTableSchema();
        if ($tableSchema === false) {
            return "\$form->field(\$model, '$attribute', ['options'=>['class'=>'col-sm-3']])";
        }

        $column = $tableSchema->columns[$attribute];
        if ($column->phpType === 'boolean') {
            return "\$form->field(\$model, '$attribute')->checkbox()";
        }

        return "\$form->field(\$model, '$attribute', ['options'=>['class'=>'col-sm-3']])";
    }

    public function formView()
    {
        $class = new ReflectionClass(\yii\gii\generators\crud\Generator::className());

        return dirname($class->getFileName()) . '/form.php';
    }

    public function generate()
    {
        $controllerFile = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->controllerClass, '\\')) . '.php');

        $files = [
            new CodeFile($controllerFile, $this->render('controller.php')),
        ];

        if (!empty($this->searchModelClass)) {
            $searchModel = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->searchModelClass, '\\') . '.php'));
            $files[] = new CodeFile($searchModel, $this->render('search.php'));
        }

        $modelClass = StringHelper::basename($this->modelClass);

        $files[] = new CodeFile(Yii::getAlias("@common/services/") . $modelClass . 'ServiceInterface.php', $this->render("serviceInterface.php"));

        $files[] = new CodeFile(Yii::getAlias("@common/services/") . $modelClass . 'Service.php', $this->render("service.php"));

        $viewPath = $this->getViewPath();
        $templatePath = $this->getTemplatePath() . '/views';
        foreach (scandir($templatePath) as $file) {
            if (empty($this->searchModelClass) && $file === '_search.php') {
                continue;
            }
            if (is_file($templatePath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $files[] = new CodeFile("$viewPath/$file", $this->render("views/$file"));
            }
        }
        $type = Yii::$app->getRequest()->post("generate");
        if( $type !== null ){
            $services = require Yii::getAlias("@common/config/") . 'services.php';
            $key = $modelClass . "Service";
            if( !isset($services[$key]) ) {
                $str = file_get_contents(Yii::getAlias("@common/config/") . 'services.php');
                $lines = explode("\n", $str);
                foreach ($lines as $key => $line) {
                    $line = trim($line);
                    if (empty($line)) {
                        unset($lines[$key]);
                    }
                }
                $temp[] = "    \\common\services\\" . $modelClass . "ServiceInterface::ServiceName=>[";
                $temp[] = "        'class' => \\common\services\\" . $modelClass . "Service::className(),";
                $temp[] = "    ],";
                array_splice($lines, count($lines) - 1, 0, $temp);
                file_put_contents(Yii::getAlias("@common/config/") . 'services.php', implode("\n", $lines));
            }
        }
        return $files;
    }

    /**
     * Generates search conditions
     * @return array
     */
    public function generateSearchConditions()
    {
        $columns = [];
        if (($table = $this->getTableSchema()) === false) {
            $class = $this->modelClass;
            /* @var $model \yii\base\Model */
            $model = new $class();
            foreach ($model->attributes() as $attribute) {
                $columns[$attribute] = 'unknown';
            }
        } else {
            foreach ($table->columns as $column) {
                $columns[$column->name] = $column->type;
            }
        }

        $likeConditions = [];
        $hashConditions = [];
        foreach ($columns as $column => $type) {
            switch ($type) {
                case Schema::TYPE_TINYINT:
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                case Schema::TYPE_BOOLEAN:
                case Schema::TYPE_FLOAT:
                case Schema::TYPE_DOUBLE:
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                    $hashConditions[] = "self::tableName().'.{$column}' => \$this->{$column},";
                    break;
                default:
                    $likeKeyword = $this->getClassDbDriverName() === 'pgsql' ? 'ilike' : 'like';
                    $likeConditions[] = "->andFilterWhere(['{$likeKeyword}', self::tableName().'.{$column}', \$this->{$column}])";
                    break;
            }
        }

        $conditions = [];
        if (!empty($hashConditions)) {
            $conditions[] = "\$query->andFilterWhere([\n"
                . str_repeat(' ', 12) . implode("\n" . str_repeat(' ', 12), $hashConditions)
                . "\n" . str_repeat(' ', 8) . "]);\n";
        }
        if (!empty($likeConditions)) {
            $conditions[] = "\$query" . implode("\n" . str_repeat(' ', 12), $likeConditions) . ";\n";
        }

        return $conditions;
    }

}