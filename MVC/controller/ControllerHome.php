<?php
RequirePage::model("Stamp");

class ControllerHome implements Controller {

    public function index() {
        $stamp = new Stamp;
        $data["stamps"] = $stamp->read();
        
        Twig::render("home-index.php", $data);
    }

    public function error() {
        Twig::render("error.php");
    }
}