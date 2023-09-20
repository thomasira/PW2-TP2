<?php
RequirePage::model("Aspect");

class ControllerAspect implements Controller {

    public function index() {
        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();
        
        Twig::render("aspect-index.php", $data);
    }

    public function create() {
        Twig::render("aspect-create.php");
    }

    public function store() {
        $aspect = new Aspect;
        $aspectId = $aspect->create($_POST);
        RequirePage::redirect("panel");
    }
}