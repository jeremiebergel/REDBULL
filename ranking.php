<?php

// je recupere la page demandee
if (isset($_GET['users'])) {
    // j'ai la page demandee dans l'url
    $slug = $_GET['users'];
} else {
    // pas de page demandee, j'affiche la page par defaut
    $slug = 'index';
}
//$slug = $_GET['page'] ?? 'teletubbies';
// je selectionne les donnees dont j'ai besoin
// bind de la value de slug

require_once 'espacemembre/inc/functions.php';
require_once 'espacemembre/inc/connect.php';

$requete= $pdo->prepare('SELECT `id`, `username`, `email`, `password`, `img`, `like`, `partage` FROM `users` WHERE `slug` =:slug');

// On éxécute la requete SQL
$requete->execute();

while($row = $requete->fetch(PDO::FETCH_ASSOC)):
// On stock le résultat de la requete SQL dans une variable qu'on va réutilisé pour afficher les
// index de notre requete EX: Id, nom, prenom agge
    ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
</head>


<body class="connected">
    <div class="big-container">
        <header class="connected">
            <h1><img src="img/logo.png"></h1>
            <a href="#">Se Déconnecter</a>
            <a href="#">Masis31</a>

    </header>

    <main class="jb">
        <div class="container-small">
        </div>

        <div class="content-profil clearfix">
            <img class="arrow-left" src="img/back.png" alt="">


            <div class="profil-name">
                <h1>1<sup>er</sup></h1>
                <h3><?=$row['username']?></h3>
            </div>
            <div class="bike-info">
                <div class="mg-bike">
                    <img class="img-thumbnail" alt="" src="<?=$row['img']?>" data-holder-rendered="true">
                </div>
                <ul>
                    <li><a href="#"><img src="img/like.png" alt=""></a></li>
                    <li><a href="#"><img src="img/facebook_un.png" alt=""></a></li>
                    <li><a href="#"><img src="img/twitter_un.png" alt=""></a></li>
                </ul>
            </div>

            <div class="social-result">
                <div class="like">
                    <p class="social-p">LIKE</p>
                    <p class="social-n"><?=$row['like']?></p>
                </div>

                <div class="social-bar"></div>
                <div class="share">
                    <p class="social-p">PARTAGE</p>
                    <p class="social-n"><?=$row['partage']?></p>
                </div>
            </div>
            <img class="arrow-right" src="img/next.png" alt="">
        </div>

        <div class="ranking">
            <p>Classement général</p>
            <ul>
                <li class="clearfix">
                    <a href="#">1-  Masis31</a>
                    <p><img src="img/like.png" alt="">562</p>
                    <p><img src="img/share.png" alt="">45</p>
                </li>
                <li class="clearfix">
                    <a href="#">2-  Pauline</a>
                    <p><img src="img/like.png" alt="">339</p>
                    <p><img src="img/share.png" alt="">65</p>
                </li>
                <li class="clearfix">
                    <a href="#">3-  Jérémie</a>
                    <p><img src="img/like.png" alt="">351</p>
                    <p><img src="img/share.png" alt="">12</p>
                </li>
                <li class="clearfix">
                    <a href="#">4-  Mona</a>
                    <p><img src="img/like.png" alt="">209</p>
                    <p><img src="img/share.png" alt="">2</p>
                </li>
                <li class="clearfix">
                    <a href="#">5-  Ruben</a>
                    <p><img src="img/like.png" alt="">110</p>
                    <p><img src="img/share.png" alt="">1</p>
                </li>
                <li class="clearfix">
                    <a href="#">6-  Benchetrit</a>
                    <p><img src="img/like.png" alt="">102</p>
                    <p><img src="img/share.png" alt="">42</p>
                </li>
                <li class="clearfix">
                    <a href="#">7-  Cohen$$</a>
                    <p><img src="img/like.png" alt="">69</p>
                    <p><img src="img/share.png" alt="">51</p>
                </li>
                <li class="clearfix">
                    <a href="#">8-  Francis_L</a>
                    <p><img src="img/like.png" alt="">80</p>
                    <p><img src="img/share.png" alt="">2</p>
                </li>
                <li class="clearfix">
                    <a href="#">9-  Serge</a>
                    <p><img src="img/like.png" alt="">10</p>
                    <p><img src="img/share.png" alt="">2</p>
                </li>
                <li class="clearfix">
                    <a href="#">10-  Bensoussan</a>
                    <p><img src="img/like.png" alt="">10</p>
                    <p><img src="img/share.png" alt="">1</p>
                </li>
            </ul>
        </div>
        <?php endwhile; ?>
    </main>
</div>
</body>
</html>
