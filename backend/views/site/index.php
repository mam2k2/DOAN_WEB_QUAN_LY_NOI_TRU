<?php

/* @var $this yii\web\View */
/* @var $content string */
/* @var $identity common\models\AdminUser */
/* @var $menus []common\models\Menu */

use common\helpers\FileDependencyHelper;
use common\models\Menu;
use yii\caching\FileDependency;
use yii\helpers\Html;
use backend\widgets\Menu as MenuWidget;
use yii\helpers\Url;
use backend\assets\IndexAsset;

IndexAsset::register($this);
$this->title = Yii::t('app', 'VODY Manage');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="horizontal-menu-template" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="icon" href="<?= Yii::$app->getRequest()->getHostInfo() ?>/favicon.ico" type="image/x-icon"/>
    <style>
        body {
            overflow: hidden;
        }
    </style>
    <script type="application/javascript">
        var templateName = "horizontal-menu-template";
    </script>
</head>
<body class="fixed-sidebar full-height-layout gray-bg">
<?php $this->beginBody() ?>
<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="container-fluid">
                <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
                    <a href="/admin" class="app-brand-link gap-2">
                        <span class="app-brand-text demo menu-text fw-bold">
                            <img class="logo-name" style="height: 50px"  src="<?=Yii::$app->params['site']['url'].'/admin/static/img/logoNgang.png'?>"/>
                            Trường cao đẳng giao thông vận tải đường thủy I
                        </span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                        <i class="ti ti-x ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="ti ti-menu-2 ti-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item dropdown-shortcuts dropdown me-2 me-xl-0">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li >
                                    <a href="javascript:void(0)" class="dropdown-item" onclick="reloadIframe()"><i class="fa fa-refresh"></i> <?= Yii::t('app', 'Refresh') ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="<?=$identity->getAvatarUrl()?>" alt class="h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li >
                                    <a class="J_menuItem dropdown-item" href="<?= Url::to(['admin-user/self-update']) ?>"><?= Yii::t('app', 'Profile') ?></a>
                                </li>
                                <li ><a class="dropdown-item" data-method="post" href="<?= Url::toRoute('site/logout') ?>"><?= Yii::t('app', 'Logout') ?></a></li>
                            </ul>
                        </li>

                    </ul>
                </div>

                <!-- Search Small Screens -->
                <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
                    <input
                            type="text"
                            class="form-control search-input border-0"
                            placeholder="Search..."
                            aria-label="Search..." />
                    <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                </div>
            </div>
        </nav>
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Menu -->
                <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
                    <div class="container-fluid d-flex h-100">
                        <?php
                        /** @var FileDependencyHelper $cacheDependencyObject */
                        $cacheDependencyObject = Yii::createObject([
                            'class' => FileDependencyHelper::className(),
                            'fileName' => Menu::MENU_CACHE_DEPENDENCY_FILE,
                        ]);
                        $dependency = [
                            'class' => FileDependency::className(),
                            'fileName' => $cacheDependencyObject->createFileIfNotExists(),
                        ];
                        if ($this->beginCache('backend_menu', [
                            'variations' => [
                                Yii::$app->language,
                                Yii::$app->getUser()->getId()
                            ],
                            'dependency' => $dependency
                        ])
                        )
                        {?>
                            <?= MenuWidget::widget([
                            'menus' => $menus,
                        ]) ?>
                            <?php $this->endCache();
                        } ?>
                    </div>
                </aside>
                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">
                    <div class="row content-tabs">
                        <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                        </button>
                        <nav class="page-tabs J_menuTabs">
                            <div class="page-tabs-content">
                                <a href="javascript:;" class="active J_menuTab" data-id="<?= Url::to(['site/main']) ?>"><?= Yii::t('app', 'Home') ?></a>
                            </div>
                        </nav>
                        <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i></button>
                        <a href="javascript:void(0)" class="roll-nav roll-right J_tabReload" onclick="reloadIframe()"><i class="fa fa-refresh"></i></a>
                        <div class="btn-group roll-nav roll-right">
                            <button class="J_tabClose dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false"><?= Yii::t('app', 'Close') ?></button>
                            <ul role="menu" class="dropdown-menu dropdown-menu-right">
                                <li class="J_tabShowActive"><a><?= Yii::t('app', 'Locate Current Tab') ?></a></li>
                                <li class="divider"></li>
                                <li class="J_tabCloseAll"><a><?= Yii::t('app', 'Close All Tab') ?></a></li>
                                <li class="J_tabCloseOther"><a><?= Yii::t('app', 'Close Other Tab') ?></a></li>
                            </ul>
                        </div>
                        <?= Html::a('<i class="fa fa fa-sign-out"></i>', Url::toRoute('site/logout'), ['data-method'=>'post', 'class'=>'roll-nav roll-right J_tabExit'])?>
                    </div>
                    <div class="row J_mainContent" id="content-main">
                        <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?= Url::to(['site/main']) ?>" frameborder="0" data-id="<?= Url::to(['site/main']) ?>" TEST></iframe>
                    </div>
                </div>
                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div
                                class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                            <div>
                                &copy; 2015-<?=date('Y')?> <a href="https://thgroup.io/" target="_blank">THG</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

</div>

    <!--right section sidebar end (not enabled yet)-->
<?php $this->endBody() ?>
</body>
<script>
    function reloadIframe() {
        var current_iframe = $("iframe:visible");
        current_iframe[0].contentWindow.location.reload();
        return false;
    }
    if (window.top !== window.self) {
        window.top.location = window.location;
    }
</script>
</html>
<?php $this->endPage() ?>
