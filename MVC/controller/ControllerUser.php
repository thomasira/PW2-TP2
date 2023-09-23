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
        RequirePage::redirect('user/show/'. $userId);
    }

    public function show($id) {
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->read($where);
        
        Twig::render("user-show.php", $data);
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
        
        Twig::render("user-profile.php", $data);
    }

    public function edit($id) {
        $User = new User; 
        $city = new City;
        $readCity = $city->read();
        $readId = $User->readId($id);
        $data = ["User" => $readId, "cities" => $readCity];
        Twig::render("user-edit.php", $data);
    }

    public function update() {
        $User = new User;
        $updatedId = $User->update($_POST);
        if($updatedId) RequirePage::redirect('user/show/'. $updatedId);
        else print_r($updatedId);
    }

    public function auth() {
        $user = new User;
        $where = ["target" => "email", "value" => $_POST["email"]];
        $readUser = $user->readWhere($where);

        if(!$readUser) {
            $data
            ["error"] = "no such account";
            Twig::render("login-index.php", $data);
            exit();
        }

        $readUser = $readUser[0];
        $password = $_POST["password"];
        $dbPassword = $readUser["password"];
        $salt = "7dh#9fj0K";

        if(password_verify($password.$salt, $dbPassword)){
            session_regenerate_id();
            $_SESSION["user_id"] = $readUser["id"];
            $_SESSION["name"] = $readUser["name"];
            $_SESSION["fingerPrint"] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        } else {
            $data["error"] = "password not correct";
            Twig::render("login-index.php", $data);
            exit();
        }
        RequirePage::redirect("user/profile");
    }
}