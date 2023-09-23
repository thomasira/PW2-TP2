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
        if(isset($_SESSION["fingerPrint"]) && $_SESSION["name"] == "root") Twig::render("user-create.php");
        else RequirePage::redirect("error");
    }


    public function delete() {
        if(!isset($_SESSION["fingerPrint"]) ||
        $_SESSION["name"] != "root" ||
        !isset($_POST["id"])) {
            RequirePage::redirect("error");
        } else {
            $id = $_POST["id"];
            $user = new User;
            $data["user"] = $user->delete($id);
            RequirePage::redirect("user");
        }
    }
    

    public function store() {
        $user = new User;
        $salt = "7dh#9fj0K";
        $_POST["password"] = password_hash($_POST["password"] . $salt, PASSWORD_BCRYPT);
        $userId = $user->create($_POST);

        $_SESSION["id"] = $userId;
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["fingerPrint"] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        
        RequirePage::redirect("user/profile");
    }


    public function show($id) {
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->readWhere($where);
        
        Twig::render("user-show.php", $data);
    }


    public function profile() {
        if(!isset($_SESSION["fingerPrint"])) {
            RequirePage::redirect("error");
            exit();
        } 

        $id = $_SESSION["id"];
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->readWhere($where);
        
        Twig::render("user-profile.php", $data);
    }

    public function edit() {
        $id;
        if(!isset($_SESSION["fingerPrint"])){
            RequirePage::redirect("error");
            exit();
        }
        if($_SESSION["name"] == "root") $id = $_POST["id"];
        else $id = $_SESSION["id"];

        $user = new User;
        $data["user"] = $user->readId($id);
        Twig::render("user-edit.php", $data);
    }

    public function update() {
        if(!isset($_POST["id"])) RequirePage::redirect("error");
        $user = new User;
        $updatedId = $user->update($_POST);
        if($updatedId) {
            RequirePage::redirect('user/profile');
        }
        else print_r($updatedId);
    }

    public function auth() {
        $user = new User;
        $where = ["target" => "email", "value" => $_POST["email"]];
        $readUser = $user->readWhere($where);

        if(!$readUser) {
            $data["error"] = "no such account";
            Twig::render("login-index.php", $data);
            exit();
        }

        $readUser = $readUser[0];
        $password = $_POST["password"];
        $dbPassword = $readUser["password"];
        $salt = "7dh#9fj0K";

        if(password_verify($password.$salt, $dbPassword)){
            session_regenerate_id();
            $_SESSION["id"] = $readUser["id"];
            $_SESSION["name"] = $readUser["name"];
            $_SESSION["fingerPrint"] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
        } else {
            $data["error"] = "password not correct";
            Twig::render("login-index.php", $data);
            exit();
        }
        if($_SESSION["name"] == "root") RequirePage::redirect("panel");
        else RequirePage::redirect("user/profile");
    }
}