<?php
namespace Unit\Converter\Reader;

use Converter\Exception\ReaderException;
use Mockery;
use Converter\Reader\PdoReader;
use Unit\ExtendTestCase;

class PDOWriterTest extends ExtendTestCase
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

        $this->assertEquals('SELECT * FROM `table`', $value);
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

    public function testLimit()
    {
        $this->reader->setLimit(2000);

        $property = parent::getProtectedProperty(PdoReader::class, 'limit');
        $limit = $property->getValue($this->reader);

        $this->assertEquals(2000, $limit);
    }

    public function testCompleteSql()
    {
        $this->reader->setSql('SELECT * FROM table');
        $property = parent::getProtectedProperty(PdoReader::class, 'sql');
        $sql = $property->getValue($this->reader);

        $this->assertEquals('SELECT * FROM table', $sql);
    }
}