<?php

chdir(dirname(__DIR__));

ini_set("memory_limit", "-1");
set_time_limit(0);

require 'vendor/autoload.php';

$originalText = '«a‘d—c&nbsp;»…';
$reader = new \Converter\Reader\TextReader();
$reader->setText([$originalText]);
$writer = new \Converter\Writer\TextWriter();

$manager = new \Converter\Manager(
    [['reader' => $reader, 'transformer' => new \Example\Transformer\TextReader()]],
    [
        new \Converter\Processor\DotsProcessor(),
        new \Converter\Processor\ApostropheProcessor(),
        new \Converter\Processor\DashProcessor(),
        new \Converter\Processor\HtmlDecodeProcessor(),
        new \Converter\Processor\HtmlStripProcessor(),
        new \Converter\Processor\QuotesProcessor(),
    ],
    [['writer' => $writer, 'transformer' => new \Example\Transformer\TextWriter()]]
);
$result = $manager->manage();
echo 'Original text: ' . $originalText;
echo '</br>';
echo 'Modified text: ' . $result[0][0];

