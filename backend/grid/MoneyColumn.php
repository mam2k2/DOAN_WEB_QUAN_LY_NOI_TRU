<?php
namespace backend\grid;

class MoneyColumn extends DataColumn{
    public $contentOptions = ['class' => 'text-right'];
    public $format = ['currency'];
}