<?php
// est-ce que des données ont été posté
// est-ce qu'un username et un mot de passe ont été rentré
    if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){

        // si ces informations ont été saisies par l'utilisateur
        // on va faire appel à la BDD
        require_once 'inc/connect.php';
        session_start();
        // on exécute notre requete
        // Sélectionne le pseudo et l'email où l'utilisateur est égal au paramètre username
        $requete= $pdo->prepare('SELECT email, username, password FROM users WHERE ((username = :username OR email = :username) AND confirmed_at IS NOT NULL) AND password =:password');
        $requete->bindValue(":username", $_POST ['username']);
        $requete->bindValue(':password', sha1($_POST['password']), PDO::PARAM_STR);
        $requete->execute();
        $user = $requete->fetch();

        // je récupère l'utilisateur

        // on vérifie si le username du formulaire est égal au username de la BDD
        if($requete->rowCount() >=1) {

            $_SESSION['authentification'] = $user;

            $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";


            header('Location: account.php');

            exit();

        } else {
            $_SESSION['flash']['danger'] = 'identifiant ou mot de passe incorrect';
        };

}

?>
<?php require 'inc/header.php'; ?>

    <h1>Se connecter</h1>


    <form action="" method="post">
        <div class="form-group">

            <label for="">Pseudo ou email</label>
            <input type="text" name="username" class="form-control"/>

        </div>

        <div class="form-group">

            <label for="">Mot de passe <a href="forget.php">(J'ai oublié mon mot de passe)</a></label>
            <input type="password" name="password" class="form-control"/>

        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>

    </form>

<?php require 'inc/footer.php';?>