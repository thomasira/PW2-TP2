<?php
    $name = NULL;
    $msg = NULL;
    $success = NULL;
    if(isset($_SESSION['fingerPrint'])) $name = $_SESSION['name'];
    if(isset($_GET['msg'])){
        if($_GET['msg'] == 1){
        $msg = 'could not find the requested module';
        }
        if($_GET['msg'] == 2){
            $msg = 'could not find the requested action';
        }
        if($_GET['msg'] == 10){
            $msg = 'page not accessible';
        }
    }
?>
<div class="error"><strong><?= $msg?></strong></div>
<header>
    <h1>Welcome to the forum <strong><?=$name?></strong></h1>
</header>

<section>
    <h2>All articles</h2>
    <div class="flow-article">

    <?php
    foreach($data as $row) {
        $preview = substr($row['article'],0, 120).'...';
        ?>
        <article class="article">
            <h3><a href="?module=forum&action=show&id=<?= $row['id']?>"><?= $row['title']?></a></h3>
            <p><cite><?= $preview?></cite></p>
            <div>
                <small><?= $row['name']?></small>
                <small><?= $row['date']?></small>
            </div>
        </article>
    <?php } ?> 
    
    </div>
</section>