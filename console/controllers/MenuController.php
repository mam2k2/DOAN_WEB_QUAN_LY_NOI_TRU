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
                        "label" => 'Backend Menu',
                        "url" => 'menu/index',
                    ],
                ]
            ],
            [
                "label" => 'Quản lý KTX',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Quản lý khu',
                        "url" => 'khu-ktx/index',
                    ],
                    [
                        "label" => 'Quản lý phòng ở',
                        "url" => 'phong-o/index',
                    ],
                    [
                        "label" => 'Quản lý thiết bị',
                        "url" => 'thiet-bi-ktx/index',
                    ],

                ]
            ],
            [
                "label" => 'Thu phí nội trú',
                "url" => 'thu-phi-noi-tru/index',
            ],
            [
                "label" => 'Quản lý học sinh',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Quản lý học sinh',
                        "url" => 'khu-ktx/index',
                    ],
                    [
                        "label" => 'Quản lý vi phạm',
                        "url" => 'phong-o/index',
                    ],
                ]
            ],
            [
                "label" => 'Quản lý thông báo',
                "url" => 'thong-bao-he-thong/index',
            ],
            [
                "label" => 'Phân Quyền',
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