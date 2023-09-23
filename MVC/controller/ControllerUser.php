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
        if(SESSION_USER && SESSION_USER["username"] != "root") RequirePage::redirect("error");
        else Twig::render("user-create.php");
    }

    public function delete() {
        if(!SESSION_USER ||
        SESSION_USER["username"] != "root" ||
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

        $_SESSION["user_id"] = $userId;
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
        if(!SESSION_USER) {
            RequirePage::redirect("error");
            exit();
        } 
        if(SESSION_USER["username"] == "root") {
            RequirePage::redirect("panel");
            exit();
        }

        $id = SESSION_USER["id"];
        $user = new User;
        $data["user"] = $user->readId($id);

        $stamp = new Stamp;
        $where = ["target" => "user_id", "value" => $data["user"]["id"]];
        $data["stamps"] = $stamp->readWhere($where);
        
        Twig::render("user-profile.php", $data);
    }

    public function edit() {
        $id;
        if(!SESSION_USER){
            RequirePage::redirect("error");
            exit();
        }
        if(SESSION_USER["username"] == "root") $id = $_POST["id"];
        else $id = SESSION_USER["id"];

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