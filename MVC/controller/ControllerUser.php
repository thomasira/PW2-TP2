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
        Twig::render("user-create.php");
    }

    public function delete() {
        $User = new User;
        $delete = $user->delete($_POST["id"]);
        if($delete) RequirePage::redirect("user");
        else print_r($delete);
    }
    
    public function store() {
        $user = new User;
        $salt = "7dh#9fj0K";
        $_POST["password"] = password_hash($_POST["password"] . $salt, PASSWORD_BCRYPT);
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

    public function profile() {
        if(!isset($_SESSION["user_id"])){
            RequirePage::redirect("error");
            exit();
        } 
        $id = $_SESSION["user_id"];
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->read($where);
        
        Twig::render("User-profile.php", $data);
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
        if($updatedId) RequirePage::redirect('user/show/'. $updatedId);
        else print_r($updatedId);
    }
}