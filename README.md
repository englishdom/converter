# Converter
A library for reading data, converting and writing

### Setup reader
Setup PdoReader for reading data from mysql.
```
$reader = new \Converter\Reader\PdoReader(
    'mysql:host=localhost;port=3306;dbname=base;charset=utf8',
    'user',
    'pass',
    [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
    'table'
);
```
If need extend query adapter has method `setSQL`

### Setup manager
After reading data need convert data to entity
```
$manager = new \Converter\Manager(
    [['reader' => $reader, 'transformer' => \Converter\Reader\Transformer\BaseTransformer::class]],
    [new \Converter\Processor\FileExistProcessor()],
    [['writer' => $writer, 'transformer' => \Converter\Writer\Transformer\BaseTransformer::class]]
);
$manager->manage();
```

