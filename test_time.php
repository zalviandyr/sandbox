<?php

$timePre = microtime(true);

while(true) {
    $timePost = microtime(true);
    $timeRemaining = floor($timePost - $timePre);

    sleep(6);
    error_log($timeRemaining);
    if($timeRemaining == 5 || $timeRemaining > 5) {
        break;
    }
}
error_log('keluar');