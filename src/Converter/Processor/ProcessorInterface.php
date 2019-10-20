<?php
namespace Converter\Processor;

use Converter\Processor\Entity\EntityConverterInterface;

interface ProcessorInterface
{
    public function process(EntityConverterInterface $entity);
}