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
        Twig::render("User-create.php");
    }

    public function delete() {
        $User = new User;
        $delete = $user->delete($_POST["id"]);
        if($delete) RequirePage::redirect("user");
        else print_r($delete);
    }
    
    public function store() {
        $user = new User;
        $userId = $user->create($_POST);
        RequirePage::redirect('User/show/'. $userId);
    }

    public function show($id) {
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->read($where);
        
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