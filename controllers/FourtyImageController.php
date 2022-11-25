<?php
require_once "FourtyController.php";

class FourtyImageController extends FourtyController {
    public $template = "object_image.twig";
    public $is_image = "";

    public function getContext(): array
    {   
        $is_image = "rtx4090/image";
        $context = parent::getContext();
        $context['image_url'] = "/images/rtx4090.png";
        $context['is_image'] = $is_image;
        return $context;
    }
}
