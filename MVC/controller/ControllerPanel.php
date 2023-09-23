<?php
RequirePage::model("Stamp");
RequirePage::model("User");
RequirePage::model("Aspect");
RequirePage::model("Category");

class ControllerPanel implements Controller {

    public function index() {

        if(!SESSION_USER || SESSION_USER["username"] != "root") {
            RequirePage::redirect("error");
            exit();
        }

        $stamp = new Stamp;
        $data["stamps"] = $stamp->read();

        $user = new User;
        $data["users"] = $user->read();

        $category = new Category;
        $data["categories"] = $category->read();

        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();

        Twig::render("panel-index.php", $data);
    }
}