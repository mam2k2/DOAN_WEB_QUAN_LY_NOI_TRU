<?php
namespace backend\grid;

class NumberColumn extends DataColumn
{
    public $contentOptions = ['class' => 'text-right'];
    public $format = ['decimal'];
}