<?php

namespace Converter\Reader;

interface ReaderInterface
{
    public function read();

    public function setLimit(int $limit);

    public function setOffset(int $offset);
}
