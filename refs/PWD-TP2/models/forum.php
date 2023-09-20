<?php

/**
 * deletes an article from forum table where id is 'this' article and userId is session's userId
 */
function forum_model_delete($request){
    require(CONNEX_DIR);
    $id = $request['id'];
    $userId = $_SESSION['userId'];
    $sql = "DELETE FROM tp2_forum WHERE id = '$id' AND user_id = '$userId'";
    mysqli_query($connex, $sql);
}

/**
 * lists all articles++ where user_id is session's userId
 */
function forum_model_myList(){
    require(CONNEX_DIR);
    $sessionId = $_SESSION['userId'];
    $sql = "SELECT *, tp2_forum.id as id FROM tp2_forum INNER JOIN tp2_user ON tp2_user.id = tp2_forum.user_id WHERE user_id = '$sessionId' ORDER BY date desc";
    $result = mysqli_query($connex, $sql);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($connex);
    return $result;
}

function forum_model_userList(){
    require(CONNEX_DIR);
    $userId = $_SESSION['userId'];
    $sql = "SELECT *, tp2_forum.id as id FROM tp2_forum INNER JOIN tp2_user ON tp2_user.id = tp2_forum.user_id WHERE user_id = '$sessionId' ORDER BY date desc";
    $result = mysqli_query($connex, $sql);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($connex);
    return $result;
}

/**
 * show one article where id is 'this' article and user_id is session's userId
 * returns false if no match is found
 */
function forum_model_myShow($request){
    require(CONNEX_DIR);
    $id = $request['id'];
    $userId = $_SESSION['userId'];
    $sql = "SELECT *, tp2_forum.id as id FROM tp2_forum INNER JOIN tp2_user ON tp2_user.id = tp2_forum.user_id WHERE tp2_forum.id = '$id' AND user_id = '$userId'";
    $result = mysqli_query($connex, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount != 1) return false;
    else $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_close($connex);
    return $result;
}

/**
 * lists all articles++ from DB
 */
function forum_model_list(){
    require(CONNEX_DIR);
    $sql = "SELECT *, tp2_forum.id as id FROM tp2_forum INNER JOIN tp2_user ON tp2_user.id = tp2_forum.user_id ORDER BY date desc";
    $result = mysqli_query($connex, $sql);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($connex);
    return $result;
}

/**
 * shows one article where id is 'this' article
 * returns false if no match is found
 */
function forum_model_show($request){
    require(CONNEX_DIR);
    $id = $request['id'];
    $sql = "SELECT *, tp2_forum.id as id FROM tp2_forum INNER JOIN tp2_user ON tp2_user.id = tp2_forum.user_id WHERE tp2_forum.id = '$id'";
    $result = mysqli_query($connex, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount != 1) return false; 
    else $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
    mysqli_close($connex);
    return $result;
}

/**
 * stores inputs value into forum table
 */
function forum_model_store($request){
    require(CONNEX_DIR);
    foreach($request as $key => $value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    $userId = $_SESSION['userId'];
    $sql = "INSERT INTO tp2_forum(title, article, date, user_id) VALUES ('$title', '$article', '$date', '$userId')";
    mysqli_query($connex, $sql);
    mysqli_close($connex);
}

/**
 * updates inputs value in forum table where id is 'this' id.
 */
function forum_model_update($request){
    require(CONNEX_DIR);
    foreach($request as $key => $value){
        $$key = mysqli_real_escape_string($connex, $value);
    }
    $sql = "UPDATE tp2_forum SET title = '$title', article = '$article', date = '$date' WHERE id = '$id'";
    mysqli_query($connex, $sql);
    mysqli_close($connex);
}


?>
