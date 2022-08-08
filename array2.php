<?php

function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
 }

$array = [
    [
        'simplified' => 'adasd1',
        'traditional' => 'adasd1',
    ],
    [
        'simplified' => 'adasd2',
        'traditional' => 'adasd2',
    ],
];

// $array[]['asdsa'] = 1;
// $array = array_push_assoc($array, 'test', 1);
error_log(json_encode($array));