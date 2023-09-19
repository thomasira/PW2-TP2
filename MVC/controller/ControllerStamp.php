<?php
RequirePage::model("Stamp");
RequirePage::model("User");
RequirePage::model("Aspect");
RequirePage::model("Category");
RequirePage::model("StampCategory");


class ControllerStamp implements Controller {

    public function index() {
        $stamp = new Stamp;
        $read = $stamp->read();
        $data = ["stamps" => $read];
        Twig::render("stamp-index.php", $data);
    }

    public function create() {
        Twig::render("client-create.php");
    }
    
    public function store() {
        $client = new Client;
        $createdId = $client->create($_POST);
        RequirePage::redirect('client/show/'. $createdId);
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

    public function edit($id) {
        $client = new Client; 
        $readId = $client->readId($id);
        $data = ["client" => $readId];
        Twig::render("client-edit.php", $data);
    }

    public function update() {
        $client = new Client;
        $updatedId = $client->update($_POST);
        if($updatedId) RequirePage::redirect('client/show/'. $updatedId);
        else print_r($updatedId);
    }
}