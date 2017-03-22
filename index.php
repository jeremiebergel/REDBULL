<?php

echo 'test';
require_once "espacemembre/inc/functions.php";
// je démarre ma session
session_start();
 /*on se connecte à la BDD*/
require_once "espacemembre/inc/connect.php";

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

        $requete->bindValue(':password', sha1($_POST['password']), PDO::PARAM_STR);
        $requete->bindValue(":username", $_POST ['username']);
        $requete->bindValue(":email", $_POST ['email']);
        $requete->bindValue(":confirmation_token", $token, PDO::PARAM_STR);
        $requete->execute();
        $user_id = $pdo->lastInsertId();

        header('Location: login.php');
        mail($_POST['email'], 'confirmation de votre mail', "Afin de valider votre compte merci de cliquer sur ce lien\n\n http://localhost/confirm.php?id=$user_id&confirmation_token=$pop");
        $_SESSION['flash']['success'] = "Un email de confimation vous a été envoyé pour valider votre compte.";

        // Le script s'arrete à ce point là
        exit();


        // string password_hash ( string $password , integer $algo [, array $options ] )
        //fonction pour débugger les variables

    }

}?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CUSTOM YOUR BIKE</title>
	<link rel="stylesheet" href="styles/style.css">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        <!--
        var unityObjectUrl = "http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject2.js";
        if (document.location.protocol == 'https:')
            unityObjectUrl = unityObjectUrl.replace("http://", "https://ssl-");
        document.write('<script type="text\/javascript" src="' + unityObjectUrl + '"><\/script>');
        -->
    </script>
        <script type="text/javascript">
        var u = new UnityObject2();
        u.observeProgress(function (progress) {
            var $missingScreen = jQuery(progress.targetEl).find(".missing");
            switch(progress.pluginStatus) {
                case "unsupported":
                    showUnsupported();
                break;
                case "broken":
                    alert("You will need to restart your browser after installation.");
                break;
                case "missing":
                    $missingScreen.find("a").click(function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        u.installPlugin();
                        return false;
                    });
                    $missingScreen.show();
                break;
                case "installed":
                    $missingScreen.remove();
                break;
                case "first":
                break;
            }
        });
        jQuery(function(){
            u.initPlugin(jQuery("#unityPlayer")[0], "unity.unity3d");
        });
        </script>
        
        <meta property="og:url"	content="http://www.monatest.esy.es/test.html" />
  		<meta property="og:type" content="website" />
	  	<meta property="og:title" content="RedBull Event !" />	  
	  	<meta property="og:description" content="Custom ton Vélo" />
		<meta property="og:image" content="http://www.monatest.esy.es/test.html" />
</head>
<body>
	<script>
	window.fbAsyncInit = function() {
	FB.init({
	  appId      : '416561628691866',
	  xfbml      : true,
	  version    : 'v2.8'
	});
	FB.AppEvents.logPageView();
	};
	(function(d, s, id){
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) {return;}
	    js = d.createElement(s); js.id = id;
	    js.src = "//connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	
	// login with facebook with extra permissions
	function login() {
		FB.login(function(response) {
			if (response.status === 'connected') {
	    		// document.getElementById('status').innerHTML = 'We are connected.';
	    		document.getElementById('login').style.visibility = 'hidden';
	    		document.location = "http://monatest.esy.es/redbull/test.html";
	    	} else if (response.status === 'not_authorized') {
	    		document.getElementById('status').innerHTML = 'We are not logged in.'
	    	} else {
	    		document.getElementById('status').innerHTML = 'You are not logged into Facebook.';
	    	}
		}, {scope: 'email'});
	}
	
	// getting basic user info
	function getInfo() {
		FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id'}, function(response) {
			document.getElementById('status').innerHTML = response.id;
		});
	}
	</script>
	<header>
		<h1><img src="img/logo.png"></h1>
		<a href="#">Sign in</a>
	</header>

	<main>
		<div class="wrapper">
			<h2>Custom your bike</h2>
			<p>Win your bike & tickets for</p>
			<h3>X games-Minneapolis</h3>
			<p class="date">July 13th-16th, 2017</p>
			<p class="cta"><a href="#">Star your custom</a></p>
		</div>
		<div class="create-acc">
			BONJOUR
		</div>
	</main>

	<div class="wrapper-popup closed">
		<div class="popup">
			<img src="img/logo-black.png" alt="">
			<img class="cross" src="img/cross.svg">
			<p class="create">Créer votre compte</p>
			<input type="email" placeholder="e-mail">
			<input type="password" placeholder="mot de passe">
			<div class="checkbox">
				<input type="checkbox" id="keep"><label for="keep">Rester connecté</label>
				<p>Mot de passe oublié</p>
			</div>
			<a class="social connect" href="#">
				<p>Connexion</p>
			</a>
			<a class="social fb" href="#">
			
				<div><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z" fill="#fff" /></svg></div>
				<fb: class="btnbis" loggin-button scope="public_profile,email" onclick="login()" id="login"><p>FACEBOOK</p></fb: loggin-button>

				<div id="fb-root"></div>
			</a>
			<a class="social twitter" href="#">
				<div><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24" fill="#fff"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z" /></svg></div>
				<p>Twitter</p>
			</a>
		</div>
	</div>

	<footer>
		
	</footer>

	<script src="js/main.js"></script>
</body>
</html>