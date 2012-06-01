<?php

// add page http://www.facebook.com/dialog/pagetab?app_id=186432734794033&next=http://facebook.lightbox.ie/bolt/

$env = 'live';

if($env == 'local'){ $fbuser = '123';}

if($env == 'local'){
	/* FACEBOOK SETTINGS */

	// TEST SERVER
	$appId = '186432734794033';
	$secret = 'bab420c1981f31de7afebb690aced22c';
	$appUrl = 'https://www.facebook.com/pages/Digicel-Run-with-Bolt-Community/254555624624122?sk=app_186432734794033';
	$realUrl = 'http://bolt.tld/';

	
	/* DATABASE SETTINGS */
	
	// local server info
	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'bolt';
} else {

	/* ------ LIVE ------ */

	/* FACEBOOK SETTINGS */

	// TEST SERVER
	$appId = '186432734794033';
	$secret = 'bab420c1981f31de7afebb690aced22c';
	$appUrl = 'https://www.facebook.com/DigicelGroup/app_186432734794033';
	$realUrl = '//facebook.lightbox.ie/bolt/';

	
	/* DATABASE SETTINGS */

	// test server info
	$server = 'localhost';
	$user = 'bolt';
	$pass = 'puj4gaHe';
	$db = 'bolt';
}

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);

// // show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

$v=8;