<?php
require_once '../vendor/autoload.php';
require_once '../controllers/MainController.php';
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

$url = $_SERVER["REQUEST_URI"];
$title = "";
$template = "";
$url_title = "";
$context = [];

$controller = new Controller404($twig);

$pdo = new PDO("mysql:host=localhost;dbname=gpus;charset=utf8", "root", "");

if ($url == "/") {
    $controller = new MainController($twig);
}



if ($controller) {
    $controller -> setPDO($pdo);
    $controller -> get();
}


^/space-objects/(\d+)$
