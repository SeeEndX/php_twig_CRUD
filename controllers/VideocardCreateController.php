<?php
require_once "BaseVideocardController.php";

class VideocardCreateController extends BaseVideocardController {
    public $template = "videocard_create.twig";

    public function get(array $context){
        echo $_SERVER['REQUEST_METHOD'];

        parent::get($context);
    }

    public function post(array $context) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info_full = $_POST['info_full'];
        

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        $image_url = "/media/$name";
        
        move_uploaded_file($tmp_name, "../public/media/$name");

        $sql = <<<EOL
INSERT INTO videocards(title, description, type, info_full, image)
VALUES(:title, :description, :type, :info_full, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info_full", $info_full);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();

        $context['message'] = 'Объект успешно добавлен!';
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}
