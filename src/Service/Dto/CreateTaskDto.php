<?php
declare(strict_types=1);

namespace App\Service\Dto;

class CreateTaskDto
{
    public string $topic;
    public string $description;
    public int $status;
    public int $priority;

    public function __construct(...$data) {
        $this->topic = $data['topic'];
        $this->description = $data['description'];
        $this->status = $data['status'];
        $this->priority = $data['priority'];
    }

}