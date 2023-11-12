<?php
declare(strict_types=1);

namespace App\Service\Dto;

class CreateTaskDto
{
    private string $topic;
    private string $description;
    private int $status;
    private int $priority;

    public function __construct(...$data) {
        $this->topic = $data['topic'];
        $this->description = $data['description'];
        $this->status = $data['status'];
        $this->priority = $data['priority'];
    }

}