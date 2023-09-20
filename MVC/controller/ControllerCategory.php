<?php
RequirePage::model("Category");

class ControllerCategory implements Controller {

    public function index() {
        $category = new Category;
        $data["categories"] = $category->read();
        
        Twig::render("category-index.php", $data);
    }

}