<?php
namespace app\controllers;

use app\models\TaskModels;
use app\repositorys\TaskRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TaskController
{

    public function index(Request $request, Response $response)
    {
        $tasks = TaskRepository::getTasks();
        $body = $response->getBody();
        $body->write(json_encode($tasks));
        return $response;
    }

    public function store(Request $request, Response $response)
    {
        $taskData = $request->getParsedBody();
        $bodyValidation = TaskModels::postModel($taskData);

        if ($bodyValidation !== true) {
            $body = $response->getBody();
            $body->write($bodyValidation);
            return $response->withStatus(422);
        }

        $task = taskRepository::createTask($taskData);
        $body = $response->getBody();
        if($task === true){
            $body->write("Task Created successfully");
        } else {
            $body->write($task);
        }
            return $response;
    }

    public function update(Request $request, Response $response)
    {
        $taskData = $request->getParsedBody();
        $bodyValidation = TaskModels::updateModel($taskData);

        if ($bodyValidation !== true) {
            $body = $response->getBody();
            $body->write($bodyValidation);
            return $response->withStatus(422);
        }

        $task = taskRepository::updateTask($taskData);
        $body = $response->getBody();
        if($task === true){
            $body->write("Task Updated successfully");
        } else {
            $body->write($task);
            return $response->withStatus(422);
        }

        return $response;
    }


    public function destroy(Request $request, Response $response,$args){
        $taskId = $args['id'];

        $task = taskRepository::deleteTask($taskId);
        $body = $response->getBody();
        if($task === true){
            $body->write("Task deleted successfully");
        } else {
            $body->write($task);
            return $response->withStatus(422);
        }

        return $response;
    }



}



