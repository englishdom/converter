<?php

namespace Example\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;
use Converter\Processor\Entity\EntityTextProcessorInterface;
use Converter\Writer\Transformer\EntityTransformerInterface;

class TextWriter implements EntityTransformerInterface
{
    /**
     * @param EntityConverterInterface|EntityTextProcessorInterface $entity
     * @return array
     */
    public function transform(EntityConverterInterface $entity): array
    {
        $data = [$entity->getText()];
        return $data;
    }

}