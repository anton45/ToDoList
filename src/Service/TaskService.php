<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Dto\CreateTaskDto;
use App\Service\Entity;

class TaskService
{
    private function save(CreateTaskDto $taskDto) {
        // создаю сущность
        // отправляю ее в репозиторий
        $save = new Task
    }
}