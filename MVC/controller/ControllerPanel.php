<?php
RequirePage::model("Stamp");
RequirePage::model("User");
RequirePage::model("Aspect");
RequirePage::model("Category");

class ControllerPanel implements Controller {

    public function index() {

        if(SESSION_USER["username"] != 'root') {
            RequirePage::redirect("");
            exit();
        }

        $stamp = new Stamp;
        $read = $stamp->read();
        $data["stamps"] = $read;

        $user = new User;
        $read = $user->read();
        $data["users"] = $read;

        $category = new Category;
        $read = $category->read();
        $data["categories"] = $read;

        $aspect = new Aspect;
        $read = $aspect->read();
        $data["aspects"] = $read;

        Twig::render("panel-index.php", $data);
    }

}