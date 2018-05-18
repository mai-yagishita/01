<?php

require_once("phpQuery-onefile.php");

$HTMLData = file_get_contents('https://no1s.biz/');

$phpQueryObj = phpQuery::newDocument(mb_convert_encoding($HTMLData, 'HTML-ENTITIES', 'UTF-8'));
$titles = pq($phpQueryObj)->find('a');

foreach( $titles as $title ) {
	echo  pq($title)->attr('href') ."|" . pq($title)->text()  . "\n";
}
