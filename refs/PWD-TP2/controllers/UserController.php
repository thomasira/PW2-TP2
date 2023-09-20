<?php


/**
 * calls all 'my' articles into myArticles view
 */
function user_controller_index($request) {
    require_once(MODEL_DIR.'/forum.php');
    require(SECURE_DIR);
    $data = forum_model_myList($request);
    render(VIEW_DIR.'/user/myArticles.php', $data);
}


/**
 * prevents url injection, calls verification of existing username and validation of info, then stores data.
 */
function user_controller_create($request) {
    require_once(MODEL_DIR.'/user.php');
    if (validateUser($request)) {
        if (user_model_verifyUsername($request)) header("Location: ?module=login&msg=6");
        else {
            user_model_store($request);
            header("Location: ?module=login&succ=1");
        }
    } else header("Location: ?module=login&msg=5");
}
?>