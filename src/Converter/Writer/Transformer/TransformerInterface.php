<?php
namespace Converter\Writer\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;

interface TransformerInterface
{

    /**
     * Get data from reader and return entity to processor
     * @param $data
     * @return mixed
     */
    public function transform(EntityConverterInterface $entity): array;
}