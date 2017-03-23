<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="test.css">
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
	    		document.getElementById('status').innerHTML = 'We are connected.';
	    		document.getElementById('login').style.visibility = 'hidden';
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

	<div id="status"></div>
	<!-- <fb: class="btn" loggin-button onclick="getInfo()">Get Info</fb: loggin-button> -->
	<fb: class="btnbis" loggin-button scope="public_profile,email" onclick="login()" id="login">Ici c'est le nom de gars connecté !</fb: loggin-button>
	<div id="fb-root"></div>



	<div class="article">
		<div class="img">
			<img src="IMGP0969.jpg" alt="">
		<div id="shareBtn" class="btn btn-success clearfix"><span><img src="pouce.png" alt=""></span><span>Like</span><span class="count">0</span></div>
			<p>mon vélo ultra trop stylé tarba ! Tch-Tch</p>
		</div>
	</div>


	<p style="margin-top: 50px">
  		<hr />
  		<a class="btn btn-small"  href="https://developers.facebook.com/docs/sharing/reference/share-dialog">Share Dialog Documentation</a>
	</p>

	<script>
		document.getElementById('shareBtn').onclick = function() {
	  		FB.ui({
	    	method: 'share_open_graph',
	    	action_type: 'og.likes',
	    	action_properties: JSON.stringify({
	    	object:'http://www.monatest.esy.es/test.html',
	  		})
	  	}, function(response){});
		}
	</script>



	<div class="content-player">
        <div id="unityPlayer">
            <div class="missing">
                <a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
                    <img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
                </a>
            </div>
        </div>
    </div>
<script></script>
</body>
</html>