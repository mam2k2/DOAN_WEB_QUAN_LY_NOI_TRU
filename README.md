Dự án Vody được code bẳng Yii2 framework
=============

Khởi chạy dự án
------------
Chạy lệnh:
```
init
```
Cấu hình database
------------
Trong file `common/config/main-local.php`
```php
'db' => [
            'class' => yii\db\Connection::className(),
            'dsn' => 'mysql:host=localhost;dbname=appvody',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => "",
        ],
```
Các cronjob cần chạy
------------
1. Xử lý đơn hàng chưa nhận
```
yii order/received-orders
```

2. Xử lý đơn hàng đang bán lại
```
yii order/resell-orders
```

3. Xử lý vé đang chờ
```
yii user-shop/handle-active-shop
```

Các command để xử lý một vài chức năng
------------

* Xoá tất cả các menu
```
yii menu/reset-menu-backend
```

* Tạo menu mặc định cho backend
```
yii menu/set-default-backend-menu
```

* Nạp tiền
```
yii transaction/recharge
```

* Xác nhận nạp tiền
```
yii transaction/confirm-recharge
```

* Mua vé
```
yii transaction/buy-ticket
```

* Sử dụng vé
```
yii transaction/use-ticket
```

* Mua sản phẩm
```
yii transaction/buy-product
```

* Bán sản phẩm
```
yii transaction/sell-product
```

* Lấy sản phẩm
```
yii transaction/take-product
```

* Xoá tất cả dữ liệu mua bán của các tài khoản test
```
yii data/delete-test-user-data  
```

* Tạo dữ liệu giả lập mua bán sản phẩm
```
yii transaction/buy-products-in-rounds
```