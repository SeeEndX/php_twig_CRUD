<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once '../controllers/MainController.php';
require_once "../controllers/ObjectController.php";

require_once '../controllers/ThirtyController.php';
require_once '../controllers/ThirtyImageController.php';
require_once '../controllers/ThirtyInfoController.php';
require_once '../controllers/Controller404.php';
require_once '../controllers/FourtyController.php';
require_once '../controllers/FourtyImageController.php';
require_once '../controllers/FourtyInfoController.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

$title = "";
$template = "";
$url_title = "";
$context = [];
$categoty = ['description','image','info_full'];

$pdo = new PDO("mysql:host=localhost;dbname=gpus;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/rtx3090", ThirtyController::class);
$router->add("/videocards/(?P<id>\d+)", ObjectController::class);

$router->get_or_default(Controller404::class);