<?php
namespace Example\Transformer;

use Converter\Exception\WriterException;
use Converter\Processor\Entity\EntityConverterInterface;
use Converter\Writer\Transformer\CollectionTransformerInterface;

class CollectionWriter implements CollectionTransformerInterface
{
    public function transform(\Traversable $data): array
    {
        $return = [];
        foreach ($data as $one) {
            if (!$one instanceof EntityConverterInterface) {
                throw new WriterException('Entity in collection does not implement EntityConverterInterface!');
            }

            $return[] = [
                'path' => $one->getFilePath(),
                'entity_name' => 'blog_post',
                'entity_id' => '1',
                'file_exists' => $one->getFileExist() === true ? 'yes' : 'no'
            ];
        }
        return $return;
    }
}