<?php

$msg = NULL;
if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
        $msg = 'make sure you have a title(5 to 100 char) and an article(max 1000 char)';
    }
}
?>
<div class="error"><strong><?=$msg?></strong></div>
<form action="?module=forum&action=store" method="post">
    
    <h2>New article</h2>
    <label>Title:  
        <input class="title" type="text" name="title" minlength="5" maxlength="20">
    </label>
    <label class="text-box">Article: 
        <textarea type="text" name="article" maxlength="1000"></textarea>
    </label>
    <input type="hidden" value='<?= date("Y-m-d") ?>' name="date">
    <input type="submit" value="create" class="button">
    <a href="?module=user" class="button">back</a>
</form>

