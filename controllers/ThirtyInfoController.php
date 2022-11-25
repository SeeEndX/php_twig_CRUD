<?php
require_once "ThirtyController.php";

class ThirtyInfoController extends ThirtyController {
    public $template = "rtx3090_info.twig";
    public $is_info = "";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 
        $is_info = "rtx3090/info";
        $context['is_info'] = $is_info;
        return $context;
    }
}
