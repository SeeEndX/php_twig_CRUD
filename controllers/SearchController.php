<?php
require_once "../controllers/BaseVideocardController.php";

class SearchController extends BaseVideocardController {
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['object_type']) ? $_GET['object_type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $description = isset($_GET['description']) ? $_GET['description'] : '';

        $sql = <<<EOL
    SELECT id,title
    FROM videocards
    WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
        AND (:type ='all' OR type= :type)
        AND (:description = '' OR info_full like :description)
    EOL;

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("description",$description);

        $query->execute();

        $context['videocards'] = $query->fetchALL();

        return $context;
    }
}
