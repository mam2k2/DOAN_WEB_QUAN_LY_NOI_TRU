<?php
namespace common\services;

use common\models\Branch;

interface BranchServiceInterface extends ServiceInterface
{
    const ServiceName = 'branchService';
    /**
     * @param array $options
     * @return Branch[]
     */
    public function getOptions(array $options = []);
}