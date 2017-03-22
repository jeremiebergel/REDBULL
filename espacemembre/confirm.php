<?php
    require 'inc/connect.php';
    $user_id = $_GET['id'];
    $pop = $_GET['confirmation_token'];

    $requete = $pdo->prepare('SELECT confirmation_token FROM users WHERE id = ?');

    $requete->execute([$user_id]);
    $user = $requete->fetch();

    if($user && $user['confirmation_token'] == $pop){
        session_start();
        $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?')->execute([$user_id]);
        $_SESSION['authentification'] = $user;
        header('Location: account.php');

    } else {
        $_SESSION['flash']['danger'] = "Ce lien n\'est plus valide";

        header('Location: login.php');
    }