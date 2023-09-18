<?php
RequirePage::model("Client");
RequirePage::model("City");


class ControllerClient implements Controller {

    public function index() {
        $client = new Client;
        $read = $client->read();
        $data = ["clients" => $read];
        Twig::render("client-index.php", $data);
    }

    public function create() {
        $city = new City;
        $read = $city->read();
        $data =  ["cities" => $read];
        Twig::render("client-create.php", $data);
    }

    public function delete() {
        $client = new Client;
        $delete = $client->delete($_POST["id"]);
        if($delete) RequirePage::redirect("client");
        else print_r($delete);
    }
    
    public function store() {
        if(isset($_POST["city"])) {
            $city = new City;
            $cityId = $city->create($_POST);
            $_POST["city_id"] = $cityId;
        }
        $client = new Client;
        $createdId = $client->create($_POST);
        RequirePage::redirect('client/show/'. $createdId);
    }

    public function show($id) {
        $client = new Client;
        $readId = $client->readId($id);
        $data = ["client" => $readId];
        Twig::render("client-show.php", $data);
    }

    public function edit($id) {
        $client = new Client; 
        $city = new City;
        $readCity = $city->read();
        $readId = $client->readId($id);
        $data = ["client" => $readId, "cities" => $readCity];
        Twig::render("client-edit.php", $data);
    }

    public function update() {
        $client = new Client;
        $updatedId = $client->update($_POST);
        if($updatedId) RequirePage::redirect('client/show/'. $updatedId);
        else print_r($updatedId);
    }
}