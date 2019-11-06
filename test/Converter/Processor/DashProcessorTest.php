<?php

namespace Unit\Converter\Processor;

use Converter\Processor\DashProcessor;
use PHPUnit\Framework\TestCase;
use Unit\Converter\Entity\TextEntity;

class DashProcessorTest extends TestCase
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

        $filter = new DashProcessor();
        $filter->process($entity);

        $this->assertEquals($expected, $entity->getText());
    }

    public function inputProvider()
    {
        return [
            [
                'super–test', /* &ndash; */
                'super-test'
            ],
            [
                'super—man',
                'super-man'
            ],
            [
                'super‒work',
                'super-work'
            ],
            [
                'spider―man',
                'spider-man'
            ],
        ];
    }
}