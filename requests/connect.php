<?php
include("../includes/config.php");
include("../includes/classes.php");
require_once(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
session_start();
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings()); 
$settings = $resultSettings->fetch_assoc();

// The theme complete url
$CONF['theme_url'] = $CONF['theme_path'].'/'.$settings['theme'];

if(isset($_GET['facebook']) && $settings['fbappid']) {
	$reg = new register();
	$reg->db = $db;
	$reg->url = $CONF['url'];
	$reg->email_register = $settings['mail'];
	$reg->like_notification = $settings['notificationl'];
	$reg->comment_notification = $settings['notificationc'];
	$reg->chat_notification = $settings['notificationd'];
	$reg->friend_notification = $settings['notificationf'];
	$reg->email_like = $settings['email_like'];
	$reg->email_comment = $settings['email_comment'];
	$reg->email_new_friend = $settings['email_new_friend'];
	$reg->fbapp = $settings['fbapp'];
	$reg->fbappid = $settings['fbappid'];
	$reg->fbappsecret = $settings['fbappsecret'];
	$reg->fbcode = $_GET['code'];
	$reg->fbstate = $_GET['state'];
	$process = $reg->facebook();
	
	if($process == 1) {
		if($settings['mail']) {
			sendMail($reg->email, sprintf($LNG['welcome_mail'], $settings['title']), sprintf($LNG['user_created'], $settings['title'], $reg->username, $reg->password, $CONF['url'], $settings['title'], $CONF['url'], $settings['title']), $CONF['email']);
		}
		header("Location: ".$CONF['url']);
	}
}
if(isset($_POST['register'])) {
	// Register usage
	$reg = new register();
	$reg->db = $db;
	$reg->url = $CONF['url'];
	$reg->username = $_POST['username'];
	$reg->password = $_POST['password'];
	$reg->email = $_POST['email'];
	$reg->captcha = $_POST['captcha'];
	$reg->captcha_on = $settings['captcha'];
	$reg->like_notification = $settings['notificationl'];
	$reg->comment_notification = $settings['notificationc'];
	$reg->chat_notification = $settings['notificationd'];
	$reg->friend_notification = $settings['notificationf'];
	$reg->email_like = $settings['email_like'];
	$reg->email_comment = $settings['email_comment'];
	$reg->email_new_friend = $settings['email_new_friend'];
	$reg->accounts_per_ip = $settings['aperip'];
	
	$process = $reg->process();
	
	if($process == 1) {
		if($settings['mail']) {
			sendMail($_POST['email'], sprintf($LNG['welcome_mail'], $settings['title']), sprintf($LNG['user_created'], $settings['title'], $_POST['username'], $_POST['password'], $CONF['url'], $settings['title'], $CONF['url'], $settings['title']), $CONF['email']);
		}
	}
	echo $process;
}

if(isset($_POST['login'])) {
	// Log-in usage
	$log = new logIn();
	$log->db = $db;
	$log->url = $CONF['url'];
	$log->username = $_POST['username'];
	$log->password = $_POST['password'];
	$log->remember = $_POST['remember'];
	
	$process = $log->in();
	echo $process;
}
mysqli_close($db);
?>