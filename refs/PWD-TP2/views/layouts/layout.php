
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="thomas aucoin-lo">
    <link rel="stylesheet" href="resources/style/main.css">
    <title>tp2-pwd</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="?module=user">My articles</a></li>
            <?php
            if(isset($_SESSION['fingerPrint'])) echo '<li><a href="?module=login&action=logout">Logout</a></li>';
            else echo '<li><a href="?module=login">Login</a></li>'; 
            ?>
        </ul>
    </nav>
    <main>
        
    <?php echo $content;?>

    </main>

<body>
</html>
