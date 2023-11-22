<?php
namespace app\controllers;

use app\models\TaskModels;
use app\repositorys\TaskRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// controller  chamado nas rotas
// gerencia oas  respostas  e coleta  os parametros e o corpo  da requisição passando  para o  repository adequado
class TaskController
{

    public function index(Request $request, Response $response)
    {
        $tasks = TaskRepository::getTasks(); // pega as tarefas no banco de dados
        $body = $response->getBody(); // coleta  o  corpo da requisiçãoi
        $body->write(json_encode($tasks)); // transforma em  json
        return $response;
    }

    public function store(Request $request, Response $response)
    {
        $taskData = $request->getParsedBody();
        $bodyValidation = TaskModels::postModel($taskData); // valida o body da requisição

        if ($bodyValidation !== true) {
            $body = $response->getBody(); 
            $body->write($bodyValidation);
            return $response->withStatus(422);
        }

        $task = taskRepository::createTask($taskData); // cria  a  task  no banco  de dados
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

        $task = taskRepository::updateTask($taskData); // atualiza a task 
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

        $task = taskRepository::deleteTask($taskId); // deleta  a task
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



