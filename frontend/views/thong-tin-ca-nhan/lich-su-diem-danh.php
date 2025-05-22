<?php
function renderLich($label, $data) {
    echo "<div class='card shadow mb-4'>";
    echo "<div class='card-header bg-dark text-white'>{$label}</div>";
    echo "<div class='card-body'>";
    if (!empty($data)) {
        echo "<ul class='list-group'>";
        foreach ($data as $row) {
            $date = Yii::$app->formatter->asDate($row['ngay'], 'php:d/m/Y');
            $badge = $row['trang_thai'] === 'Có mặt'
                ? "<span class='badge bg-success'>Có mặt</span>"
                : "<span class='badge bg-danger'>Vắng không phép</span>";
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>{$date} {$badge}</li>";
        }
        echo "</ul>";
    } else {
        echo "<div class='alert alert-info'>Không có dữ liệu.</div>";
    }
    echo "</div></div>";
}
?>
<?php renderLich('🗓️ Tháng này', $lichThangNay); ?>

<?php renderLich('🔙 Tháng trước', $lichThangTruoc); ?>

<div class="mt-4">
    <a class="btn btn-outline-secondary" href="<?= Yii::$app->request->referrer ?: ['index'] ?>">← Quay lại trang chủ</a>
</div>
