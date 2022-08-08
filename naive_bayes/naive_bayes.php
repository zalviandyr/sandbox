<?php

require_once './data.php';

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

// test data
$testData = [
    'test' => [
        [
            'label' => 'alat_transportasi',
            'sub_label' => 'Jalan Kaki',
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ],
        [
            'label' => 'pendidikan_ayah',
            'sub_label' => 'SD / sederajat',
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ],
        [
            'label' => 'pekerjaan_ayah',
            'sub_label' => 'Petani',
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ],
        [
            'label' => 'pendidikan_ibu',
            'sub_label' => 'SD / sederajat',
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ],
        [
            'label' => 'pekerjaan_ibu',
            'sub_label' => 'Petani',
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ],
        [
            'label' => 'penghasilan_ortu',
            'sub_label' => 'Rp. 500,000 - Rp. 999,999',
            'disiplin' => 0,
            'tidak_disiplin' => 0,
        ],
    ],
    'total_disiplin' => 0,
    'total_tidak_disiplin' => 0,
];

foreach ($testData['test'] as &$item) {
    // bandingkan berdasarkan label
    foreach ($result as $resultItem) {
        if ($resultItem['label'] === $item['label']) {
            // bandingkan berdasarkan sub label
            foreach ($resultItem['sub_label'] as $subLabel) {
                if ($subLabel['name'] === $item['sub_label']) {
                    $item['disiplin'] = $subLabel['p_disiplin'];
                    $item['tidak_disiplin'] = $subLabel['p_tidak_disiplin'];
                    break;
                }
            }
            break;
        }
    }
}
unset($item);

$disiplinArr = array_column($testData['test'], 'disiplin');
$totalDisiplin = array_reduce($disiplinArr, function ($a, $b) {
    return $a * $b;
}, 1);
$tidakDisiplinArr = array_column($testData['test'], 'tidak_disiplin');
$totalTidakDisiplin = array_reduce($tidakDisiplinArr, function ($a, $b) {
    return $a * $b;
}, 1);
$testData['total_disiplin'] = $totalDisiplin;
$testData['total_tidak_disiplin'] = $totalTidakDisiplin;
$testData['nilai_total_disiplin'] = $totalDisiplin * $calcKeterangan['nilai_disiplin'];
$testData['nilai_total_tidak_disiplin'] = $totalTidakDisiplin * $calcKeterangan['nilai_tidak_disiplin'];

// echo json_encode($result);
echo json_encode($testData);
// echo json_encode($disiplinArr);
die();
