<?php
namespace Converter\Processor;

use Converter\Processor\Entity;
use Converter\Exception;

class FileExistProcessor implements ProcessorInterface
{
    public function process(Entity\EntityConverterInterface $entity)
    {
        if (!$entity instanceof Entity\EntityFileProcessorInterface) {
            throw new Exception\ProcessorException(
                'Entity '.get_class($entity).' does not implement interface EntityFileProcessorInterface!'
            );
        }
        if (file_exists($entity->getFilePath())) {
            $entity->setFileExist(true);
        } else {
            $entity->setFileExist(false);
        }
    }
}