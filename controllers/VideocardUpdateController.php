<?php
require_once "BaseVideocardController.php";

class VideocardUpdateController extends BaseVideocardController {
    public $template = "videocard_update.twig";

    public function get(array $context){
        $id = $this->params['id'];
        $sql = <<<EOL
SELECT * FROM videocards WHERE id = :id
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();

        $data = $query->fetch();
    
        
        $context['object']=$data;
        $query=$this->pdo->prepare("SELECT * FROM v_types");
            
        $query->execute();
        $v_types = $query->fetchAll();
        $context['v_types']=$v_types;

        parent::get($context);
    }

    public function post(array $context) {
        if (isset($_POST['object'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info_full = $_POST['info_full'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $id = $this->params['id'];
        $name =  $_FILES['image']['name'];
        
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";
        $sql = <<<EOL
UPDATE videocards
SET title=:title,description=:description,type= :type,info_full= :info_full,image= :image_url
WHERE id=:id
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("id",$id);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info_full", $info_full);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();
        
        $context['message'] = 'Объект успешно изменен!';
        $context['title'] = $title;
        }
        $context['id'] = $this->pdo->lastInsertId();

        $this->get($context);
    }
}
