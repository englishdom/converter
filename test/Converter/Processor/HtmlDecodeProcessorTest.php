<?php

namespace Unit\Convertor\Filter;

use Converter\Processor\HtmlDecodeProcessor;
use PHPUnit\Framework\TestCase;
use Unit\Converter\Entity\TextEntity;

class HtmlDecodeProcessorTest extends TestCase
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

        $filter = new HtmlDecodeProcessor();
        $filter->process($entity);

        $this->assertEquals($expected, $entity->getText());
    }

    public function inputProvider()
    {
        return [
            [
                'Some&nbsp;&ndash;&nbsp;&quot;text&quot;',
                'Some – "text"'
            ],
        ];
    }
}