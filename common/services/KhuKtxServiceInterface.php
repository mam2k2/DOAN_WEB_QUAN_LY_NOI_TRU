<?php
namespace common\services;

interface KhuKtxServiceInterface extends ServiceInterface
{
    const ServiceName = 'khuKtxService';
    public function getAllNameKhu(array $options=[]);
}