<?php
namespace common\services;

interface KhoanPhiServiceInterface extends ServiceInterface
{
    const ServiceName = 'khoanPhiService';
    public function getOptionsKhoanPhi($options = []);
    public function getGiaKhoanPhi($options = []);

}