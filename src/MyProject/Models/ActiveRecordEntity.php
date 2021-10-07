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

    /**
     * @return array
     */
    public static function findAll(): array
    {
        $db = new Db();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    public static function getById(int $id) : ?static
    {
        $db = new Db();
        $entities = $db->query(
            'SELECT * FROM `'. static::getTableName() .'` WHERE id = :id;',
            [':id' => $id],
            static::class
        );

        return $entities ? $entities[0] : null;
    }

    /**
     * @return string
     */
    abstract protected static function getTableName(): string;
}