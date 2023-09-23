<?php

class ViewLayout {
    static public function schoolHeader($title) { 
        ?>
        <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="author" content="Thomas Aucoin-Lo">
                <style>
                    <?php 
                    include "./style/layout/navigation.css";
                    include "./style/layout/structure.css";
                    include "./style/config/general.css";
                    include "./style/config/school-header.css";
                    include "./style/config/school-footer.css";
                    include "./style/class/error.css";
                    include "./style/class/button.css";
                    include "./style/class/icon.css";

                    ?>
                </style>
                <title><?= $title ?></title>
            </head>
            <body>
            <header>
                <h1>PW2-TP2</h1>
                <p>OOP | MVC</p>
            </header>
        <?php 
    } 


    static public function navigation() {
        ?>
        <nav>
            <a href="<?= ROOT ?>">HOME</a>
            <a href="<?= ROOT . "stamp" ?>">stamps</a>
            <a href="<?= ROOT . "user" ?>">users</a>
            <a href="<?= ROOT . "category" ?>">categories</a>
        <?php if(SESSION_USER && SESSION_USER["username"] == "root"): ?> 
            <a href="<?= ROOT . "panel" ?>">profile</a>
            <a href="<?= ROOT . "login/logout" ?>">logout</a>
        <?php elseif(SESSION_USER && SESSION_USER["username"]): ?>
            <a href="<?= ROOT . "panel" ?>">panel</a>
            <a href="<?= ROOT . "login/logout" ?>">logout</a>
        <?php else: ?>
            <a href="<?= ROOT . "login" ?>">login</a>
        <?php endif ?>
        </nav>
        <?php
    }

    
    static public function footer() { 
        ?>
            <footer>
                <h4>16-09-2023</h4>
                <div>
                    <p>Thomas Aucoin-Lo</p>
                    <p>e2395387</p>
                </div>
            </footer>
        </body>
        </html>
        <?php 
    }
}
?>