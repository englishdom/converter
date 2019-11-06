<?php

namespace Converter\Processor;

use Converter\Processor\Entity\EntityTextProcessorInterface;

class HtmlDecodeProcessor implements ProcessorInterface
{
    /**
     * @param $entity EntityTextProcessorInterface
     */
    public function process($entity)
    {
        $entity->setText(html_entity_decode(str_replace(['&nbsp;',' '], ' ', $entity->getText())));
    }
}