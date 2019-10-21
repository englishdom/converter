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

        if (isset($data[0]) && is_array($data[0])) {
            $insertKeys = implode('`,`', array_keys($data[0]));
            foreach ($data as $one) {
                $arrayValues[] = implode('\',\'', array_values($one));
            }
            $insertValues = implode('\'),(\'', $arrayValues);
        } else {
            $insertKeys = implode('`,`', array_keys($data));
            $insertValues = implode('\',\'', array_values($data));
        }

        $sql = sprintf(
            'INSERT INTO `%s` (`%s`) VALUES (\'%s\')',
            $this->tableName,
            $insertKeys,
            $insertValues
        );

        $this->pdo->query($sql);
    }
}