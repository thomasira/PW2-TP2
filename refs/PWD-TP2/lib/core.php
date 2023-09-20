<?php


/**
 * calls a render of $content and $file into view
 */
function render($file, $data = null) {

    $layout_file = VIEW_DIR.'/layouts/layout.php';
    ob_start();
    include_once($file);
    $content = ob_get_clean();
    include_once($layout_file);
}

/**
 * add slashes to prevents bad injection in URL
 */
function safe($param) {

    return addslashes($param);
}

/**
 * validates article inputs value
 */
function validateArticle($request) {
    if (!isset($request['title']) || !isset($request['article'])) return false;
    foreach($request as $key => $value){
        if($key == 'title'){
            if(strlen($value)< 5 || strlen($value)>100) return false;
        } elseif($key == 'article') {
            if(strlen($value) > 1000 || strlen($value) == 0) return false;
        }
    }
    return true;
}

/**
 * validates date format
 */
function validateDate($date){
    if (preg_match ("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date, $parts)) {
        if(checkdate($parts[2],$parts[3],$parts[1])) {

            return false;

        } else {

            return true;
        } 

    }else{

        return true;
    }
}

/**
 * validates create user form inputs value
 */
function validateUser($request) {
    if (!isset($request['name']) ||
    !isset($request['username']) ||
    !isset($request['password'])
    ) return false;
    foreach($request as $key => $value){
        if ($key == 'name') {
            if (strlen($value)>=2 && strlen($value)<=25) {
                if (!preg_match("/^[a-zA-Z\s]*$/", $value)) return false;
            } else return false;
        }
        elseif ($key == 'username') {
            if (strlen($value) == 0) return false;
            else {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) return false;
            }
        }
        elseif ($key == 'dob') {
            if (strlen($value) != 0) {
                if (validateDate($value)) return false;
            }
        }
        elseif ($key == 'password') {
            if (strlen($value)>=6 && strlen($value)<=20) {
                if (!preg_match("/^(?:[0-9]+[a-z]|[a-z]+[0-9])[a-z0-9]*$/", $value)) return false;
            } else return false;      
        }
    }
    return true;
}


?>