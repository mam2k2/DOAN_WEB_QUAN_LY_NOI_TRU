<?php
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [
    'position' => \yii\web\View::POS_END
]);
?>
<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4>NỘI QUY KÝ TÚC XÁ</h4>',
    'id' => 'rulesModal',
    'size' => 'modal-lg',
]);

echo <<<HTML
<strong>Trường Cao đẳng Giao thông Vận tải Đường thủy I</strong><br><br>

<b>I. Quy định chung</b><br>
- Chấp hành nghiêm chỉnh nội quy của trường, các quy định của ký túc xá và pháp luật của Nhà nước.<br>
- Có thái độ văn minh, lịch sự, tôn trọng người quản lý và các bạn cùng ở.<br>
- Tích cực giữ gìn vệ sinh chung, không vứt rác bừa bãi, tiết kiệm điện, nước.<br><br>

<b>II. Về giờ giấc</b><br>
- Giờ mở cổng: 05h30 – 22h00 hàng ngày.<br>
- Yên tĩnh sau 22h00 để đảm bảo học tập và nghỉ ngơi.<br>
- Không gây tiếng ồn, không bật nhạc to, không chơi thể thao trong phòng.<br>
- Khi ra ngoài sau 22h00 phải được sự cho phép của Ban quản lý KTX.<br><br>

<b>III. Về sinh hoạt</b><br>
- Giữ gìn vệ sinh phòng ở, khu vực chung. Tham gia trực nhật, tổng vệ sinh theo quy định.<br>
- Sử dụng đúng nơi quy định đối với rác thải, dụng cụ vệ sinh, đồ dùng chung.<br>
- Không nuôi gia súc, gia cầm, động vật hoang dã trong KTX.<br>
- Không nấu nướng, đun nước bằng các thiết bị không an toàn trong phòng.<br><br>

<b>IV. Về an ninh, trật tự</b><br>
- Không mang, tàng trữ, sử dụng vũ khí, chất cháy nổ, ma túy, chất kích thích.<br>
- Không tổ chức cờ bạc, uống rượu bia, tụ tập gây mất trật tự.<br>
- Không mượn, cho mượn, sang nhượng chỗ ở khi chưa được phép.<br>
- Khóa cửa cẩn thận khi ra ngoài, bảo quản tài sản cá nhân.<br><br>

<b>V. Về nghĩa vụ tài chính</b><br>
- Đóng phí nội trú đầy đủ, đúng hạn theo quy định của trường.<br>
- Chịu trách nhiệm bồi thường thiệt hại nếu làm hư hỏng tài sản của KTX.<br><br>

<b>VI. Khen thưởng và kỷ luật</b><br>
- <b>Khen thưởng:</b> Chấp hành tốt, giữ gìn vệ sinh, giúp đỡ bạn bè sẽ được khen.<br>
- <b>Kỷ luật:</b> Vi phạm sẽ bị nhắc nhở, cảnh cáo, buộc rời KTX hoặc xử lý bởi nhà trường.<br>
HTML;

\yii\bootstrap\Modal::end();
?>
<?php
$user = \common\models\User::findOne(['id' => Yii::$app->user->id]);
?>
<div class="list-group">
    <?= \yii\helpers\Html::a(Yii::t('frontend', '📘 Thông tin cá nhân'), ['thong-tin-ca-nhan/index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '💵 Lịch sử đóng tiền'), ['thong-tin-ca-nhan/lich-su-dong-tien'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '📢 Thông báo'), ['thong-tin-ca-nhan/thong-bao'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '⚠️ Lịch sử vi phạm'), ['thong-tin-ca-nhan/lich-su-vi-pham'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '✅ Lịch sử điểm danh'), ['thong-tin-ca-nhan/lich-su-diem-danh'], ['class' => 'list-group-item list-group-item-action']) ?>
    <a href="#" class='list-group-item list-group-item-action' data-bs-toggle="modal" data-bs-target="#rulesModal">📢 Nội quy ký túc xá</a>
    <?php if ($user && strpos($user->username, 'ph_') !== 0): ?>
        <?= \yii\helpers\Html::a(Yii::t('frontend', '✅ Phản ánh/Kiến nghị'), ['tickets/index'], ['class' => 'list-group-item list-group-item-action']) ?>
    <?php endif; ?>
    <?= \yii\helpers\Html::a(Yii::t('frontend', '❌ ' .\common\models\User::findOne(['id'=>Yii::$app->getUser()->getId()])->username.' - '.'Đăng xuất'), ['site/logout'], ['class' => 'list-group-item list-group-item-action']) ?>
</div>