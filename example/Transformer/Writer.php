<?php
namespace Example\Transformer;

use Converter\Processor\Entity\EntityConverterInterface;
use Converter\Writer\Transformer\TransformerInterface;

class Writer implements TransformerInterface
{
    /**
     * Get data from reader and return entity to processor
     * @param EntityConverterInterface $entity
     * @return mixed
     */
    public function transform(EntityConverterInterface $entity): array
    {
        $data = [
            'path' => $entity->getFilePath(),
            'entity_name' => 'blog_post',
            'entity_id' => '1',
            'file_exists' => $entity->getFileExist() === true ? 'yes' : 'no'
        ];
        return $data;
    }
}