<?php

namespace Example\Transformer;

use Converter\Reader\Transformer\CollectionTransformerInterface;
use Example\Entity\Entity;

class CollectionReader implements CollectionTransformerInterface
{
    public function transform($data): \Traversable
    {
        $collection = new \SplObjectStorage();
        $entity = new Entity();
        $entity->setFilePath('/path');
        $collection->attach($entity);

        $entity = new Entity();
        $entity->setFilePath('/path/2');
        $collection->attach($entity);

        return $collection;
    }
}