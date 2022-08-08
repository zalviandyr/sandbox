<?php


$array = [
    // '_token' => 'asdasdas',
    'tipe' => ['ti[]pe1', 'tipe[]2'],
    'kategori' => ['kategori1', 'kategori2'],
];

$keys = array_keys($array);
$result = [];
foreach ($keys as $key) {
    $arrayValue = array_map(function($val) {
        return str_replace('[]', '', $val);
    }, $array[$key]);

    $result[$key] = $arrayValue;
}
error_log(json_encode($result));