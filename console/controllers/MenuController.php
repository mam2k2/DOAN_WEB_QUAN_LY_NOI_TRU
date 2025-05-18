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
                "label" => 'Quản lý thu phí nội trú',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Thu phí',
                        "url" => 'thu-phi-noi-tru/index',
                    ],
                    [
                        "label" => 'Khoản phí',
                        "url" => 'khoan-phi/index',
                    ],
                ]
            ],

            [
                "label" => 'Quản lý học sinh',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Danh sách học sinh',
                        "url" => 'thong-tin-hoc-sinh/index',
                    ],
                    [
                        "label" => 'Quản lý Y tế',
                        "url" => 'y-te/index',
                    ],
                    [
                        "label" => 'Điểm danh',
                        "url" => 'diem-danh/index',
                    ],
                    [
                        "label" => 'Vi phạm',
                        "url" => 'vi-pham-noi-quy/index',
                    ],
                ]
            ],
            [
                "label" => 'Quản lý thông báo',
                "url" => 'thong-bao-he-thong/index',
            ],
            [
                "label" => 'Quản lý danh mục',
                "url" => '',
                'child' => [
                    [
                        "label" => 'Danh Mục',
                        "url" => 'category/index',
                    ],
                    [
                        "label" => 'Quản lý Khoá',
                        "url" => 'khoa/index',
                    ],
                    [
                        "label" => 'Quản lý Lớp',
                        "url" => 'lop/index',
                    ],
                    [
                        "label" => 'Quản lý Giáo Viên',
                        "url" => 'giao-vien/index',
                    ],
                    [
                        "label" => 'Backend Menu',
                        "url" => 'menu/index',
                    ]
                ]
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