<?php
RequirePage::model("User");
RequirePage::model("Stamp");


class ControllerUser implements Controller {

    public function index() {
        $user = new User;
        $read = $user->read();
        $data = ["users" => $read];
        Twig::render("user-index.php", $data);
    }

    public function create() {
        $city = new City;
        $read = $city->read();
        $data =  ["cities" => $read];
        Twig::render("User-create.php", $data);
    }

    public function delete() {
        $User = new User;
        $delete = $user->delete($_POST["id"]);
        if($delete) RequirePage::redirect("user");
        else print_r($delete);
    }
    
    public function store() {
        if(isset($_POST["city"])) {
            $city = new City;
            $cityId = $city->create($_POST);
            $_POST["city_id"] = $cityId;
        }
        $User = new User;
        $createdId = $User->create($_POST);
        RequirePage::redirect('User/show/'. $createdId);
    }

    public function show($id) {
        $User = new User;
        $readId = $User->readId($id);
        $data = ["User" => $readId];
        Twig::render("User-show.php", $data);
    }

    public function edit($id) {
        $User = new User; 
        $city = new City;
        $readCity = $city->read();
        $readId = $User->readId($id);
        $data = ["User" => $readId, "cities" => $readCity];
        Twig::render("User-edit.php", $data);
    }

    public function update() {
        $User = new User;
        $updatedId = $User->update($_POST);
        if($updatedId) RequirePage::redirect('User/show/'. $updatedId);
        else print_r($updatedId);
    }
}