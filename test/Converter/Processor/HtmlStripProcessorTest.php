<?php

namespace Unit\Convertor\Filter;

use Converter\Processor\HtmlStripProcessor;
use PHPUnit\Framework\TestCase;
use Unit\Converter\Entity\TextEntity;

class HtmlStripProcessorTest extends TestCase
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

        $filter = new HtmlStripProcessor();
        $filter->process($entity);

        $this->assertEquals($expected, $entity->getText());
    }

    public function inputProvider()
    {
        return [
            [
                '<a href="#">Some <bold>text</bold></a>',
                'Some text'
            ],
        ];
    }
}