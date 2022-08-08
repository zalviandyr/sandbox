<?php

require './data.php';

function calcEntropy($total, $nilai1, $nilai2)
{
    $atribut1 = (-($nilai1 / $total) * (log($nilai1 / $total, 2)));
    $atribut2 = (-($nilai2 / $total) * (log($nilai2 / $total, 2)));

    $atribut1 = is_nan($atribut1) ? 0 : $atribut1;
    $atribut2 = is_nan($atribut2) ? 0 : $atribut2;
    return $atribut1 + $atribut2;
}

// base entropy
$total = 13;
$nilai1 = 6;
$nilai2 = 7;

// mencari base entropy
$baseEntropy = calcEntropy($total, $nilai1, $nilai2);
$baseData = $data;
$result = [];

function calcGain(array $baseData, array $data, $baseEntropy, $mp7) {
    $kategoryHelper = [
        ['name' => 'Alat Transportasi', 'key' => 'p1'],
        ['name' => 'Pendidikan Ayah', 'key' => 'p2'],
        ['name' => 'Pekerjaan Ayah', 'key' => 'p3'],
        ['name' => 'Pendidikan Ibu', 'key' => 'p4'],
        ['name' => 'Pekerjaan Ibu', 'key' => 'p5'],
        ['name' => 'Penghasilan Orang Tua', 'key' => 'p6'],
    ];

    foreach ($kategoryHelper as $index => $helper) {
        // hitung jumlah transposi base on jumlah
        $countJumlah = array_count_values(array_column($data, $helper['key']));

        $result[] = [
            'label' => $helper['name'],
            'key' => $helper['key'],
            'gain' => 0,
            'kategori' => [],
        ];

        foreach ($countJumlah as $key => $value) {
            $temp = [];
            foreach ($data as $item) {
                if ($item[$helper['key']] === $key) {
                    $temp[] = $item;
                }
            }

            $count = array_count_values(array_column($temp, 'p7'));
            $countDisiplin = $count[$mp7[0]] ?? 0;
            $countTidakDisiplin = $count[$mp7[1]] ?? 0;
            $total = count($temp);

            $entropy = calcEntropy($total, $countDisiplin, $countTidakDisiplin);
            $result[$index]['kategori'][] = [
                'name' => $key,
                'total' => $total,
                'disiplin' => $countDisiplin,
                'tidak_disiplin' => $countTidakDisiplin,
                'entropy' => $entropy,
                'child' => [],
            ];
        }
    }

    // total gain
    foreach ($result as &$item) {
        $totalEntropy = 0;
        foreach ($item['kategori'] as $index => $kategori) {
            $totalEntropy += ($kategori['total'] / count($data)) * $kategori['entropy'];
        }
        $item['gain'] = $baseEntropy - $totalEntropy;
    }
    unset($item);

    // find max gain
    usort($result, function ($a, $b) {
        return $b['gain'] <=> $a['gain'];
    });

    // nilai entropy lebih dari 0
    $filterEntropy = [];
    foreach ($result[0]['kategori'] as $kategori) {
        if ($kategori['entropy'] > 0) {
            $filterEntropy[] = $kategori;
        }
    }

    $filter = [];
    foreach ($filterEntropy as &$kategori) {
        foreach ($baseData as $item) {
            if ($item[$result[0]['key']] == $kategori['name']) {
                $filter[] = $item;
            }
        }

        $kategori['child'] = $filter;

        // echo json_encode($kategori);
        echo json_encode($kategori['name']). "\n\n";
    }
    calcGain($baseData, $filter, $baseEntropy, $mp7);
}

calcGain($baseData, $baseData, $baseEntropy, $mp7);
