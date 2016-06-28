<?php
session_start();
ini_set('display_errors','on'); version_compare(PHP_VERSION, '5.5.0') <= 0 ? error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED) : error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);   // DEBUGGING

require_once('./includes/config.php');
require_once('./includes/skins.php');
require_once('./includes/classes.php');
require_once('info.php');
require_once(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), null));
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

if(isset($_GET['a']) && isset($action[$_GET['a']])) {
	$page_name = $action[$_GET['a']];
} else {
	$page_name = 'welcome';
}

$TMPL['token_id'] = generateToken();

// Extra class for the content [main and sidebar]
$TMPL['content_class'] = ' content-'.$page_name;

$resultSettings = $db->query(getSettings());

// Verify whether the user imported the database or not
if($resultSettings) {
	$settings = $resultSettings->fetch_assoc();
} else {
	echo "Error: ".$db->error;
}

require_once("./sources/{$page_name}.php");

// Store the theme path and theme name into the CONF and TMPL
$TMPL['theme_path'] = $CONF['theme_path'];
$TMPL['theme_name'] = $CONF['theme_name'] = $settings['theme'];
$TMPL['theme_url'] = $CONF['theme_url'] = $CONF['theme_path'].'/'.$CONF['theme_name'];

$TMPL['volume'] = $settings['volume'];
$TMPL['supplied_formats'] = $settings['trackformat'];
$TMPL['site_title'] = $settings['title'];

if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
	$loggedIn = new loggedIn();
	$loggedIn->db = $db;
	$loggedIn->url = $CONF['url'];
	$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
	$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
	
	$verify = $loggedIn->verify();
}

$TMPL['content'] = PageMain();

if(!empty($verify['username'])) {
	$TMPL['menu'] = menu($verify);
	$TMPL['menu_buttons'] = menuButtons($verify);
	$TMPL['url_menu'] = $CONF['url'].'/index.php?a=stream';
} else {
	$TMPL['menu'] = menu(false);
	$TMPL['menu_buttons'] = menuButtons(false);
	$TMPL['url_menu'] = $CONF['url'].'/index.php?a=welcome';
}

if($settings['captcha']) {
	// Captcha
	$TMPL['captcha'] = '<div class="modal-captcha"><input type="text" name="captcha" placeholder="'.$LNG['captcha'].'"></div>
	<span class="register-captcha" id="captcha-register"><img src="'.$CONF['url'].'/includes/captcha.php" /></span>';
}
if($settings['fbapp']) {
	// Generate a session to prevent CSFR
	$_SESSION['state'] = md5(uniqid(rand(), TRUE));
	
	// Facebook Login Url
	$TMPL['fblogin'] = '<div class="modal-btn modal-btn-facebook"><a href="https://www.facebook.com/dialog/oauth?client_id='.$settings['fbappid'].'&redirect_uri='.$CONF['url'].'/requests/connect.php?facebook=true&state='.$_SESSION['state'].'&scope=public_profile,email" class="facebook-button">Facebook</a></div>';
}

$TMPL['url'] = $CONF['url'];
$TMPL['year'] = date('Y');
$TMPL['powered_by'] = 'Powered by <a href="'.$url.'" target="_blank">'.$name.'</a>.';
$TMPL['language'] = getLanguage($CONF['url'], null, 1);
$TMPL['tracking_code'] = $settings['tracking_code'];

$skin = new skin('wrapper');

echo $skin->make();

mysqli_close($db);
?>