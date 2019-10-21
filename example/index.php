<?php

chdir(dirname(__DIR__));

ini_set("memory_limit", "-1");
set_time_limit(0);

require 'vendor/autoload.php';

$reader = new \Converter\Reader\PdoReader(
    'mysql:host=localhost;port=3306;dbname=master;charset=utf8',
    'root',
    'root',
    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
    'audio'
);

$writer = new \Converter\Writer\PdoWriter(
    'mysql:host=localhost;port=3306;dbname=master;charset=utf8',
    'root',
    'root',
    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
    'images'
);

//$manager = new \Converter\Manager(
//    [['reader' => $reader, 'transformer' => \Example\Transformer\Reader::class]],
//    [new \Converter\Processor\FileExistProcessor()],
//    [['writer' => $writer, 'transformer' => \Example\Transformer\Writer::class]]
//);
$manager = new \Converter\Manager(
    [['reader' => $reader, 'transformer' => \Example\Transformer\CollectionReader::class]],
    [new \Converter\Processor\FileExistProcessor()],
    [['writer' => $writer, 'transformer' => \Example\Transformer\CollectionWriter::class]]
);
$manager->manage();

