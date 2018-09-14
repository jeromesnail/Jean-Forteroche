<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
        
    <body>
        <header>
        <?php
        if (isset($_SESSION['displayName'])) {
            ?>
            <div class="container">
                <nav class="nav nav-tabs">
                    <a class="nav-link active" href="#">Voir le blog</a>
                    <a class="nav-link" href="#">Tableau de bord</a>
                    <a class="nav-link" href="#">Nouveau chapitre</a>
                    <a class="nav-link" href="#">Commentaires</a>
                    <a class="nav-link float-right ml-auto" href="index.php?action=login">Déconnexion</a>
                </nav>
            </div>
            <?php
        }
        ?>
        </header>
        <div class="container">
        <?= $content ?>
        </div>
    </body>
</html>