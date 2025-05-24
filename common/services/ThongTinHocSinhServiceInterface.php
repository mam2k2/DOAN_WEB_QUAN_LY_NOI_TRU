<?php
namespace common\services;

interface ThongTinHocSinhServiceInterface extends ServiceInterface
{
    const ServiceName = 'thongTinHocSinhService';
    public function getAllNameHocSinh(array $options=[]);
    public function createPending(array $postData, array $options = []);
    public function getListChoDuyet(array $query = [], array $options=[]);
}