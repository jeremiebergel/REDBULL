<?php
    require 'inc/functions.php';
    only_connected_people();
    require 'inc/header.php';
    require_once 'inc/connect.php';
    $requete= $pdo->prepare('SELECT `id`, `username`, `email`, `password` FROM `users` WHERE 1');

    // On éxécute la requete SQL
    $requete->execute();

    while($row = $requete->fetch(PDO::FETCH_ASSOC)):

// On stock le résultat de la requete SQL dans une variable qu'on va réutilisé pour afficher les
// index de notre requete EX: Id, nom, prenom agge
?>


    <h1>Bonjour <?=$row['username']?></h1>

<?php endwhile; ?>

<?php require 'inc/footer.php'; ?>