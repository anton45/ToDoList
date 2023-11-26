<?php

namespace App\Infrastructure\Db;

use App\Service\Entity\TaskEntity;
use PDO;
use ReflectionClass;
use ReflectionProperty;

class QueryBuilder
{
    private PDO $pdo;
    private string $table;

    public function __construct(string $table) {
        $this->pdo = new PDO(Db::DSN,DB::USERNAME, DB::PASSWORD);
        $this->table = $table;
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
            $this->table,
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

    public function find() {
        $sql = 'SELECT * FROM' . $this->table;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findBy($conditions) {
        $sql = 'SELECT * FROM' . $this->table;
        $result = $this->andWhere($conditions);

        $stmt = $this->pdo->prepare($sql . $result['sql']);
        $stmt->execute($result['params']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update (array $set, array $conditions) {
        $sql = 'UPDATE ' . $this->table . ' SET';

        $whereArray = '';
        foreach ($conditions as $field => $value) {
            $whereArray .= $field . '= ?,';
            $params[] = $value;
        }
        $sql .= substr($whereArray,0,-1);
        $result = $this->andWhere($conditions);

        $stmt = $this->pdo->prepare($sql . $result['sql']);

        return $stmt->execute(array_merge($params, $result['params']));
    }

    public function andWhere(array $conditions): array {
        $sql = 'WHERE';

        foreach ($conditions as $field => $value) {
            $whereArray[] = $field . ' = ?,';
            $params[] = $value;
        }
        $sql .= implode(' AND ', $whereArray);
        $sql = substr($sql,0,-1);

        return ['sql' => $sql, 'params' => $params];
    }

}