<?php
namespace Converter\Writer\Transformer;

interface CollectionTransformerInterface
{
    public function transform(\Traversable $data): ?array;
}