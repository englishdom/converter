<?php

namespace Converter\Processor\Entity;

interface EntityTextProcessorInterface extends EntityConverterInterface
{
    public function setText(string $text);
    public function getText(): ?string;
}