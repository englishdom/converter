<?php
namespace Unit\Converter\Reader;

use Converter\Exception\ReaderException;
use Mockery;
use Converter\Reader\PdoReader;
use Unit\ExtendTestCase;

class PDOReaderTest extends ExtendTestCase
{
    /**
     * @var PdoReader|Mockery\MockInterface
     */
    protected $reader;

    public function setUp(): void
    {
        $this->reader = Mockery::mock(PdoReader::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();
    }

    public function testSetTable()
    {
        $this->reader->setTable('table');
        $property = parent::getProtectedProperty(PdoReader::class, 'sql');
        $value = $property->getValue($this->reader);

        $this->assertEquals('SELECT * FROM `table` LIMIT 1000 OFFSET 0', $value);
    }

    public function testSetLimit()
    {
        $this->reader->setLimit(2000);
        $property = parent::getProtectedProperty(PdoReader::class, 'limit');
        $value = $property->getValue($this->reader);

        $this->assertEquals(2000, $value);
    }

    public function testReadError()
    {
        $this->expectException(ReaderException::class);
        $this->reader->read();
    }

    public function testOffset()
    {
        $this->reader->setOffset(2000);
        $property = parent::getProtectedProperty(PdoReader::class, 'offset');
        $value = $property->getValue($this->reader);

        $this->assertEquals(2000, $value);
    }

    public function testCompleteSql()
    {
        $this->reader->setLimit(2000);
        $this->reader->setOffset(2000);
        $this->reader->setSql('SELECT * FROM table');
        $property = parent::getProtectedProperty(PdoReader::class, 'sql');
        $value = $property->getValue($this->reader);

        $this->assertEquals('SELECT * FROM table LIMIT 2000 OFFSET 2000', $value);
    }
}