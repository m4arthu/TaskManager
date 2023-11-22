<?php

use Slim\Factory\AppFactory;
require '../vendor/autoload.php';
 
/// criando um  app  com a classe slim
$app = AppFactory::create();

// carregando  as variaveis  de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// para passar o  corpo da requisição em formato  json
$app->addBodyParsingMiddleware();

//carregando  as rotas do app
$routes = require '../app/routes/routes.php';

$routes($app);

// iniciando Api
$app->run();