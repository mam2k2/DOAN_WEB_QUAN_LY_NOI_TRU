<?php
namespace common\services;

interface ThongTinHocSinhServiceInterface extends ServiceInterface
{
    const ServiceName = 'thongTinHocSinhService';
    public function getAllNameHocSinh(array $options=[]);

}