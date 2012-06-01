<?php

	include 'includes/settings.php'; 
	include 'includes/mobile_detect.php'; 
	include 'includes/facebook.php';  

	//sklgjbsdkjgb

	$page = 'blank';
	$time = time();

	/* USER IS ON FACEBOOK */
	if($isfb == true) {

		/* PAGE IS LIKED */
		if($like != true){ 
			$page = 'like'; 
		} else {
			/* USER IS LOGGED INTO APP */
			if($fbuser != false){ 
				$page = 'info';
			}
		}
	}

	if(isset($_GET['page'])){ $page = $_GET['page']; } 

	/* TIME GATE FOR THE APP */
	// if (time() < strtotime('2012-02-05')) { $page = 'like'; }
	// if (time() > strtotime('2012-04-30')) { $page = 'closed'; }

	$page = $page.'.php';
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Title</title>

	<!-- Mobile viewport optimized: h5bp.com/viewport -->
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="css/style.css?v=<?=$v?>">
	<link rel="stylesheet" href="css/colorbox.css?v=<?=$v?>">

	<script>
	  // Load the SDK Asynchronously
	  (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
	   }(document));

	  window.fbAsyncInit = function() {
		FB.init({
		  appId      : '<?=$appId?>', // App ID
		  channelUrl : '//facebook.lightbox.ie/app/channel.html', // Channel File
		  status     : true, // check login status
		  cookie     : true, // enable cookies to allow the server to access the session
		  oauth      : true, // enable OAuth 2.0
		  xfbml      : true  // parse XFBML
		});
		
		/* CAUSES THE IFRAME TO RESIZE  */
		FB.Canvas.setAutoResize(100);
		FB.Canvas.scrollTo(0,0);

		<?php 
		if($fbuser == false){
		?>
				// listen for and handle auth.statusChange events
			    FB.Event.subscribe('auth.statusChange', function(response) {
			      if (response.authResponse) {
			        // user has auth'd your app
			      } else {
			        // user has not auth'd your app, or is not logged into Facebook
			        FB.login();
			      }
			    });
		<?
		}
		?>

		

		<?php if(isset($_GET['page']) && $_GET['page'] == 'thanks' ){ ?>
			FB.ui({
				method: 'feed',
				name: 'Name of app',
				link: '<?= $appUrl ?>',
				picture: 'http://facebook.lightbox.ie/app/imgs/50x50.jpg',
				caption: 'Caption',
				description: 'Description'			
			});
		<?php } ?>
	  };

	
	  </script>

</head>

<body id="<?=$language?>" class="<?=$stripped_page?>">

	<div id="container">
	
		<div class="main">
			<? include $page; ?>

		</div><!-- / main -->

</div><!-- / container -->


	<!-- LOAD JQUERY -->
	<script type="text/javascript" src="uploadify/jquery-1.4.2.min.js"></script>
	
	<!-- RUN COLORBOX -->
	<script src="js/jquery.colorbox-min.js?v=<?=$v?>" type="text/javascript"></script>
	<script type="text/javascript">
		/* BEGIN COLORBOX */  
		$(document).ready(function(){
			$('.element').colorbox();
		});
	</script>

	<!--[if IE]>
		<script type="text/javascript" src="js/placeholder.js'"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
	  <script type="text/javascript" src="js/selectivizr.js"></script>
	<![endif]-->

	<!-- FB ROOT DIV -->
	<div id="fb-root"></div>

	<!-- track pages -->
	<script type="text/javascript">

	  // var _gaq = _gaq || [];
	  // _gaq.push(['_setAccount', 'UA-2014879-77']);
	  // _gaq.push(['_trackPageview', '/tracking/<?= $stripped_page ?>']);

	  // (function() {
	  //   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	  //   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	  //   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  // })();

	</script>
</body>
</html>