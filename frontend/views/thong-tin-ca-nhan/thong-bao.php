<div class="card shadow">
    <div class="card-header bg-primary text-white">
        Thông báo hệ thống
    </div>
    <div class="card-body">
        <?php if (!empty($allThongBao)): ?>
            <?php foreach ($allThongBao as $thongBao): ?>
                <div class="border rounded p-3 mb-3 bg-light">
                    <div class="fw-bold fs-5 text-dark">
                        <?= htmlspecialchars($thongBao->tieu_de) ?>
                        <span class="text-muted float-end fs-6">
              [<?= Yii::$app->formatter->asDate($thongBao->ngay_gui, 'php:d/m/Y') ?>]
            </span>
                    </div>
                    <div class="text-muted mt-2" style="font-size: 0.95rem;">
                        <?= nl2br(htmlspecialchars($thongBao->noi_dung)) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-success">Hiện chưa có thông báo nào.</div>
        <?php endif; ?>
    </div>
</div>
<div class="mt-4">
    <a class="btn btn-outline-secondary" href="<?= Yii::$app->request->referrer ?: ['index'] ?>">← Quay lại trang chủ</a>
</div>