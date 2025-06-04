
<div class="card shadow mx-auto" >
    <div class="card-body text-center">
        <img src="<?= $thongtin->anh_chan_dung ?>" alt="Ảnh học sinh"
             class="avatar img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">

        <!-- Trạng thái học sinh -->
        <div class="mb-3">
            <span class="badge bg-<?= $thongtin->trangThaiBadgeColor ?> px-3 py-2 fs-6">
                <?= $thongtin->trangThaiText ?>
            </span>
        </div>

        <ul class="list-group text-start">
            <li class="list-group-item"><strong>Họ tên:</strong> <?= $thongtin->ho_va_ten ?></li>
            <li class="list-group-item"><strong>Ngày sinh:</strong> <?= Yii::$app->formatter->asDate($thongtin->ngay_sinh, 'php:d/m/Y') ?></li>
            <li class="list-group-item"><strong>Lớp:</strong> <?= $thongtin->lop->ten_lop ?? '(chưa có lớp)' ?></li>
            <li class="list-group-item"><strong>Phòng đang ở:</strong> <?= $thongtin->tenPhong ?? '(chưa có phòng)' ?></li>
            <li class="list-group-item"><strong>CMND/CCCD:</strong> <?= $thongtin->cccd ?></li>
        </ul>


    </div>
</div>
<div class="mt-4">
    <a class="btn btn-outline-secondary" href="<?= Yii::$app->request->referrer ?: ['index'] ?>">← Quay lại trang chủ</a>
</div>