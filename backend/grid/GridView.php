<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-03-21 18:45
 */

namespace backend\grid;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridViewAsset;
use yii\helpers\Json;
use yii\widgets\BaseListView;

/**
 * @inheritdoc
 */
class GridView extends \yii\grid\GridView
{
    /* @var $dataColumnClass \backend\grid\DataColumn */
    public $dataColumnClass = 'backend\grid\DataColumn';

    public $options = ['class' => 'fixed-table-header', 'style' => 'margin-right: 0px;'];

    public $tableOptions = ['class' => 'table table-hover table-bordered'];

    public $layout = "{items}\n<div class='row'><div class='col-sm-3' style='line-height: 567%'>{summary}</div><div class='col-sm-9'><div class='dataTables_paginate paging_simple_numbers'>{pager}</div></div></div>";

    public $pagerOptions = null;

    public $filterRow;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if( !$this->rowOptions && $this->rowOptions !== false ) {
            $this->rowOptions = function ($model, $key, $index, $grid) {
                if ($index % 2 === 0) {
                    return ['class' => 'odd'];
                } else {
                    return ['class' => 'even'];
                }
            };
        }
        if( !$this->pagerOptions && $this->pagerOptions !== false ) {
            $this->pagerOptions = [
                'firstPageLabel' => Yii::t('app', 'first'),
                'lastPageLabel' => Yii::t('app', 'last'),
                'prevPageLabel' => Yii::t('app', 'previous'),
                'nextPageLabel' => Yii::t('app', 'next'),
                'options' => [
                    'class' => 'pagination',
                ]
            ];
        }
    }

    /**
     * @inheritdoc
     */
    public function renderTableRow($model, $key, $index)
    {
        if ($this->filterRow !== null && call_user_func($this->filterRow, $model, $key, $index, $this) === false) {
            return '';
        }
        return parent::renderTableRow($model, $key, $index);
    }

    /**
     * @inheritdoc
     */
    public function renderPager()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }
        /* @var $class LinkPager */
        $pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', LinkPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();
        $pager = array_merge($pager, $this->pagerOptions);
        return $class::widget($pager);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->getClientOptions());
        $view = $this->getView();
        GridViewAsset::register($view);
        $view->registerJs("jQuery('#$id').yiiGridView($options);");
        BaseListView::run();
    }

    public function renderItems()
    {
        $caption = $this->renderCaption();
        $columnGroup = $this->renderColumnGroup();
        $tableHeader = $this->showHeader ? $this->renderTableHeader() : false;
        $tableBody = $this->renderTableBody();

        $tableFooter = false;
        $tableFooterAfterBody = false;

        if ($this->showFooter) {
            if ($this->placeFooterAfterBody) {
                $tableFooterAfterBody = $this->renderTableFooter();
            } else {
                $tableFooter = $this->renderTableFooter();
            }
        }

        $content = array_filter([
            $caption,
            $columnGroup,
            $tableHeader,
            $tableFooter,
            $tableBody,
            $tableFooterAfterBody,
        ]);

        return "<div class='table-responsive'>".Html::tag('table', implode("\n", $content), $this->tableOptions)."</div>";
    }
}