<div class="list-group">
    <?= \yii\helpers\Html::a(Yii::t('frontend', '📘 Thông tin cá nhân'), ['thong-tin-ca-nhan/index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '💵 Lịch sử đóng tiền'), ['thong-tin-ca-nhan/lich-su-dong-tien'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '📢 Thông báo'), ['thong-tin-ca-nhan/thong-bao'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '⚠️ Lịch sử vi phạm'), ['thong-tin-ca-nhan/lich-su-vi-pham'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '✅ Lịch sử điểm danh'), ['thong-tin-ca-nhan/lich-su-diem-danh'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '❌ ' .\common\models\User::findOne(['id'=>Yii::$app->getUser()->getId()])->username.' - '.'Đăng xuất'), ['site/logout'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>