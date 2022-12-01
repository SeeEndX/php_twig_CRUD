<?php
require_once "BaseVideocardController.php";

class MainController extends BaseVideocardController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();
                
        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM videocards WHERE type =:type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query=$this->pdo->query("SELECT * FROM videocards");
        }

        $context['videocards'] = $query->fetchAll();

        return $context;
    }
}
