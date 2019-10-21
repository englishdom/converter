<?php

namespace Converter\Reader\Transformer;

interface CollectionTransformerInterface
{
    public function transform($data): \Traversable;
}