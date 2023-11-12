<?php

declare(strict_types=1);

namespace App;

ini_set('display_errors', 1);

//use App\Controller\AnswerController;

use App\Controller\TaskController;
use App\Infrastructure\Http\Request;

require_once __DIR__ . '/../vendor/autoload.php';


$input = file_get_contents('php://input');
$request = new Request($input);

$taskController = new TaskController($request);

$result = $taskController->main();

//$controller = new AnswerController($postData, $jsonBody, $arrayUri);
//$result = $controller->main($jsonBody, $arrayUri);
//echo 1;