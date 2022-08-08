<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;

$filename = __DIR__ . '/data2.csv';

$c45 = new C45([
                'targetAttribute' => 'keterangan',
                'trainingFile' => $filename,
                'splitCriterion' => C45::SPLIT_GAIN,
            ]);

$tree = $c45->buildTree();
$treeString = $tree->toString();

// print generated tree
echo '<pre>';
print_r($treeString);
echo '</pre>';

// $testingData = [
//   'outlook' => 'rain',
//   'windy' => 'false',
//   'humidity' => 'medium',
//   'gas' => 'menengah',
// ];

// echo $tree->classify($testingData); // prints 'no'

// sepeda_motor, sma, wiraswasta, sma, pns, sedang, disiplin
$testingData = [
  'alat_transportasi' => 'sepeda_motor',
  'pendidikan_ayah' => 'sma',
  'pekerjaan_ayah' => 'wiraswasta',
  'pendidikan_ibu' => 'sma',
  'pekerjaan_ibu' => 'pns',
  'penghasilan_ortu' => 'sedang',
];

echo $tree->classify($testingData); // prints 'disiplin'