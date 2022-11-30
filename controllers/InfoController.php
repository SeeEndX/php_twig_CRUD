<?php

class InfoController extends TwigBaseController {
    public $template = "object_info.twig"; #fsf

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->prepare("SELECT info_full, id FROM videocards WHERE id= :my_id;");
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();

        $context['info_full'] = $data['info_full'];
        $context['id_v'] = $data['id'];

        return $context;
    }
}
