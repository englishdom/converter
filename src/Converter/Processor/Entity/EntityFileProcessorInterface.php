<?php
namespace Converter\Processor\Entity;

interface EntityFileProcessorInterface extends EntityConverterInterface
{
    public function getFilePath(): string;

    public function setFileExist(bool $isExist);
}