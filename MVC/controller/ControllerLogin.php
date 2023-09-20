<?php
RequirePage::model("User");

class ControllerLogin implements Controller {

    public function index() {
        Twig::render("login-index.php");
    }
}