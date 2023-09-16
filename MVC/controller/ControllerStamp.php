<?php
RequirePage::model("Stamp");
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
        $stamp = new Stamp;
        $readId = $stamp->readId($id);
        $data = ["stamp" => $readId];
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