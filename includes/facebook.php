<?

session_start();

$config = array();
$config['appId'] = $appId;
$config['secret'] = $secret;


/* GET FACEBOOK WARMED UP */

include 'php-sdk/src/facebook.php';

$like = NULL;
$facebook_user = NULL;

$facebook = new Facebook($config);

if($mobile == 0){
	if(isset($_REQUEST['signed_request'])){
		$isfb = true;
		
		function parse_signed_request($signed_request, $secret) {
			list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

			// decode the data
			$sig = base64_url_decode($encoded_sig);
			$data = json_decode(base64_url_decode($payload), true);

			if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
				error_log('Unknown algorithm. Expected HMAC-SHA256');
				return null;
			}

			// check sig
			$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
			if ($sig !== $expected_sig) {
				error_log('Bad Signed JSON signature!');
				return null;
			}

			return $data;
		}

		function base64_url_decode($input) {
			return base64_decode(strtr($input, '-_', '+/'));
		}

		// GET LOGGED IN USER DETAILS
		$user = parse_signed_request($_REQUEST['signed_request'], $config['secret']);
		// var_dump($user);

		//GET PAGE ID
		if(isset($user['page']['id'])){
			$_SESSION['pageId'] = $user['page']['id'];
		} else {
			$_SESSION['pageId'] = false;
		}
		$pageId = $_SESSION['pageId'];

		$state = rand(100000, 999999);

		$redirectUrl = "https%3A%2F%2Fwww.facebook.com%2Fpages%2Fnull%2F$pageId%2Fapp_$appId";

		$loginUrl = urldecode("https://www.facebook.com/dialog/oauth?client_id=$appId&redirect_url=$redirectUrl&state=$state");

		// SEE IF PAGE IS LIKED
		if($user['page']['liked'] != NULL){
			$_SESSION['like'] = true;
		} else {
			$_SESSION['like'] = false;
		}

		$like = $_SESSION['like'];

		//GET USER LANGUAGE
		$locale = explode('_', $user['user']['locale']);
		$_SESSION['language'] = $locale[0];
		$language = $_SESSION['language'];	

		//GET USER ID
		if(isset($user['user_id'])){
			$_SESSION['fbuser'] = $user['user_id'];
		} else {
			$_SESSION['fbuser'] = false;
		}
		$fbuser = $_SESSION['fbuser'];

		//GET USER NAME
		if($fbuser != false){
			$user_info = json_decode(file_get_contents("http://graph.facebook.com/$fbuser"));
			$_SESSION['name'] = $user_info->name;
		} else {
			$_SESSION['name'] = false;
		}
		$name = $_SESSION['name'];

	} else {
		$isfb = false;
	}

	
} else {
	$isfb = false;
}


