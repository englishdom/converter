<?php

namespace Converter\Reader;

use Converter\Exception\ReaderException;

class PdoReader implements ReaderInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $sql = null;

    protected $limit = 1000;

    protected $offset = 0;

    public function __construct($dsn, $user, $pass, array $options = [], $table = null)
    {
        $this->pdo = new \PDO($dsn, $user, $pass, $options);
        if ($table !== null) {
            $this->setTable($table);
        }
    }

    public function setTable(string $tableName)
    {
        $this->setSql('SELECT * FROM `' . $tableName . '`');
    }

    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    public function setSql(string $sql)
    {
        $this->offset = 0;
        $this->sql = $sql;
    }

    public function read()
    {
        if ($this->sql === null) {
            throw new ReaderException('SQL query did not set!');
        }

        $result = $this->pdo->query($this->sql . ' LIMIT ' . $this->limit . ' OFFSET ' . $this->offset);
        $this->offset += $this->limit;
        return $result instanceof \PDOStatement ? $result->fetchAll() : null;
    }
}
