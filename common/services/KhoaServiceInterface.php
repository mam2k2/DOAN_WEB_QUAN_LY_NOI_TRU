<?php
namespace common\services;

interface KhoaServiceInterface extends ServiceInterface
{
    const ServiceName = 'khoaService';
    public function getOptionsKhoa($options = []);
}