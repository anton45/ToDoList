<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Dto\CreateTaskDto;
use App\Service\Entity\TaskEntity;
use App\Service\Repository\TaskRepository;

class TaskService
{
    public CreateTaskDto $taskDto;

    public function __construct(CreateTaskDto $taskDto) {
        $this->taskDto = $taskDto;
    }

    public function create(CreateTaskDto $taskDto) {

        $time = time();
        $taskEntity = new TaskEntity();
        $taskEntity->setTopic($taskDto->topic);
        $taskEntity->setPriority($taskDto->priority);
        $taskEntity->setStatus($taskDto->status);
        $taskEntity->setDescription($taskDto->description);
        $taskEntity->setCreatrDate($time);
        $taskEntity->setUpdateDate($time);
        var_dump('TaskService');
        $taskRepository = new TaskRepository();
        $taskRepository->save($taskEntity);
    }
}