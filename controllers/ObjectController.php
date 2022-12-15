<?php
require_once "../controllers/BaseVideocardController.php";

class ObjectController extends BaseVideocardController {
    public $template = "object.twig";

    public function getContext(): array
    {   
        if (isset($_GET['show'])) {
            $typeShow=$_GET['show'];

            if ($typeShow=="image"){
                $this->template = "object_image.twig";
            }
            else{
                $this->template = "object_info.twig";
            }
        } else {
            $this->template = "object.twig";
        }
        $context = parent::getContext();

        $query = $this->pdo->prepare("SELECT * FROM videocards WHERE id= :my_id;");
        $query->bindValue("my_id",$this->params['id']);
        $query->execute();

        $data = $query->fetch();
        $context['description'] = $data['description'];
        $context['image'] = $data['image'];
        $context['info_full'] = $data['info_full'];
        $context['id_v'] = $data['id'];
        $context["my_session_message"] = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : "";
        $context["messages"] = isset($_SESSION['messages']) ? $_SESSION['messages'] : "";
        return $context;
    }
}
