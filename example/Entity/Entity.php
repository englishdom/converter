<?php

namespace Example\Entity;

use Converter\Processor\Entity\EntityFileProcessorInterface;

class Entity implements EntityFileProcessorInterface
{
    protected $filePath;
    protected $fileExist = false;

    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFileExist(bool $isExist)
    {
        $this->fileExist = $isExist;
    }

    public function getFileExist(): bool
    {
        return $this->fileExist;
    }
}