<?php
namespace Converter\Reader\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;

interface EntityTransformerInterface
{

    /**
     * Get data from reader and return entity to processor
     * @param $data
     * @return mixed
     */
    public function transform($data): EntityConverterInterface;
}