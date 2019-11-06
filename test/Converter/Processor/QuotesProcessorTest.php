<?php

namespace Unit\Convertor\Filter;

use Converter\Processor\QuotesProcessor;
use PHPUnit\Framework\TestCase;
use Unit\Converter\Entity\TextEntity;

class QuotesProcessorTest extends TestCase
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

        $filter = new QuotesProcessor();
        $filter->process($entity);

        $this->assertEquals($expected, $entity->getText());
    }

    public function inputProvider()
    {
        return [
            [
                '«text»',
                '"text"'
            ],
            [
                '‹text›',
                '"text"'
            ],
            [
                '„text“',
                '"text"'
            ],
            [
                '‟text”',
                '"text"'
            ],
        ];
    }
}