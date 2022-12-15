<?php
require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once '../controllers/MainController.php';
require_once "../controllers/ObjectController.php";
require_once '../controllers/Controller404.php';
require_once '../controllers/SearchController.php';
require_once '../controllers/VideocardCreateController.php';
require_once '../controllers/VideocardDeleteController.php';
require_once "../controllers/VideocardUpdateController.php";
require_once "../middlewares/LoginRequiredMiddleware.php";
require_once "../controllers/LoginController.php";
require_once "../controllers/LogoutController.php";



$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true
]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

session_set_cookie_params(60*60*10);
session_start();


$title = "";
$template = "";
$url_title = "";
$context = [];

$pdo = new PDO("mysql:host=localhost;dbname=gpus;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/login",LoginController::class);
$router->add("/videocard/(?P<id>\d+)", ObjectController::class);
$router->add("/videocard/search", SearchController::class);
$router->add("/logout", LogoutController::class);
$router->add("/videocard/add", VideocardCreateController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/videocard/delete", VideocardDeleteController::class)->middleware(new LoginRequiredMiddleware());
$router->add("/videocard/(?P<id>\d+)/edit", VideocardUpdateController::class)->middleware(new LoginRequiredMiddleware());

$router->get_or_default(Controller404::class);