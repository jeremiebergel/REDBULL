<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="styles/style.css">
	<title>Custumise ton vélo</title>
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
</head>
<body class="config clearfix">
	<header>
		<h1><img src="img/logo.png"></h1>
        <a class="signin" href="#"><span class="color-red">Masis31</span></a>
		<a class="termes" href="#">Le Concours</a>
	</header>
	<h2>Crée ton vélo et valide ta création</h2>
	<ul class="compteur">
		<li class="mg-wrapper-days color-red"></li>
		<li class="mg-wrapper-hours color-red"></li>
		<li class="mg-wrapper-minuts color-red"></li>
		<li class="mg-wrapper-seconds color-red"></li>
	</ul>
	<div class="content-player">
        <div id="unityPlayer">
            <div class="missing">
                <a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
                    <img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
                </a>
            </div>
        </div>
    </div>
    <a class="valid" href="#">Valide ta création</a>

    <footer>
    	<nav>
    		<ul class="clearfix">
    			<li><a href="#"><img src="img/xgame.png" alt=""></a></li>
    			<li><a href="#">Politique de confidentialité</a></li>
    			<li><a href="#">Conditions Générales</a></li>
    			<li><a href="#">Mentions légales</a></li>
    			<li><a href="#">Contactez nous</a></li>
    		</ul>
    	</nav>
    </footer>
	<script src="js/main.js"></script>
</body>
</html>