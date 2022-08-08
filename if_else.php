<?php

$id_price = 1;

$totalBayar = 0;

if ($id_price === 1) {
    $totalBayar = 350000;
} else if ($id_price === 2) {
    $totalBayar = 50000;
}

Bill::create([
    'total_bayar' => $totalBayar,
]);