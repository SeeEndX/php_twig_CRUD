<?php
require_once "TwigBaseController.php";

class FourtyController extends TwigBaseController {
    public $template = "object.twig";
    public $title = "Nvidia RTX 4090";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['url_title'] = "rtx4090";
        return $context;
    }
}
