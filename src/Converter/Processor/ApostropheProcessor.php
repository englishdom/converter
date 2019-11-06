<?php

namespace Converter\Processor;

use Converter\Processor\Entity\EntityTextProcessorInterface;

class ApostropheProcessor implements ProcessorInterface
{
    /**
     * @param $entity EntityTextProcessorInterface
     */
    public function process($entity)
    {
        $entity->setText(str_replace(['‘','‛','’','`'], '\'', $entity->getText()));
    }
}