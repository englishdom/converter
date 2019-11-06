<?php

namespace Converter\Processor;

use Converter\Processor\Entity\EntityTextProcessorInterface;

class DotsProcessor implements ProcessorInterface
{
    /**
     * @param $entity EntityTextProcessorInterface
     * @return mixed
     */
    public function process($entity)
    {
        $entity->setText(str_replace('…', '...', $entity->getText()));
    }
}