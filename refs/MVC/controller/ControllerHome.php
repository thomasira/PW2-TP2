<?php

class ControllerHome implements Controller {

    public function index() {
        $data = ["name" => "Peter"];
        Twig::render("home-index.php", $data);
    }

    public function error() {
        Twig::render("error.php");
    }
}