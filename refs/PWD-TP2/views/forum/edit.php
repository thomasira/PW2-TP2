<?php
$msg = NULL;
if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
        $msg = 'make sure you have a title(5 to 100 char) and an article(max 1000 char)';
    }
}
if (isset($data)) {
    foreach($data as $key => $value){
        $$key = $value;
    }
}
?>
<div class="error"><strong><?=$msg?></strong></div>
<form action="?module=forum&action=update" method="post">
    <h2>Edit</h2>
    <label>Title:  
        <input class="title" type="text" name="title" value="<?= $title?>">
    </label>
    <label class="text-box">Article: 
        <textarea type="text" name="article"  rows="4" cols="50"><?= $article?></textarea>
    </label>
    <input type="hidden" value="<?= $user_id?>" name="userId">
    <input type="hidden" value="<?= $id?>" name="id">
    <input type="hidden" value="<?= date("Y-m-d")?>" name="date">
    <input type="submit" value="edit" class="button">
    <a href="?module=user" class="button">back</a>
</form>
