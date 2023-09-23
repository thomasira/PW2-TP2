<?php
RequirePage::model("User");

class ControllerLogin implements Controller {

    public function index() {
        if(!isset($_SESSION["fingerPrint"])) Twig::render("login-index.php");
        else RequirePage::redirect("error");
        
    }

    public function logout() {
        session_destroy();
        RequirePage::redirect("");
    }
}

?>