<table class="table table-bordered table-hover">
    <thead class="table-primary">
    <tr>
        <th>ID</th>
        <th>Ngày thu</th>
        <th>Số tiền</th>
        <th>Trạng thái</th>
        <th class="text-center">Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($res as $value): ?>
        <tr>
            <td><?= $value->id ?></td>
            <td><?= Yii::$app->formatter->asDate($value->ngay_thu, 'php:d/m/Y'); ?></td>
            <td><?= \backend\helpers\DataHelper::formatMoneyVnd($value->so_tien) ?></td>
            <td><?= \common\models\ThuPhiNoiTru::getOptionsTrangThaiThaiText()[$value->trang_thai] ?></td>
            <td class="text-center">
                <div class="row p-3">
                    <?= \yii\helpers\Html::a("Xem thông tin", ["thong-tin-ca-nhan/lich-su-chi-tiet", "id" => $value->id], [
                        'class' => "btn btn-sm btn-success mb-1",
                    ]) ?>

                    <?php if ($value->trang_thai == \common\models\ThuPhiNoiTru::TRANGTHAI_CHUATHU): ?>
                    <button onclick="openQR(<?= $value->so_tien ?>, <?= $value->id ?>)" class="btn btn-sm btn-warning">
                        Nộp tiền (QR)
                    </button>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="mt-4">
    <a class="btn btn-outline-secondary" href="index.html">← Quay lại trang chủ</a>
</div>
<?php
$accountNo = '123456789'; // Số tài khoản nhận
$accountName = 'TRUONG CAO DANG GTVT'; // Tên người nhận
$bankCode = '970436'; // Mã ngân hàng, ví dụ: VCB, ACB, BIDV
?>
<div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title">Quét mã để nộp tiền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img id="qrImage" src="" alt="QR Code VietQR" class="img-fluid mb-3" />
                <div id="qrInfo" class="fw-bold">
                    Sẽ được duyệt sau 12-24h
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openQR(amount, id) {
        const accountNo = "<?= $accountNo ?>";
        const accountName = "<?= $accountName ?>";
        const bankCode = "<?= $bankCode ?>";
        const qrApi = `https://api.vietqr.io/v2/generate`;

        const body = {
            accountNo: accountNo,
            accountName: accountName,
            acqId: bankCode,
            amount: amount,
            format: "text",
            template: "compact2",
            addInfo: "THU PHI NOI TRU ID#" + id
        };

        fetch(qrApi, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(body)
        }).then(res => res.json())
            .then(data => {
                document.getElementById("qrImage").src = data.data.qrDataURL;
                new bootstrap.Modal(document.getElementById('qrModal')).show();
            });
    }
</script>
<?php
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [
    'depends' => [\yii\web\JqueryAsset::class],
    'position' => \yii\web\View::POS_END
]);?>