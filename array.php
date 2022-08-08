<?php

$array = [
    '_token' => 'asdasdas',
    'id' => ['123'],
    'tipe' => ['ti[]pe1', 'tipe[]2'],
    'kategori' => ['kategori1', 'kategori2'],
];
[
    [
        'tipe' => 'tipe1',
        'kategori' => 'kategori1',
    ],
    [
        'tipe' => 'tipe2',
        'kategori' => 'kategori2',
    ]
];

$keys = [];
foreach (array_keys($array) as $key) {
    if (substr($key, 0, 1) !== '_') {
        $keys[] = $key;
    }
}

$rowCount = count($array[$keys[0]]);
$result = [];
for ($i = 0; $i < $rowCount; $i++) {
    $temp = [];
    foreach ($keys as $key) {
        $temp[$key] = str_replace('[]', '', $array[$key][$i]);
    }

    $result[] = $temp;
}
error_log(json_encode($result));