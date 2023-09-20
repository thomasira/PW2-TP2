<?php

/**
 * calls database and renders info in home view
 */
function base_controller_index() {
    require_once(MODEL_DIR.'/forum.php');
    $data = forum_model_list();
    render(VIEW_DIR.'/base/welcome.php', $data);
}

?>