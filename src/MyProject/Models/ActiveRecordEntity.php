<?php
namespace MyProject\Models;
use MyProject\Services\Db;

abstract class ActiveRecordEntity
{

    /** @var int */
    protected $id;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value): void
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    /**
     * @param string $source
     * @return string
     */
    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source) : string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    public static function getById(int $id) : ?static
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `'. static::getTableName() .'` WHERE id = :id;',
            [':id' => $id],
            static::class
        );

        return $entities ? $entities[0] : null;
    }

    private function mapPropertiesToDbFormat() : array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }


    public function save() : void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if( $this->id !== null ) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }

    }

    private function insert(array $mappedProperties) : void
    {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach( $filteredProperties as $columnName => $value ) {
            $columns[] = '`' . $columnName . '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }
        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO `'. static::getTableName() .'` ('.$columnsViaSemicolon.') VALUES ('. $paramsNamesViaSemicolon .');';

        $db = Db::getInstance();
        $db->query( $sql, $params2values, static::class );
        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    private function update(array $mappedProperties) : void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach($mappedProperties as $column => $value) {
            $param = ':param' . $index;
            $columns2params[] = $column . ' = ' . $param;
            $params2values[$param] = $value;
            $index++;
        }
        $sql = "UPDATE " . static::getTableName() . " SET " . implode(', ', $columns2params ) . " WHERE id = " . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    public function delete() : void
    {
        $db = Db::getInstance();
        $db->query('DELETE FROM `' . static::getTableName() .'` WHERE id=:id',[':id'=>$this->getId()], static::class);
        $this->id = null;
    }

    private function refresh() : void
    {
        $lastCreatedObject = static::getById($this->getId());
        foreach( $lastCreatedObject as $property => $value ) {
            $this->$property = $value;
        }
    }

    /**
     * @return string
     */
    abstract protected static function getTableName(): string;
}