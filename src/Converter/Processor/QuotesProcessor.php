<?php

namespace Converter\Processor;

use Converter\Processor\Entity\EntityTextProcessorInterface;

class QuotesProcessor implements ProcessorInterface
{
    /**
     * @param $entity EntityTextProcessorInterface
     */
    public function process($entity)
    {
        $entity->setText(str_replace(['«','»','‹','›','„','“','‟','”'], '"', $entity->getText()));
    }
}