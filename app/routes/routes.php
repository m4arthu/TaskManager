<?php

use Slim\App;

use app\controllers\TaskController;

// configurando  as rotas e os endpoinds de cada uma delas  usando  controllers
return function (App $app) {
    $app->get('/tasks', [TaskController::class, 'index']);
    $app->post('/tasks', [TaskController::class, 'store']);
    $app->put('/tasks', [TaskController::class, 'update']);
    $app->delete('/tasks/{id}',[TaskController::class, 'destroy']);
    $app->addErrorMiddleware(true, true, true);
};
