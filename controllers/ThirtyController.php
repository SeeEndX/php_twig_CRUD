<?php
require_once "TwigBaseController.php";

class ThirtyController extends TwigBaseController {
    public $template = "object.twig";
    public $title = "Nvidia RTX 3090";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['url_title'] = "rtx3090";
        return $context;
    }
}
