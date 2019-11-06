<?php

namespace Unit\Convertor\Filter;

use Converter\Processor\DotsProcessor;
use Convertor\Filter\Dots;
use PHPUnit\Framework\TestCase;
use Unit\Converter\Entity\TextEntity;

class DotsProcessorTest extends TestCase
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

        $filter = new DotsProcessor();
        $filter->process($entity);

        $this->assertEquals($expected, $entity->getText());
    }

    public function inputProvider()
    {
        return [
            [
                'Some text…',
                'Some text...'
            ],
        ];
    }
}