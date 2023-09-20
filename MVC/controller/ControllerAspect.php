<?php
RequirePage::model("Aspect");

class ControllerAspect implements Controller {

    public function index() {
        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();
        
        Twig::render("aspect-index.php", $data);
    }

}