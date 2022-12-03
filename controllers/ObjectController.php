<?php
require_once "../controllers/BaseVideocardController.php";

class ObjectController extends BaseVideocardController {
    public $template = "object.twig";
    public function set_content()
    {
       

    }

    public function getContext(): array
    {   
        if (isset($_GET['show'])) {
            $showType=$_GET['show'];

            if ($showType=="image"){
                    $this->template = "object_image.twig";
                    echo($this->template);
            }
            else{
                $this->template = "object_info.twig";
                echo($this->template);
            }
        } else {
            $this->template = "object.twig";
            echo($this->template);
        }
        $context = parent::getContext();

        echo("\n");
        echo($_GET['show']);

        $query = $this->pdo->prepare("SELECT * FROM videocards WHERE id = :my_id;");
        $query->bindValue("my_id",$this->params["id"]);
        $query->execute();

        $data = $query->fetch();
        $context['description'] = $data['description'];
        $context['image'] = $data['image'];
        $context['info_full'] = nl2br($data['info_full']);
        $context['id_v'] = $data['id'];
        return $context;
    }
}
