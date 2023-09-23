<?php
RequirePage::model("Stamp");
RequirePage::model("User");
RequirePage::model("Aspect");
RequirePage::model("Category");
RequirePage::model("StampCategory");


class ControllerStamp implements Controller {

    public function index() {
        $stamp = new Stamp;
        $data["stamps"] = $stamp->read();

        Twig::render("stamp-index.php", $data);
    }

    public function create() {
        if(isset($_SESSION["fingerPrint"])) $data["session_user"] = $_SESSION;

        $aspect = new Aspect;
        $data["aspects"] = $aspect->read();

        $category = new Category;
        $data["categories"] = $category->read();

        $user = new User;
        $data["users"] = $user->read();

        Twig::render("stamp-create.php", $data);
    }
    
    public function store() {
        print_r($_POST["categories"]);
        die();


        $stamp = new Stamp;
        $_POST["year"] = intval($_POST["year"]);
        $stamp_id = $stamp->create($_POST);


        foreach($_POST["category_id"] as $category_id => $category){
            $stampCategory = new StampCategory;
            $stampCategory->create([ "stamp_id" => $stamp_id, "category_id" => $category_id]);
        }
        RequirePage::redirect('stamp/show/'. $stamp_id);
    }

    public function show($id) {
        $categories = [];
        $stamp = new Stamp;
        $readStamp = $stamp->readId($id);
        $data["stamp"] = $readStamp;

        $aspect = new Aspect;
        $data["aspect"] = $aspect->readId($readStamp["aspect_id"]);

        $stampCategories = new StampCategory;
        if($stampCategories->readKeys($readStamp["id"])) {
            $readStampCategories = $stampCategories->readKeys($readStamp["id"]);
            foreach($readStampCategories as $stampCategory) {
                $category = new Category;
                $data["categories"][] = $category->readId($stampCategory["category_id"]);
            }
        }
        Twig::render("stamp-show.php", $data);
    }

    public function edit() {
        if(!$_POST){
            RequirePage::redirect("error");
            exit();
        }
        $id = $_POST["id"];
        $stamp = new stamp; 
        $data["stamp"] = $stamp->readId($id);
        Twig::render("stamp-edit.php", $data);
    }

    public function update() {
        $client = new Client;
        $updatedId = $client->update($_POST);
        if($updatedId) RequirePage::redirect('client/show/'. $updatedId);
        else print_r($updatedId);
    }
}