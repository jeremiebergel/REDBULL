<?php

require_once "inc/functions.php";
 /*on se connecte à la BDD*/
require_once "inc/connect.php";

// je vérifie si des données ont été postées, si cette variable n'est pas vide
// ça signifie que des données on bien été postées.
// et que nous sommes dans une phase de traitement.
if (!empty($_POST)){
    // je vérifie qu'il n'y a pas d'erreur de saisi dans le formulaire
    $errors = array();

// Enregistrement du pseudo
    if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "votre pseudo n'est pas valide (alphanumérique)";

    } else {
        // on va vérifier si on a n'a pas déjà un utilisateur qui a ce nom.
        $requete = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $requete->execute([$_POST['username']]);
        $user = $requete->fetch();
        if ($user){
            $errors['username'] = "Ce pseudo est déjà pris";
        }
    }
    // enregistrement du mail
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "votre mail n'est pas valide";

    } else {
        $requete = $pdo ->prepare('SELECT id FROM users WHERE email = ?');
        $requete->execute([$_POST['email']]);
        $user = $requete->fetch();
        if ($user){
            $errors['email'] = "Cet email est déjà pris.";

        }

    }

    if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $errors['password'] = "vous devez rentrer un mot de passe valide";
    }

// s'il n'y a pas d'erreur, je vais pouvoir envoyer mon formulaire
    if(empty($errors)){
        // requete pour ajouter des utilisateurs
        $sql = "INSERT INTO `users`(`username`, `email`, `password`, `confirmation_token`) VALUES (:username, :email, :password, :confirmation_token)";
        $token = str_random(60);
        $pop = $token;
        $requete = $pdo->prepare($sql);

        $requete->bindValue(':password', hash('sha512', $_POST['password']), PDO::PARAM_STR);
        $requete->bindValue(":username", $_POST ['username']);
        $requete->bindValue(":email", $_POST ['email']);
        $requete->bindValue(":confirmation_token", $token, PDO::PARAM_STR);
        $requete->execute();
        $user_id = $pdo->lastInsertId();

        mail($_POST['email'], 'confirmation de votre mail', "Afin de valider votre compte merci de cliquer sur ce lien\n\n http://localhost/inc/confirm.php?id=$user_id&confirmation_token=$pop");
        header('Location : inc/login.php');
        // Le script s'arrete à ce point là
        exit();


        // string password_hash ( string $password , integer $algo [, array $options ] )
        //fonction pour débugger les variables

    }

}?>

    <?php
        // je récupère mon header
        require "inc/header.php";
    ?>
    <h1>S'inscrire</h1>

    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
       <p>Vous n'avez pas rempli le formulaire</p>
         <ul>
        <?php foreach ($errors as $error): ?>
            <li> <?= $error; ?> </li>
        <?php endforeach; ?>
        </ul>
   </div>
    <?php endif; ?>

    <form action="" method="post">
<div class="form-group">

    <label for="">Pseudo</label>
    <input type="text" name="username" class="form-control"/>

</div>

    <div class="form-group">

        <label for="">email</label>
        <input type="text" name="email" clas="form-control"/>

    </div>

    <div class="form-group">

        <label for="">Mot de passe</label>
        <input type="password" name="password" clas="form-control"/>

    </div>
    <div class="form-group">

        <label for="">Confirmer votre mot de passe</label>
        <input type="password" name="password_confirm" clas="form-control"/>

    </div>

        <button type="submit" class="btn btn-primary">M'inscrire</button>

    </form>



<?php require "inc/footer.php";?>