<?php
declare(strict_types=1);

namespace App\Service\Repository;

use App\Service\Entity\TaskEntity;
use App\Infrastructure\Db\QueryBuilder;

class TaskRepository
{
    public function __construct() {
        $this->query = new QueryBuilder(TaskEntity::TABLE_NAME);
    }

    public function save(TaskEntity $taskEntity)
    {
        $this->query->save($taskEntity);
    }

    public function find() {
        return $this->query->find();
    }

    public function findBy($params) {
        return $this->query->findBy($params);
    }

    public function update($set, $params) {
        $this->query->update($set, $params);
    }
}