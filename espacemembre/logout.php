<?php
// Dedémarre la session
session_start();

// on supprime la partie d'authentification
unset($_SESSION['authentification']);

// on stock un message flash
$_SESSION['flash']['success'] = 'vous êtes maintenant déconnecté ';



header('Location : login.php');