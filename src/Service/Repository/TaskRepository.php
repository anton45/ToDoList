<?php
declare(strict_types=1);

namespace App\Service\Repository;

use App\Service\Entity\TaskEntity;
use App\Infrastructure\Db\QueryBuilder;

class TaskRepository
{
    public function save(TaskEntity $taskEntity): bool
    {
        $query = new QueryBuilder();
        $query->save($taskEntity);
        return true;
    }
}