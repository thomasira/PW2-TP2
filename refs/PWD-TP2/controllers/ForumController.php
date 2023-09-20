<?php

/**
 * renders create forum view, requires login
 */
function forum_controller_create() {
    require(SECURE_DIR);
    render(VIEW_DIR.'/forum/create.php');
}

/**
 * requires login and prevents bad data in url, deletes article...
 */
function forum_controller_delete($request) {
    require(SECURE_DIR);
    require_once(MODEL_DIR.'/forum.php');
    if (!forum_model_myShow($request)) header("Location: ?msg=10");
    else {
        forum_model_delete($request);
        header("Location: ?module=user");
    }
}

/**
 * ...bis...renders data from db request into edit view
 */
function forum_controller_edit($request) {
    require(SECURE_DIR);
    require_once(MODEL_DIR.'/forum.php');
    if (!forum_model_myShow($request)) header("Location: ?msg=10");
    else {
        $data = forum_model_myShow($request);
        render(VIEW_DIR.'/forum/edit.php', $data);
    }
}

/**
 * ...bis...into read view
 */
function forum_controller_show($request) {
    require_once(MODEL_DIR.'/forum.php');
    if (!forum_model_show($request)) header("Location: ?msg=10");
    else{ 
        $data = forum_model_show($request);
        render(VIEW_DIR.'/forum/read.php', $data);
    }
}


/**
 * ...bis... and calls validation
 */
function forum_controller_store($request) {
    require(SECURE_DIR);
    require_once(MODEL_DIR.'/forum.php');
    if(!validateArticle($request)) header("Location: ?module=forum&action=create&msg=1");
    else {
        forum_model_store($request);
        header("Location: ?module=user");
    }
}

/**
 * ..bis...calls validation and redirects to 'this'  edit article if false
 */
function forum_controller_update($request) {
    $articleId = $request['id'];
    require_once(MODEL_DIR.'/forum.php');
    if (!forum_model_myShow($request)) header("Location: ?msg=10");
    else {
        if(!validateArticle($request)) header("Location: ?module=forum&action=edit&id=$articleId&msg=1");
        else {
            forum_model_update($request);
            header("Location: ?module=user");
        } 
    }
}

?>