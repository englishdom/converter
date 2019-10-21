<?php
namespace Converter\Processor;

use Converter\Processor\Entity;
use Converter\Exception;

class FileExistProcessor implements ProcessorInterface
{
    public function process($entity)
    {
        if ($entity instanceof \Traversable) {
            foreach ($entity as $one) {
                $this->exec($one);
            }
        } elseif ($entity instanceof Entity\EntityFileProcessorInterface) {
            $this->exec($entity);
        } else {
            throw new Exception\ProcessorException(
                'Entity '.get_class($entity).' does not implement interface EntityFileProcessorInterface!'
            );
        }
    }

    protected function exec(Entity\EntityFileProcessorInterface $entity)
    {
        if (file_exists($entity->getFilePath())) {
            $entity->setFileExist(true);
        } else {
            $entity->setFileExist(false);
        }
    }
}