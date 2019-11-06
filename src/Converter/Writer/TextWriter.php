<?php

namespace Converter\Writer;

class TextWriter implements WriterInterface
{
    public function write(array $data)
    {
        return $data;
    }
}