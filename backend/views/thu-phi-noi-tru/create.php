<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\ThuPhiNoiTru */

$this->params['breadcrumbs'] = [
    ['label' => yii::t('app', 'Thu Phi Noi Tru'), 'url' => Url::to(['index'])],
    ['label' => yii::t('app', 'Create') .' '. yii::t('app', 'Thu Phi Noi Tru')],
];
?>
<?= $this->render('_form', [
    'model' => $model,
    'modelsChiTiet' => $modelsChiTiet,
    'listKhoan' => $listKhoan,
    'listTTHS' => $listTTHS,
    'listPhongO' => $listPhongO,
    'listGia' => $listGia,
]) ?>

