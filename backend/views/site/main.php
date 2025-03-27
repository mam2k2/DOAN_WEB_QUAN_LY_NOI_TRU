<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-31 14:17
 */

use common\models\UnitTransaction;
use common\widgets\JsBlock;
use yii\helpers\Url;

/**
 * @var $statics array
 * @var $this yii\web\View
 * @var array $comments latest comments
 */
$this->registerCss("
     .environment .list-group-item > .badge {float: left}
     .environment  li.list-group-item strong {margin-left: 15px}
     ul#notify .list-group-item{line-height:15px}
")
?>
<div class="row">
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right"><?php //= //Yii::t('app', 'Month') ?></span>
                <h5><?= Yii::t('app', 'Products') ?></h5>
            </div>
            <div class="ibox-content openContab" href="<?=Url::to(['product/index'])?>" title="<?= Yii::t('app', 'Products')?>" style="cursor: pointer">
                <h1 class="no-margins"><?= $statics['PRODUCT'][0] ?></h1>
                <div class="stat-percent font-bold text-success"><?= $statics['PRODUCT'][1] ?>% <i class="fa fa-bolt"></i></div>
                <small><?= Yii::t('app', 'Total') ?></small>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right"><?= Yii::t('app', 'Today') ?></span>
                <h5><?= Yii::t('app', 'Tickets') ?></h5>
            </div>
            <div class="ibox-content openContab" href="<?=Url::to(['unit-transaction/index',  'UnitTransactionSearch' => ['unit' => UnitTransaction::UNIT_TICKET]])?>" title="<?= Yii::t('app', 'Tickets')?>" style="cursor: pointer">
                <h1 class="no-margins"><?= $statics['TICKET'][0] ?></h1>
                <div class="stat-percent font-bold text-info"><?= $statics['TICKET'][1] ?>% <i class="fa fa-level-up"></i></div>
                <small><?= Yii::t('app', 'Total') ?></small>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-primary pull-right"><?= Yii::t('app', 'Today') ?></span>
                <h5><?= Yii::t('app', 'NFTs') ?></h5>
            </div>
            <div class="ibox-content openContab" href="<?=Url::to(['unit-transaction/index', 'UnitTransactionSearch' => ['unit' => UnitTransaction::UNIT_NFT]])?>" title="<?= Yii::t('app', 'NFTs')?>" style="cursor: pointer">
                <h1 class="no-margins"><?= $statics['NFT'][0] ?></h1>
                <div class="stat-percent font-bold text-navy"><?= $statics['NFT'][1] ?>% <i class="fa fa-level-up"></i></div>
                <small><?= Yii::t('app', 'Total') ?></small>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-success pull-right"><?= Yii::t('app', 'Today') ?></span>
                <h5><?= Yii::t('app', 'Orders') ?></h5>
            </div>
            <div class="ibox-content openContab" href="<?=Url::to(['order/index'])?>" title="<?= Yii::t('app', 'Orders')?>" style="cursor: pointer">
                <h1 class="no-margins"><?= $statics['ORDER'][0] ?></h1>
                <div class="stat-percent font-bold text-info"><?= $statics['ORDER'][1] ?>% <i class="fa fa-level-up"></i></div>
                <small><?= Yii::t('app', 'Total') ?></small>
            </div>
        </div>
    </div>
</div>

<?php JsBlock::begin() ?>
<script>
//$(document).ready(function () {
//    var notify = $("#notify");
//    $.ajax({
//        dataType:"jsonp",
//        url:"//api.feehi.com/cms/notify?ver=<?//=Yii::$app->getVersion()?>//",
//        success:function (dataAll) {
//            data = dataAll.rows;
//            notify.empty();
//            var lis = "";
//            for(var index in data){
//                var label = '';
//                if( data[index].label ){
//                    label = data[index].label;
//                }
//                lis += "<li class='list-group-item'> \
//                                <a target='_blank' class='' href=\" " + data[index].href +" \"> " + data[index].title + " </a>\
//                                " + label +  "\
//                                <small class='pull-right block'>" + data[index].createdAt + "</small> \
//                        </li>"
//            }
//            notify.append(lis);
//        },
//        error:function (data) {
//            notify.empty();
//            notify.append("<li class='list-group-item'>Connect error</li>");
//        }
//    });
//})
</script>
<?php JsBlock::end() ?>
