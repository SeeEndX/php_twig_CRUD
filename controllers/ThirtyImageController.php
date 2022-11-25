<?php
require_once "ThirtyController.php";

class ThirtyImageController extends ThirtyController {
    public $template = "object_image.twig";
    public $is_image = "";

    public function getContext(): array
    {   
        $is_image = "rtx3090/image";
        $context = parent::getContext();
        $context['image_url'] = "/images/rtx3090.png";
        $context['is_image'] = $is_image;
        return $context;
    }
}
