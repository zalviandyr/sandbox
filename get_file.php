<?php

$url = 'http://ppsdm.cloud.javan.co.id/download/file/227688';
$url2 = 'https://static.bmdstatic.com/pk/product/medium/598c2740358f4.jpg';

// $params = array('http' => array('method' => 'GET', 'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36'));
// $ctx = stream_context_create($params);
// ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

file_get_contents($url);
