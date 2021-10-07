<?php

use Src\Application\Core\CoreRouter;
use Dotenv\Dotenv;

session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

require '../routes/routes.php';
require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable('../');
$dotenv->safeLoad();

$core = new CoreRouter($routes);
$core->run();