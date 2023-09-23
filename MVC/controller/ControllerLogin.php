<?php
RequirePage::model("User");

class ControllerLogin implements Controller {

    public function index() {
        Twig::render("login-index.php");
    }

    public function logout() {
        session_destroy();
        RequirePage::redirect("");
    }
}

?>