<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Dto\CreateTaskDto;
use App\Service\Entity\TaskEntity;
use App\Service\Repository\TaskRepository;

class TaskService
{
    public CreateTaskDto $taskDto;

    public function __construct(CreateTaskDto $taskDto = null) {
        $this->taskDto = $taskDto;
        $this->taskRepository = new TaskRepository();
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
        $this->taskRepository->save($taskEntity);
    }

    public function read($id = null) {
        if (empty($id)) {
            return $this->taskRepository->find();
        }
        return $this->taskRepository->findBy(['id' => $id]);
    }

    public function update($data, $id) {
        $this->taskRepository->update($data, ['id' => $id]);
    }

    public function deactivate($id) {
        $this->taskRepository->update(['isActive => false'], ['id' => $id]);
    }
}