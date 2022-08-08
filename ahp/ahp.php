<?php

function getMatrixPerbanding(int $matrix, array $initValue)
{
    $tableRi = [
        1 => 0,
        2 => 0,
        3 => 0.58,
        4 => 0.9,
    ];

    $result = [];
    $totalResult = [];
    $normalisasi = [];
    $totalNormalisasi = [];
    $prioritas = [];
    $eigen = [];

    // matrix perbandingan
    for ($i = 1; $i <= $matrix; $i++) {
        for ($j = 1; $j <= $matrix; $j++) {
            if ($i === $j) {
                $result[$i][$j] = 1;
            } else {
                $value = $initValue[$i][$j] ?? 0;
                $result[$i][$j] = $value;
            }
        }
    }

    for ($i = 1; $i <= $matrix; $i++) {
        for ($j = 1; $j <= $matrix; $j++) {
            if ($result[$i][$j] === 0) {
                $result[$i][$j] = 1 / $result[$j][$i];
            }
        }
    }

    // mencari total matrix dan normalisasi matrix
    for ($i = 1; $i <= $matrix; $i++) {
        for ($j = 1; $j <= $matrix; $j++) {
            $tot = array_reduce($result, function (&$res, $item) use ($j) {
                return $res + $item[$j];
            }, 0);

            $totalResult[] = $tot;
            $normalisasi[$i][$j] = $result[$i][$j] / $tot;
        }
    }

    // total normalisasi dan prioritas
    for ($j = 1; $j <= $matrix; $j++) {
        $tot = array_sum($normalisasi[$j]);

        $totalNormalisasi[] = $tot;
        $prioritas[] = $tot / $matrix;
        $eigen[] = ($tot / $matrix) * $totalResult[$j - 1];
    }

    $lambdaMax = array_sum($eigen);
    $ci = ($lambdaMax - $matrix) / ($matrix - 1);
    $cr = $tableRi[$matrix] === 0 ? 0 : $ci / $tableRi[$matrix];

    return [
        'matrix' => $result,
        'total_matrix' => array_unique($totalResult),
        'normalisasi' => $normalisasi,
        'total_normalisasi' => $totalNormalisasi,
        'prioritas' => $prioritas,
        'total_prioritas' => array_sum($prioritas),
        'eigen' => $eigen,
        'lambda_max' => $lambdaMax,
        'ci' => $ci,
        'cr' => $cr,
        'konsistensi' => $cr <= 0.1 ? 'KONSISTEN' : 'TIDAK KONSISTEN',
    ];
}

// PS = PSM
// $PS[1][2] = 3;
// $PS[1][3] = 3;
// $PS[3][2] = 2;

// $PS = getMatrixPerbanding(3, $PS);

// // RT
// $RT[1][2] = 2;
// $RT[1][3] = 2;
// $RT[1][4] = 2;
// $RT[2][3] = 2;
// $RT[2][4] = 2;
// $RT[3][4] = 2;

// $RT = getMatrixPerbanding(4, $RT);

// // RT1
// $RT1[2][1] = 2;
// $RT1[3][1] = 2;
// $RT1[4][1] = 3;
// $RT1[3][2] = 2;
// $RT1[4][2] = 2;
// $RT1[4][3] = 2;

// $RT1 = getMatrixPerbanding(4, $RT1);

// KL1
// $KL1[1][2] = 3;

// $KL1 = getMatrixPerbanding(2, $KL1);
// echo json_encode($KL1);
