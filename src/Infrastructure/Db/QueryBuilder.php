<?php

namespace App\Infrastructure\Db;

use App\Service\Entity\TaskEntity;
use PDO;
use ReflectionClass;
use ReflectionProperty;

class QueryBuilder
{
    private PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO(Db::DSN,DB::USERNAME, DB::PASSWORD);
    }

    /**
     * @throws \ReflectionException
     */
    public function save($entity) {
        $fields = $this->getFields($entity);
        $values = [];

        $reflection = new ReflectionClass($entity);

        foreach ($reflection->getProperties(ReflectionProperty::IS_PRIVATE) as $property) {
            $property->setAccessible(true);
            $fieldName = $property->getName();
            $fields[] = $fieldName;
            $values[":" . $fieldName] = $property->getValue($entity);
        }

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            TaskEntity::TABLE_NAME,
            implode(", ", $fields),
            implode(", ", array_keys($values))
        );

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($values);
    }

    private function getFields($entity, $accessType = ReflectionProperty::IS_PRIVATE) {
        $fields = [];

        $reflection = new ReflectionClass($entity);
        $properties = $reflection->getProperties($accessType);

        foreach ($properties as $property) {
            $fields[] = $property->getName();
        }

        return $fields;
    }
}