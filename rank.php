<?php

$data = [
    ['A', 1],
    ['B', 2],
    ['C', 3],
    ['A', 1],
];

$data = [
    ['name' => 'A', 'rank' => 1],
    ['name' => 'B', 'rank' => 2],
    ['name' => 'C', 'rank' => 3],
    ['name' => 'A', 'rank' => 1],
];

echo json_encode($data) . "\n\n";

$uniqueRank = array_unique(array_column($data, 'rank'));
$uniqueName = array_unique(array_column($data, 'name'));

$result = array_map(function ($elm) use ($uniqueRank) {
    $rank = [];
    foreach ($uniqueRank as $value) {
        $rank[$value] = 0;
    }

    return ['name' => $elm, 'list_rank' => $rank];
}, $uniqueName);

echo json_encode($result) . "\n\n";

foreach ($result as &$valueUnique) {
    foreach ($data as $item) {
        foreach ($valueUnique['list_rank'] as $rank => $value) {
            if ($item['name'] === $valueUnique['name'] && $item['rank'] === $rank) {
                $valueUnique['list_rank'][$rank] += 1;
            }
        }
    }
}

echo json_encode($result);

$uniqueRank = $uniqueRank;
$uniqueRank2 = $uniqueRank;
echo json_encode($uniqueRank);
rsort($uniqueRank2);
echo json_encode($uniqueRank);