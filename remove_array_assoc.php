<?php
function test()
{
    return 'asd';
}

$array = [
    ['id' => 1, 'name' => 'asdad'],
    ['id' => 2, 'name' => 'lkjl'],
    ['id' => 3, 'name' => 'zxczxc'],
    ['id' => 4, 'name' => 'zxczxc'],
];

$array2 = [
    ['id' => 4, 'name' => 'zxczxc']
];

foreach ($array as $index => $item) {
    foreach ($array2 as $item2) {
        if ($item['id'] === $item2['id']) {
            // array_splice($array, $index, 1);
            unset($array[$index]);
        }
    }
}

error_log(json_encode($array));