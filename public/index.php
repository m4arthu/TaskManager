<?php

use Slim\Factory\AppFactory;
require '../vendor/autoload.php';

$app = AppFactory::create();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app->addBodyParsingMiddleware();

$routes = require '../app/routes/routes.php';

$routes($app);

$app->run();