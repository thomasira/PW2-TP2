<?php
RequirePage::model("Category");
RequirePage::model("StampCategory");


class ControllerCategory implements Controller {

    public function index() {
        $category = new Category;
        $data["categories"] = $category->read();
        
        Twig::render("category-index.php", $data);
    }

    public function create() {
        if(!isset($_SESSION["fingerPrint"]) || $_SESSION["name"] != "root") RequirePage::redirect("error");
        else Twig::render("category-create.php");
    }

    public function delete() {
        if(!isset($_SESSION["fingerPrint"]) ||
        $_SESSION["name"] != "root" ||
        !isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {

            $cat_id = $_POST["id"];
            $category = new Category;

            $stampCategories = new StampCategory;
            $stampCategories->deleteStampCat(null, $cat_id);

            $category->delete($cat_id);
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
            $category = new Category;
            $data["category"] = $category->readId($id);
            Twig::render("category-edit.php", $data);
        }
    }

    public function store() {
        if(!isset($_POST["category"])) RequirePage::redirect("error");
        else {
            $category = new Category;
            $categoryId = $category->create($_POST);
            RequirePage::redirect("category");
        }
    }

    public function update() {
        if(!isset($_POST["category"])) RequirePage::redirect("error");
        else {
            $category = new Category;
            $category->update($_POST);
            RequirePage::redirect("panel");
        }
    }
}