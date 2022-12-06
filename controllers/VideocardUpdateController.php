<?php
require_once "BaseVideocardController.php";

class VideocardUpdateController extends BaseVideocardController {
    public $template = "videocard_create.twig";

    public function get(array $context){
        parent::get($context);
    }

    public function getContext():array{
        $context=parent::getContext();
        $query=$this->pdo->prepare("SELECT * FROM v_types");
        $query->execute();
        $v_types = $query->fetchAll();
        $context['v_types']=$v_types;

        return $context;
    }

    public function post(array $context) {

        if (isset($_POST['object'])){
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
            $context['title'] = $title;
        } elseif(isset($_POST['type'])){
            $v_types = $_POST['type_v'];
    $sql_t = <<<EOL
INSERT INTO v_types(name)
VALUES(:v_types)
EOL;
                   
            $query_t = $this->pdo->prepare($sql_t);
            $query_t->bindValue("v_types", $v_types);
           
            $context['v_types'] = $v_types;
            $query_t->execute();
            $context['message_t'] = 'Вы успешно создали тип!';
            $context['v_types'] = $v_types;
        }
        
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}
