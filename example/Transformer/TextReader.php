<?php

namespace Example\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;
use Converter\Reader\Transformer\EntityTransformerInterface;
use Example\Entity\TextEntity;

class TextReader implements EntityTransformerInterface
{
    public function transform($data): ?EntityConverterInterface
    {
        $entity = new TextEntity();
        $entity->setText($data);
        return $entity;
    }

}