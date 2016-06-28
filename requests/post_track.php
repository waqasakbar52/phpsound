<?php
include("../includes/config.php");
session_start();
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}
include("../includes/classes.php");
require_once(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings()); 
$settings = $resultSettings->fetch_assoc();

// The theme complete url
$CONF['theme_url'] = $CONF['theme_path'].'/'.$settings['theme'];

// If message is not empty
if(!empty($_POST)) {
	if($_POST['error']) {
		if($_POST['desc']) {
			$err[] = array(6, 5000);
		}
		if($_POST['buy']) {
			$err[] = array(7);
		}
		if($_POST['tag_max']) {
			$err[] = array(8, 30);
		}
		if($_POST['tag_min']) {
			$err[] = array(9, 1);
		}
		if($_POST['ttl_min']) {
			$err[] = array(10);
		}
		if($_POST['ttl_max']) {
			$err[] = array(11, 100);
		}
		
		foreach($err as $error) {
			$message .= notificationBox('error', sprintf($LNG["{$error[0]}_upload_err"], ((isset($error[1])) ? $error[1] : ''), ((isset($error[2])) ? $error[2] : '')));
		}
		
		$update = array($message);
	} else {
		// If the user have session or cookie set
		if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
			$loggedIn = new loggedIn();
			$loggedIn->db = $db;
			$loggedIn->url = $CONF['url'];
			$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
			$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
			
			$verify = $loggedIn->verify();
			
			// If user is authed successfully
			if($verify['username']) {
				$feed = new feed();
				$feed->db = $db;
				$feed->url = $CONF['url'];
				$feed->user = $verify;
				$feed->id = $verify['idu'];
				$feed->username = $verify['username'];
				$feed->per_page = $settings['perpage'];
				$feed->art_size = $settings['artsize'];
				$feed->art_format = $settings['artformat'];
				$feed->paypalapp = $settings['paypalapp'];
				$feed->track_size_total = ($feed->getProStatus($feed->id, 1) ? $settings['protracktotal'] : $settings['tracksizetotal']);
				$feed->track_size = ($feed->getProStatus($feed->id, 1) ? $settings['protracksize'] : $settings['tracksize']);
				$feed->track_format = $settings['trackformat'];
				$feed->time = $settings['time'];
				
				$update = $feed->updateTrack($_POST, 1);
			}
		}
	}
}
echo json_encode(array("result" => (strpos($update[0], 'notification-box-error') > 0 ? 0 : 1), "message" => $update[0]));
mysqli_close($db);
?>