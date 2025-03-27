<?php
namespace common\helpers;

class NumberHelper{
    public static function generateRandomNumbers($targetSum, $numNumbers) {
        // Kiểm tra số lượng số và tổng
        if ($numNumbers < 2 || $targetSum < $numNumbers || $targetSum < 1) {
            return [$targetSum];
        }

        $numbers = [];

        // Tạo số ngẫu nhiên cho numNumbers - 1 số đầu tiên
        for ($i = 0; $i < $numNumbers - 1; $i++) {
            $number = mt_rand(1, $targetSum - ($numNumbers - $i - 1));
            $numbers[] = $number;
            $targetSum -= $number;
        }

        // Số cuối cùng là phần còn lại để tổng bằng targetSum
        $numbers[] = $targetSum;

        return $numbers;
    }
}