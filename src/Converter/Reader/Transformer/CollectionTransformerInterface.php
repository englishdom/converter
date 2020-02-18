<?php

namespace Converter\Reader\Transformer;

interface CollectionTransformerInterface
{
    /**
     * @param $data
     * @return \Traversable|null
     */
    public function transform($data): ?\Traversable;
}