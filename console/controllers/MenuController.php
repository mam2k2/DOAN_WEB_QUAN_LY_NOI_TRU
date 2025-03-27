<?php

namespace console\controllers;

use common\libs\Constants;
use common\models\Menu;
use yii\console\Controller;

class MenuController extends Controller
{
    public function actionSetDefaultBackendMenu()
    {
        $items = [
            [
                "label" => 'Setting',
                "url" => '',
                "child" => [
                    [
                        "label" => 'Website Setting',
                        "url" => '/setting/website',
                    ],
                    [
                        "label" => 'SMTP Setting',
                        "url" => 'setting/smtp',
                    ],
                    [
                        "label" => 'Custom Setting',
                        "url" => 'setting/custom',
                    ],
                ]
            ],
            [
                "label" => 'Menu',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Frontend Menu',
                        "url" => 'frontend-menu/index',
                    ],
                    [
                        "label" => 'Backend Menu',
                        "url" => 'menu/index',
                    ],
                ]
            ],
            [
                "label" => 'Gym Manager',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Branch',
                        "url" => 'branch/index',
                    ],
                    [
                        "label" => 'Product',
                        "url" => 'product/index',
                    ],
                    [
                        "label" => 'Category',
                        "url" => 'category/index',
                    ],
                ]
            ],
            [
                "label" => 'Order',
                "url" => 'order/index',
            ],
            [
                "label" => 'RBAC',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Permissions',
                        "url" => 'rbac/permissions',
                    ],
                    [
                        "label" => 'Roles',
                        "url" => 'rbac/roles',
                    ],
                    [
                        "label" => 'Admin Users',
                        "url" => 'admin-user/index',
                    ],
                ]
            ],
            [
                "label" => 'Cache',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Clear Frontend',
                        "url" => 'clear/frontend',
                    ],
                    [
                        "label" => 'Clear Backend',
                        "url" => 'clear/backend',
                    ],
                ]
            ],
            [
                "label" => 'Log',
                "url" => 'log/index',
            ],
        ];

        foreach ($items as $key => $item) {
            self::handleMenu($item['label'], $item['url'], $key, $item['child'] ?? [], 0);
        }
    }

    public static function handleMenu($label, $url, $position = 0, $child = [], $parentId = 0)
    {
        if (!empty($label)) {
            $menu = Menu::find()->where(['type' => Menu::TYPE_BACKEND])->andWhere(['LOWER(name)' => mb_strtolower($label)])->one();
            if (is_null($menu)) {
                $menu = new Menu(['type' => Menu::TYPE_BACKEND]);
            }
            $menu->name = $label;
            $menu->url = $url;
            $menu->parent_id = $parentId;
            $menu->sort = $position;
            $menu->target = "_self";
            if ($menu->save()) {
                if (count($child) > 0) {
                    foreach ($child as $key => $item) {
                        self::handleMenu($item['label'], $item['url'], $key, $item['child'] ?? [], $menu->id);
                    }
                }
            }
        }
    }

    public function actionResetMenuBackend()
    {
        Menu::deleteAll(['type' => Menu::TYPE_BACKEND]);
    }
}