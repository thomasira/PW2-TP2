<?php
RequirePage::model("User");

class ControllerLogin implements Controller {

    public function index() {
        Twig::render("login-index.php");
    }
    
    public function auth() {
        $user = new USER;
        $where = ["target" => "email", "value" => $_POST["email"]];
        $readUser = $user->read($_POST);
        print_r($readUser);
        die();

    }
    function login_controller_auth($request) {
        require_once(MODEL_DIR.'/user.php');
        $state = user_model_auth($request);
        switch ($state) {
            case 0:
                header("Location: ?module=user");
                break;
            case 1:
                header("Location: ?module=login&msg=1");
                break;
            case 2:
                header("Location: ?module=login&msg=2");
                break;
            default:
                header("Location: ?module=login&msg=4");
        }
    }
}

function user_model_auth($request){
    require(CONNEX_DIR);
    $state = 1;
    if(!isset($request['password']) || !isset($request['username'])) return $state;
    foreach($request as $key => $value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    $sql = "SELECT * FROM tp2_user WHERE username = '$username'";
    $result = mysqli_query($connex, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount == 1) {
        $salt = '4das#Vsd90gfF';
        $user = mysqli_fetch_assoc($result);
        $dbPassword = $user['password'];
        if(password_verify($password.$salt, $dbPassword)){
            session_regenerate_id();
            $_SESSION['userId'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
            $state = 0;
        } else $state = 2;
    } else $state = 1;
    return $state;
}