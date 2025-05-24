<?php

use yii\helpers\Html;

$this->title = 'Chỉnh sửa yêu cầu #' . $model->id;
?>

<div class="student-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
