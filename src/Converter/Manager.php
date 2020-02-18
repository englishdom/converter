<?php
namespace Converter;

use Converter\Exception\ConverterException;

class Manager
{
    /**
     * @var array
     */
    protected $readers = null;

    /**
     * @var array
     */
    protected $processors = null;

    /**
     * @var array
     */
    protected $writers = null;

    /**
     * @param array $readers [['reader'=>new Reader(), 'transformer'=>Transformer::class], [...]]
     * @param array $processors [new ProcessorOne(), new ProcessorTwo(), ...]
     * @param array $writers [new WriterOne(), new WriterTwo(), ...]
     */
    public function __construct(array $readers, array $processors, array $writers)
    {
        $this->setReaders($readers);
        $this->setProcessors($processors);
        $this->setWriters($writers);
    }

    /**
     * @param array $readers [['reader'=>new Reader(), 'transformer'=>Transformer::class], [...]]
     */
    public function setReaders(array $readers)
    {
        foreach ($readers as $array) {
            if (!isset($array['reader']) || empty($array['reader'])) {
                throw new ConverterException('Can not set \'reader\' parameter!');
            }
            if (!isset($array['transformer']) || empty($array['transformer'])) {
                throw new ConverterException('Can not set \'transformer\' parameter!');
            }
        }
        $this->readers = $readers;
    }

    public function getReaders(): ?array
    {
        return $this->readers;
    }

    public function setProcessors(array $processors)
    {
        $this->processors = $processors;
    }

    public function getProcessors(): ?array
    {
        return $this->processors;
    }

    public function setWriters(array $writers)
    {
        foreach ($writers as $array) {
            if (!isset($array['writer']) || empty($array['writer'])) {
                throw new ConverterException('Can not set \'writer\' parameter!');
            }
            if (!isset($array['transformer']) || empty($array['transformer'])) {
                throw new ConverterException('Can not set \'transformer\' parameter!');
            }
        }
        $this->writers = $writers;
    }

    public function getWriters(): ?array
    {
        return $this->writers;
    }

    public function manage()
    {
        $returnData = [];

        foreach ($this->readers as $readerArray) {
            /* Get part of data from reader */
            while ($data = $readerArray['reader']->read()) {
                if (!$readerArray['transformer'] instanceof Reader\Transformer\EntityTransformerInterface
                    && !$readerArray['transformer'] instanceof Reader\Transformer\CollectionTransformerInterface
                ) {
                    throw new ConverterException(
                        'The `'.get_class($readerArray['transformer']).'` does not implement interfaces from Reader\Transformer!'
                    );
                }

                foreach ($data as $key => $one) {
                    /* start reader transformer */
                    $readData = $readerArray['transformer']->transform($one);
                    if ($readData === null) {
                        continue;
                    }

                    /* start processors */
                    foreach ($this->getProcessors() as $processor) {
                        $processor->process($readData);
                    }

                    /* start writers */
                    foreach ($this->getWriters() as $writerArray) {
                        $writeData = $readData;
                        if (isset($writerArray['transformer']) && !empty($writerArray['transformer'])) {
                            if (!$writerArray['transformer'] instanceof Writer\Transformer\EntityTransformerInterface
                                && !$writerArray['transformer'] instanceof Writer\Transformer\CollectionTransformerInterface
                            ) {
                                throw new ConverterException(
                                    'The `' . get_class($writerArray['transformer']) . '` does not implement interfaces from Writer\Transformer!'
                                );
                            }

                            /* start writer transformer */
                            $writeData = $writerArray['transformer']->transform($readData);
                            if ($writeData === null) {
                                continue;
                            }
                        }

                        $returnData[] = $writerArray['writer']->write($writeData);
                    }
                }
            }
        }
        return $returnData;
    }
}