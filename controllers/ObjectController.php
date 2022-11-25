<?php

class ObjectController extends TwigBaseController {
    public $template = "object.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->prepare("SELECT description, id FROM videocards WHERE id= :my_id;");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();
        $context['description'] = $data['description'];
        $context['id'] = $this->params[0];
        // $context['image'] = $data['image'];
        // $context['info_full'] = $data['info_full'];

        echo $context['description'];
        echo $context['image'];
        echo $context['info_full'];

        return $context;
    }
}
