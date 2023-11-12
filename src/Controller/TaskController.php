<?php
declare(strict_types=1);

namespace App\Controller;

use App\Infrastructure\Http\Request;
use App\Service\Dto\CreateTaskDto;

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

            $answerService->create($createTask);
            return true;
        }
//        if ($_SERVER["REQUEST_METHOD"] === "GET" && $arrayUri[2] === 'readAnswer') {
//            $answerService = new AnswerService($jsonBody);
//            $result = $answerService->read($jsonBody);
//            return true;
//        }
//        if ($_SERVER["REQUEST_METHOD"] === "PATCH" && $arrayUri[2] === 'updateAnswer') {
//            $answerService = new AnswerService($jsonBody);
//            $result = $answerService->update($jsonBody);
//            return true;
//        }
//        if ($_SERVER["REQUEST_METHOD"] === "DELETE" && $arrayUri[2] === 'deleteAnswer') {
//            // вызвать метод deleteAnswer
//            $answerService = new AnswerService($jsonBody);
//            $result = $answerService->delete($jsonBody);
//            return true;
//        }
        return false;
    }
}