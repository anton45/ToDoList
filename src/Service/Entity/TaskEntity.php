<?php
declare(strict_types=1);

namespace App\Service\Entity;

use App\Service\Dto\CreateTaskDto;

class TaskEntity
{
    const TABLE_NAME = 'task';

//    private string $id;
    private string $topic;
    private string $description;
    private int $status;
    private int $priority;
    private int $createDate;
    private int $updateDate;

//    public function getId(): string
//    {
//        return $this->id;
//    }

    public function setTopic(string $topic): void
    {
        $this->topic = $topic;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function setCreatrDate(int $createDate): void
    {
        $this->createDate = $createDate;
    }

    public function setUpdateDate(int $updateDate): void
    {
        $this->updateDate = $updateDate;
    }
}