<?php
namespace Example\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;
use Converter\Reader\Transformer\TransformerInterface;
use Example\Entity\Entity;

class Reader implements TransformerInterface
{
    /**
     * Get data from reader and return entity to processor
     * @param $data
     * @return mixed
     */
    public function transform($data): EntityConverterInterface
    {
        $entity = new Entity();
        $entity->setFilePath($data['path']);
        return $entity;
    }
}