<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once '../controllers/MainController.php';
require_once "../controllers/ObjectController.php";
require_once '../controllers/Controller404.php';
require_once '../controllers/SearchController.php';
require_once '../controllers/VideocardCreateController.php';
require_once '../controllers/VideocardDeleteController.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$title = "";
$template = "";
$url_title = "";
$context = [];

$pdo = new PDO("mysql:host=localhost;dbname=gpus;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/videocard/(?P<id>\d+)", ObjectController::class);
$router->add("/videocard/search", SearchController::class);
$router->add("/videocard/add", VideocardCreateController::class);
$router->add("/videocard/delete", VideocardDeleteController::class);
$router->get_or_default(Controller404::class);