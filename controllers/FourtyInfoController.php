<?php
require_once "FourtyController.php";

class FourtyInfoController extends FourtyController {
    public $template = "rtx4090_info.twig";
    public $is_info = "";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 
        $is_info = "rtx4090/info";
        $context['is_info'] = $is_info;
        return $context;
    }
}
