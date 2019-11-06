<?php

namespace Unit\Converter\Entity;

use Converter\Processor\Entity\EntityTextProcessorInterface;

class TextEntity implements EntityTextProcessorInterface
{
    protected $text;

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}