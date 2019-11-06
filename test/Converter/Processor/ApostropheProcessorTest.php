<?php

namespace Unit\Converter\Processor;

use Converter\Processor\ApostropheProcessor;
use PHPUnit\Framework\TestCase;
use Unit\Converter\Entity\TextEntity;

class ApostropheProcessorTest extends TestCase
{
    /**
     * @dataProvider inputProvider
     * @param $original
     * @param $expected
     */
    public function testFilter($original, $expected)
    {
        $entity = new TextEntity();
        $entity->setText($original);

        $filter = new ApostropheProcessor();
        $filter->process($entity);

        $this->assertEquals($expected, $entity->getText());
    }

    public function inputProvider()
    {
        return [
            [
                'it‘s',
                'it\'s'
            ],
            [
                'work‛s',
                'work\'s'
            ],
            [
                'I’m',
                'I\'m'
            ],
            [
                'I`m',
                'I\'m'
            ],
        ];
    }
}