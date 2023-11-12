<?php
declare(strict_types=1);

namespace App\Service\Entity;

class TaskEntity
{
    private string $id;
    private string $topic;
    private string $description;
    private int $status;
    private int $priority;
    private int $createDate;
    private int $updateDate;

    private function __construct(...$data) {

    }
}