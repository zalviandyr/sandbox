<?php

require_once './data.php';
require_once './test_data.php';

$labels = ['alat_transportasi', 'pendidikan_ayah', 'pekerjaan_ayah', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_ortu'];

// menghitung kelas keterangan
$calcKeterangan = [
    'disiplin' => [],
    'tidak_disiplin' => [],
];

$keterangan = array_column($data, 'keterangan');
$calcKeterangan['disiplin'] = count(array_filter($keterangan, function ($elm) use ($mp7) {
    return $elm === $mp7[0];
}));
$calcKeterangan['tidak_disiplin'] = count(array_filter($keterangan, function ($elm) use ($mp7) {
    return $elm === $mp7[1];
}));
$calcKeterangan['nilai_disiplin'] = $calcKeterangan['disiplin'] / count($keterangan);
$calcKeterangan['nilai_tidak_disiplin'] = $calcKeterangan['tidak_disiplin'] / count($keterangan);

// populate data
$result = [];
foreach ($labels as $label) {
    $temp = [
        'label' => $label,
        'sub_label' => [],
        'total_disiplin' => 0,
        'total_tidak_disiplin' => 0,
    ];

    // mengambil sub label unique pada data
    $uniqueSubLabel = [];
    foreach ($data as $value) {
        $uniqueSubLabel[] = $value[$label];
    }
    $uniqueSubLabel = array_unique($uniqueSubLabel);

    foreach ($uniqueSubLabel as $subLabel) {
        $disiplin = 0;
        $tidakDisiplin = 0;

        // mencari nilai disiplin dan tidak disiplin per sub label
        foreach ($data as $value2) {
            if ($subLabel === $value2[$label] && $value2['keterangan'] === $mp7[0]) {
                $disiplin += 1;
            }
            if ($subLabel === $value2[$label] && $value2['keterangan'] === $mp7[1]) {
                $tidakDisiplin += 1;
            }
        }

        $subLabel = [
            'name' => $subLabel,
            'disiplin' => $disiplin,
            'tidak_disiplin' => $tidakDisiplin,
            'p_disiplin' => 0,
            'p_tidak_disiplin' => 0,
        ];

        $temp['sub_label'][] = $subLabel;
    }

    $temp['total_disiplin'] = array_sum(array_column($temp['sub_label'], 'disiplin'));
    $temp['total_tidak_disiplin'] = array_sum(array_column($temp['sub_label'], 'tidak_disiplin'));

    $result[] = $temp;
}

// menghitung nilai peluang
foreach ($result as &$item) {
    foreach($item['sub_label'] as &$subLabel) {
        $subLabel['p_disiplin'] = $subLabel['disiplin'] / $item['total_disiplin'];
        $subLabel['p_tidak_disiplin'] = $subLabel['tidak_disiplin'] / $item['total_tidak_disiplin'];
    }
    // clear pointer
    unset($subLabel);
}
// clear pointer
unset($item);

$testData = array_map(function ($elm) use($labels) {
    $data = [];

    foreach ($labels as $label) {
        $data[] = [
            'label' => $label,
            'sub_label' => $elm[$label],
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ];
    }

    return [
        'nama' => $elm['nama'],
        'actual' => $elm['keterangan'],
        'predict' => '',
        'total_disiplin' => 0,
        'total_tidak_disiplin' => 0,
        'data' => $data,
    ];
}, $data2);

$confusionMatrix = [
    // predict x actual
    'disiplin_x_disiplin' => 0,
    'disiplin_x_tidak_disiplin' => 0,
    'tidak_disiplin_x_tidak_disiplin' => 0,
    'tidak_disiplin_x_disiplin' => 0,
    'recall' => 0,
    'precision' => 0,
    'akurasi' => 0,
];

foreach ($testData as &$item) {
    // bandingkan berdasarkan label
    foreach ($result as $resultItem) {
        foreach ($item['data'] as &$dataItem) {
            if ($resultItem['label'] === $dataItem['label']) {
                // bandingkan berdasarkan sub label
                foreach ($resultItem['sub_label'] as $subLabel) {
                    if ($subLabel['name'] === $dataItem['sub_label']) {
                        $dataItem['disiplin'] = $subLabel['p_disiplin'];
                        $dataItem['tidak_disiplin'] = $subLabel['p_tidak_disiplin'];
                        break;
                    }
                }
                break;
            }
        }
    }

    $disiplinArr = array_column($item['data'], 'disiplin');
    $totalDisiplin = array_reduce($disiplinArr, function ($a, $b) {
        return $a * $b;
    }, 1);
    $tidakDisiplinArr = array_column($item['data'], 'tidak_disiplin');
    $totalTidakDisiplin = array_reduce($tidakDisiplinArr, function ($a, $b) {
        return $a * $b;
    }, 1);
    $item['total_disiplin'] = $totalDisiplin * $calcKeterangan['nilai_disiplin'];
    $item['total_tidak_disiplin'] = $totalTidakDisiplin * $calcKeterangan['nilai_tidak_disiplin'];

    // prediksi
    $item['predict'] = $item['total_disiplin'] > $item['total_tidak_disiplin'] ? 'Disiplin' : 'Tidak Disiplin';

    // insert
    if ($item['predict'] === 'Disiplin' && $item['actual'] === 'Disiplin') {
        $confusionMatrix['disiplin_x_disiplin'] += 1;
    } else if ($item['predict'] === 'Disiplin' && $item['actual'] === 'Tidak Disiplin') {
        $confusionMatrix['disiplin_x_tidak_disiplin'] += 1;
    } else if ($item['predict'] === 'Tidak Disiplin' && $item['actual'] === 'Tidak Disiplin') {
        $confusionMatrix['tidak_disiplin_x_tidak_disiplin'] += 1;
    } else if ($item['predict'] === 'Tidak Disiplin' && $item['actual'] === 'Disiplin') {
        $confusionMatrix['tidak_disiplin_x_disiplin'] += 1;
    }
}

// akurasi
$akurasi = ($confusionMatrix['disiplin_x_disiplin'] + $confusionMatrix['tidak_disiplin_x_tidak_disiplin']) / array_sum(array_values($confusionMatrix));
$confusionMatrix['akurasi'] = $akurasi;

// recall
$recall = $confusionMatrix['disiplin_x_disiplin'] / ($confusionMatrix['disiplin_x_disiplin'] + $confusionMatrix['tidak_disiplin_x_disiplin']);
$confusionMatrix['recall'] = $recall;

// precision
$precision = $confusionMatrix['disiplin_x_disiplin'] / ($confusionMatrix['disiplin_x_disiplin'] + $confusionMatrix['disiplin_x_tidak_disiplin']);
$confusionMatrix['precision'] = $precision;

// echo json_encode($testData);
echo json_encode($confusionMatrix);
die();
