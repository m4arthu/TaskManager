<?php

use Slim\App;

use app\controllers\TaskController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Routing\RouteContext;

// configurando  as rotas e os endpoinds de cada uma delas  usando  controllers
return function (App $app) {
    // perimitindo cors origin
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function (Request $request, RequestHandlerInterface $handler): Response {
        $routeContext = RouteContext::fromRequest($request);
        $routingResults = $routeContext->getRoutingResults();
        $methods = $routingResults->getAllowedMethods();
        $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');
        $response = $handler->handle($request);
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Methods', implode(',', $methods));
        $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);
    
        return $response;
    });
    
   // chama  o  middle  de rotas (é obrigatório)
    $app->addRoutingMiddleware();

    // rotas da aplicação
    $app->get('/tasks', [TaskController::class, 'index']);
    $app->post('/tasks', [TaskController::class, 'store']);
    $app->put('/tasks', [TaskController::class, 'update']);
    $app->delete('/tasks/{id}',[TaskController::class, 'destroy']);
    $app->addErrorMiddleware(true, true, true);
};
