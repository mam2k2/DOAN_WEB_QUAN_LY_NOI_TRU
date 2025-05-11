<?php
namespace common\services;

interface LopServiceInterface extends ServiceInterface
{
    const ServiceName = 'lopService';
    public  function  getLopOptions($options= []);
}