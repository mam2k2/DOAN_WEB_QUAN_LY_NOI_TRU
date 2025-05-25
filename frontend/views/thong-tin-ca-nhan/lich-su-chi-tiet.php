<?php
use backend\helpers\DataHelper;

$tongTien = 0;
?>

<div class="card shadow">
    <div class="card-header bg-info text-white">
        Hóa đơn #<?= $thuPhi->id ?> - Ngày <?= Yii::$app->formatter->asDate($thuPhi->ngay_thu, 'php:d/m/Y') ?>
    </div>
    <div class="card-body">
        <h5 class="card-title">Thông tin học sinh</h5>
        <p><strong>Họ tên:</strong> <?= $thongTin->ho_va_ten ?></p>
        <p><strong>Lớp:</strong> <?= $thongTin->lop->ten_lop ?? '(chưa có lớp)' ?></p>
        <p><strong>Mã học sinh:</strong> <?= $thongTin->id ?? '(n/a)' ?></p>
        <p><strong>Trạng thái:</strong>
            <?php if ($thuPhi->trang_thai == \common\models\ThuPhiNoiTru::TRANGTHAI_DATHU): ?>
                <span class="text-success fw-bold">Đã đóng</span>
            <?php else: ?>
                <span class="text-danger fw-bold">Chưa đóng</span>
                <button onclick="openQR(<?= $thuPhi->so_tien ?>, <?= $thuPhi->id ?>)" class="btn btn-sm btn-warning">
                    Nộp tiền (QR)
                </button>
            <?php endif; ?>
        </p>

        <hr>

        <h5 class="card-title">Chi tiết thanh toán</h5>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mô tả</th>
                <th class="text-end">Số tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($thongTinChiTiets as $index => $ct): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $ct->khoanPhi->ten_khoan_phi?></td>
                    <td class="text-end"><?= DataHelper::formatMoneyVnd($ct->so_tien) ?></td>
                </tr>
                <?php $tongTien += $ct->so_tien; ?>
            <?php endforeach; ?>
            <tr class="table-primary">
                <td colspan="2" class="text-end">Ưu tiên : <?=\common\models\ThongTinHocSinh::getUuTien( )[$thongTin->uu_tien]?><strong></strong></td>
                <td class="text-end"><strong><?= DataHelper::formatMoneyVnd(-($tongTien /100 * $thongTin->uu_tien)). " (".$thongTin->uu_tien."%)"?></strong></td>
            </tr>
            <tr class="table-primary">
                <td colspan="2" class="text-end"><strong>Tổng cộng</strong></td>
                <td class="text-end"><strong><?= DataHelper::formatMoneyVnd($tongTien-($tongTien /100 * $thongTin->uu_tien)) ?></strong></td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
    <a href="<?= Yii::$app->request->referrer ?: ['index'] ?>" class="btn btn-outline-secondary mt-3">← Quay lại</a>

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