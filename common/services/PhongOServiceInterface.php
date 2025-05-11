<?php
namespace common\services;

interface PhongOServiceInterface extends ServiceInterface
{
    const ServiceName = 'phongOService';
    public function getAllNamePhong(array $options=[]);

}