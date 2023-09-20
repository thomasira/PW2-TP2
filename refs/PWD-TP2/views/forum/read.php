

<section>
    <article  class="article lrg">
        <h1><?= $data['title']?></h1>
        <p><?= $data['article']?></p>
        <div>
            <small><?= $data['name']?></small>
            <small><?= $data['date']?></small>
        </div>

        <?php
        
        if(!isset($_SESSION['fingerPrint'])) $data['id'] = NULL;
        else {
            if($_SESSION['userId'] == $data['user_id']) { ?>
                <a href="?module=forum&action=edit&id=<?= $data['id']?>" class="button">edit</a>
                <a href="?module=forum&action=delete&id=<?= $data['id']?>" class="button">delete</a>
            <?php } }?>
        
        <a href="index.php" class="button">back</a>
    </article>
</section>
