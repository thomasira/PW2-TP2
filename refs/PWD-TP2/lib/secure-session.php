<?php

if(!isset($_SESSION['fingerPrint']) OR $_SESSION['fingerPrint']!=md5($_SERVER[
'HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])){
    header("Location: ?module=login&msg=10");
    exit;
}
?>