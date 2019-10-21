<?php
namespace Converter\Writer\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;

interface EntityTransformerInterface
{

    /**
     * Get data from reader and return entity to processor
     * @param $entity
     * @return mixed
     */
    public function transform(EntityConverterInterface $entity): array;
}