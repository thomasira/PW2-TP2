<?php
RequirePage::model("Aspect");
RequirePage::model("Stamp");


class ControllerAspect implements Controller {
    
    /**
     * rediriger ver la page index
     */
    public function index() {
        RequirePage::redirect("error");
    }

    public function create() {
        if(!isset($_SESSION["fingerPrint"]) || $_SESSION["name"] != "root") RequirePage::redirect("error");
        else Twig::render("aspect-create.php");
    }

    public function delete() {
        if(!isset($_SESSION["fingerPrint"]) ||
        $_SESSION["name"] != "root" ||
        !isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {
            $id = $_POST["id"];

            $stamp = new Stamp;
            $where["target"] = "aspect_id";
            $where["value"] = $id;
            $stamps = $stamp->readWhere($where);
            foreach($stamps as $stamp) {
                $data["aspect_id"] = null;
                $data["id"] = $stamp["id"];
                $stamp = new Stamp;
                $stamp->update($data);
            }

            $aspect = new Aspect;
            $aspect->delete($id);
            RequirePage::redirect("panel");
        }
    }

    public function edit() {
        if(!isset($_SESSION["fingerPrint"]) ||
        $_SESSION["name"] != "root" ||
        !isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {
            $id = $_POST["id"];
            $aspect = new Aspect;
            $data["aspect"] = $aspect->readId($id);
            Twig::render("aspect-edit.php", $data);
        }
    }

    public function store() {
        if(!isset($_POST["aspect"])) RequirePage::redirect("error");
        else {
            $aspect = new Aspect;
            $aspect->create($_POST);
            RequirePage::redirect("panel");
        }
    }

    public function update() {
        if(!isset($_POST["aspect"])) RequirePage::redirect("error");
        else {
            $aspect = new Aspect;
            $aspect->update($_POST);
            RequirePage::redirect("panel");
        }
    }
}