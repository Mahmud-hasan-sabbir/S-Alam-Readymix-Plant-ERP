<?php
namespace App\Helpers;

class Helper
{

    public static function IDGenerator($model, $trow, $length = 4, $prefix) {
        $data = $model::orderBy('id', 'desc')->first();
        if (!$data) {
            // No records found, starting with 4 zeros
            $last_number = 1;
            $zeros = str_repeat("0", $length - 1); // 4 zeros, then the number 1
        } else {
            $code = substr($data->$trow, strlen($prefix) + 1);
            $actual_last_number = ($code / 1) * 1;
            $increment_last_number = ((int)$actual_last_number) + 1;
            $last_number_length = strlen($increment_last_number);
            $length -= $last_number_length;
            $zeros = str_repeat("0", $length);
            $last_number = $increment_last_number;
        }

        return $prefix . '-' . $zeros . $last_number;
    }

    // public static function IDGenerator($model, $trow, $condition = [], $length , $prefix)
    // {
    //     if (count($condition) > 0) {
    //         $data = $model::where($condition)->orderBy('id', 'desc')->first();
    //     } else {
    //         $data = $model::orderBy('id', 'desc')->first();
    //     }

    //     if (!$data) {
    //         $og_length = $length-1;
    //         $last_number = '1';
    //     } else {
    //         $code = substr($data->$trow, strlen($prefix) + 1);
    //         $actial_last_number = ($code / 1) * 1;
    //         $increment_last_number = ((int)$actial_last_number) + 1;
    //         $last_number_length = strlen($increment_last_number);
    //         $og_length = $length - $last_number_length;
    //         $last_number = $increment_last_number;
    //     }

    //     $zeros = str_repeat('0', $og_length);

    //     return $prefix . '-' . $zeros . $last_number;
    // }



}
