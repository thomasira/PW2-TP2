<?php
RequirePage::model("Stamp");

class ControllerHome implements Controller {

    public function index() {
        $stamp = new Stamp;
        $read = $stamp->read();
        $data = ["stamps" => $read];
        Twig::render("home-index.php", $data);
    }

    public function error() {
        Twig::render("error.php");
    }
}