<?php

/**
 * calls auth script for login. switch case on result;
 */

function login_controller_index($request) {
    render(VIEW_DIR.'/login/login.php');
}

/**
 * logs out and redirects to home page
 */
function login_controller_logout() {
    session_destroy();
    header("Location: index.php");
}

/**
 * calls auth scripts
 */
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

?>