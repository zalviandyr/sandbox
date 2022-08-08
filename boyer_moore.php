<?php
function maxInteger($a,  $b)
{
    return ($a > $b) ? $a : $b;
}

function badCharHeuristic($str, $size)
{
    $noOfChars = 256;

    // fill array
    $badChar = array_fill(0, $noOfChars, -1);

    for ($i = 0; $i < $size; $i++) {
        // ord = convert string to ascii
        $badChar[ord($str[$i])] = $i;
    }

    return $badChar;
}

function searchDataSiswa($data, $keyword)
{
    $dataArray = str_split($data);
    $keywordArray = str_split($keyword);
    $m = count($keywordArray);
    $n = count($dataArray);
    $badChar = badCharHeuristic($keywordArray, $m);

    $shift = 0;
    while ($shift <= ($n - $m)) {
        $j = $m - 1;

        while ($j >= 0 && $keywordArray[$j] == $dataArray[$shift + $j]) {
            $j--;
        }

        if ($j < 0) {
            error_log('pattern ' . $shift);

            $shift += ($shift + $m < $n) ? $m - $badChar[ord($dataArray[$shift + $m])] : 1;
        } else {
            $shift += maxInteger(1, $j - $badChar[ord($dataArray[$shift + $j])]);
        }
    }
}

$str = "ABAAABCD";
$keyword = "AB";

searchDataSiswa($str, $keyword);

error_log(json_encode(explode(' ', 'asdasd')));
