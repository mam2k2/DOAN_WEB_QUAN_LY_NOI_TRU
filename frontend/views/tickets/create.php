<?php

use yii\helpers\Html;

/** @var $model app\models\StudentRequest */

$this->title = 'Gửi yêu cầu KTX';
?>

<div class="student-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
