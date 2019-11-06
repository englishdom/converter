<?php

namespace Converter\Reader;

use Converter\Exception\ReaderException;

class TextReader implements ReaderInterface
{
    /**
     * @var string
     */
    protected $text = null;

    /**
     * @var bool
     */
    protected $textProcessed = false;

    public function setText(array $text)
    {
        $this->text = $text;
    }

    public function read()
    {
        if ($this->text === null) {
            throw new ReaderException('A Text did not set!');
        }

        if ($this->textProcessed === false) {
            $this->textProcessed = true;
            return $this->text;
        }
        return null;
    }

    public function setLimit(int $limit)
    {
    }

    public function setOffset(int $offset)
    {
    }
}