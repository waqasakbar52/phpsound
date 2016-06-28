<?php
include("../includes/config.php");
session_start();
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}
include("../includes/classes.php");
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

if(in_array($_POST['type'], array('0', '1', '2', '3'))) {
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$loggedIn = new loggedIn();
		$loggedIn->db = $db;
		$loggedIn->url = $CONF['url'];
		$loggedIn->username = (isset($_SESSION['username'])) ? $_SESSION['username'] : $_COOKIE['username'];
		$loggedIn->password = (isset($_SESSION['password'])) ? $_SESSION['password'] : $_COOKIE['password'];
		
		$verify = $loggedIn->verify();

		if($verify['username']) {
			$feed = new feed();
			$feed->db = $db;
			$feed->url = $CONF['url'];
			$feed->username = $verify['username'];
			$feed->id = $verify['idu'];
			
			$result = $feed->delete($_POST['id'], $_POST['type']);
			if($result)
				echo 1;
			else
				echo 0;
		}
	}
}
mysqli_close($db);
?>