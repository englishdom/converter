<?php

namespace Converter\Processor;

use Converter\Processor\Entity\EntityTextProcessorInterface;

class HtmlStripProcessor implements ProcessorInterface
{
    /**
     * @param $entity EntityTextProcessorInterface
     */
    public function process($entity)
    {
        $entity->setText(strip_tags($entity->getText()));
    }
}