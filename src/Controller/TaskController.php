<?php
declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Http\Request;
use App\Service\Dto\CreateTaskDto;
use App\Service\TaskService;

class TaskController extends AbstractController
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function main()
    {
        if ($this->request->getMethod() === Request::PUT && $this->request->getCommand() === self::CREATE) {
            $data = $this->request->getBody();
            $createTask = new CreateTaskDto(...$data);
            $taskService = new TaskService($createTask);
            $taskService->create($createTask);
            return true;
        }
        if ($_SERVER["REQUEST_METHOD"] === Request::GET && $this->request->getCommand() === self::READ) {
            $taskService = new TaskService();
            $taskService->read($taskId);
            return true;
        }
        if ($_SERVER["REQUEST_METHOD"] === Request::PATCH && $this->request->getCommand() === self::UPDATE ) {
            $createTask = new CreateTaskDto(...$data);
            $taskService = new TaskService($createTask);
            $taskService->update($createTask, $taskId);
            return true;
        }
        if ($_SERVER["REQUEST_METHOD"] === Request::DELETE && $this->request->getCommand() === self::DELETE) {
            // вызвать метод deleteAnswer
            $taskService = new TaskService();
            $taskService->delete($taskId);
            return true;
        }
        return false;
    }
}