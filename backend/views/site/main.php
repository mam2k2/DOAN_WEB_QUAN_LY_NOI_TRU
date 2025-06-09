<?php

use backend\widgets\Bar;
use backend\grid\CheckboxColumn;
use backend\grid\ActionColumn;
use backend\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\YTeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tổng quan';
$this->params['breadcrumbs'][] = yii::t('app', 'Tổng quan');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="container mt-4">
                <h2 class="mb-4">📊 Thống kê tháng <?= date('m/Y') ?></h2>

                <div class="row g-4">
                    <!-- Số học sinh -->
                    <div class="col-md-4">
                        <div class="card shadow border-left-primary h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 text-primary">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted">Số học sinh</h6>
                                    <h4 class="mb-0"><?= $soHocSinh?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tổng tiền đã thu -->
                    <div class="col-md-4">
                        <div class="card shadow border-left-success h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 text-success">
                                    <i class="fa fa-usd"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted">Đã thu tháng này</h6>
                                    <h4 class="mb-0"><?=\backend\helpers\DataHelper::formatMoneyVnd($thucNhan)?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Số tiền còn nợ -->
                    <div class="col-md-4">
                        <div class="card shadow border-left-danger h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 text-danger">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted">Số tiền còn nợ</h6>
                                    <h4 class="mb-0"><?=\backend\helpers\DataHelper::formatMoneyVnd($tongTienDangNo)?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tổng doanh thu -->
                    <div class="col-md-4">
                        <div class="card shadow border-left-dark h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 text-dark">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted">Tổng doanh thu (thu + nợ)</h6>
                                    <h4 class="mb-0"><?=\backend\helpers\DataHelper::formatMoneyVnd($tongTienThu)?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Số vi phạm -->
                    <div class="col-md-4">
                        <div class="card shadow border-left-warning h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="me-3 text-warning">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-muted">Tổng vi phạm tháng</h6>
                                    <h4 class="mb-0"><?=$tongViPham?> lượt</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Học sinh vi phạm nhiều nhất -->
                    <div class="row mt-5">
                        <!-- Top 10 vắng mặt -->
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header bg-warning text-white">
                                    <i class="fa fa-user-times"></i> Top 10 học sinh vắng mặt nhiều nhất
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Họ tên</th>
                                            <th>Lớp</th>
                                            <th>Số ngày</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($topVang as $i => $hs): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= \yii\helpers\Html::encode($hs['ho_va_ten']) ?></td>
                                                <td><?= \yii\helpers\Html::encode($hs['ten_lop']) ?></td>
                                                <td><span class="badge bg-warning text-dark"><?= $hs['so_vang'] ?> ngày</span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Top 10 vi phạm -->
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header bg-danger text-white">
                                    <i class="fa fa-user-secret"></i> Top 10 học sinh vi phạm nhiều nhất
                                </div>
                                <div class="card-body p-0">

                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Họ tên</th>
                                            <th>Lớp</th>
                                            <th>Lượt vi phạm</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($topViPham as $i => $hs): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= \yii\helpers\Html::encode($hs['ho_va_ten']) ?></td>
                                                <td><?= \yii\helpers\Html::encode($hs['ten_lop']) ?></td>
                                                <td><span class="badge bg-danger"><?= $hs['so_vp'] ?> lần</span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
