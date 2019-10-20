<?php
namespace Converter\Writer;

use Converter\Exception\WriterException;

class PdoWriter implements WriterInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    protected $tableName = null;

    public function __construct($dsn, $user, $pass, array $options = [], $table = null)
    {
        $this->pdo = new \PDO($dsn, $user, $pass, $options);
        if ($table !== null) {
            $this->setTable($table);
        }
    }

    public function setTable(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function write(array $data)
    {
        if ($this->tableName === null) {
            throw new WriterException('A table name did not set!');
        }

        $insertKeys = array_keys($data);
        $insertValues = array_values($data);

        $sql = sprintf(
            'INSERT INTO `%s` (`%s`) VALUES (\'%s\')',
            $this->tableName,
            implode('`,`', $insertKeys),
            implode('\',\'', $insertValues)
        );

        $this->pdo->query($sql);
    }
}