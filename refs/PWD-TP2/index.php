<?php
require_once('config/config.php');
require_once('lib/core.php'); 
require_once(CONNEX_DIR);
session_start();

$module = isset($_REQUEST['module']) ? safe($_REQUEST['module']) : $config['default_module'];
$action = isset($_REQUEST['action']) ? safe($_REQUEST['action']) : $config['default_action'];

$controller_file = 'controllers/'.ucfirst($module).'Controller.php';

if(!file_exists($controller_file)) {
    header("Location: ?msg=1");
    exit;
}
require_once($controller_file);

$function = strtolower($module).'_controller_'.$action;

if(!function_exists($function)) {
    header("Location: ?msg=2");
    exit;
}
call_user_func($function, $_REQUEST);

?>