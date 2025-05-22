<div class="card shadow">
    <div class="card-header bg-danger text-white">
        Lịch sử vi phạm nội quy
    </div>
    <div class="card-body">
        <?php if (!empty($viPham)): ?>
            <ul class="list-group">
                <?php foreach ($viPham as $vp): ?>
                    <li class="list-group-item">
                        <?= Yii::$app->formatter->asDate($vp->ngay_vi_pham, 'php:d/m/Y') ?>
                        – <?= htmlspecialchars($vp->mo_ta) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-success">Không có vi phạm nào.</div>
        <?php endif; ?>


    </div>
</div>
<div class="mt-4">
    <a class="btn btn-outline-secondary" href="<?= Yii::$app->request->referrer ?: ['index'] ?>">← Quay lại trang chủ</a>
</div>