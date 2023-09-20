

<header>
    <h1>Hello <?= $_SESSION['name']; ?></h1>
    <p>do you want to write an article today?</p>
    <a href="?module=forum&action=create" class="button">write article</a>
</header>
<section>
    <h2>My articles</h2>
    <div class="flow-article">
        
    <?php foreach($data as $row){ 
        $preview = substr($row['article'],0, 120).'...';?>

        <article class="article">
        <h3><a href="?module=forum&action=show&id=<?= $row['id']?>"><?= $row['title']?></a></h3>
            <p><cite><?= $preview?></cite></p>
            <small><?= $row['date']?></small>
            <aside>
                <a href="?module=forum&action=delete&id=<?= $row['id']?>" class="button">delete</a>
                <a href="?module=forum&action=edit&id=<?= $row['id']?>" class="button">edit</a>
            </aside>
        </article>
    <?php } ?> 

    </div>
</section>
