<?php

class ImageController extends TwigBaseController {
    public $template = "object_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->prepare("SELECT image, id FROM videocards WHERE id= :my_id;");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();

        $context['image'] = $data['image'];
        $context['id_v'] = $data['id'];
 
        return $context;
    }
}
