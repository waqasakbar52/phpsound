<?php
include("../includes/config.php");
session_start();
if($_POST['token_id'] != $_SESSION['token_id']) {
	return false;
}
include("../includes/classes.php");
include(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");

$resultSettings = $db->query(getSettings());
$settings = $resultSettings->fetch_assoc();

if(isset($_SESSION['usernameAdmin']) && isset($_SESSION['passwordAdmin'])) {
	$loggedInAdmin = new loggedInAdmin();
	$loggedInAdmin->db = $db;
	$loggedInAdmin->url = $CONF['url'];
	$loggedInAdmin->username = $_SESSION['usernameAdmin'];
	$loggedInAdmin->password = $_SESSION['passwordAdmin'];
	$loggedIn = $loggedInAdmin->verify();

	if($loggedIn['username']) {
		$manageReports = new manageReports();
		$manageReports->db = $db;
		$manageReports->url = $CONF['url'];
		$manageReports->per_page = $settings['rperpage'];
		
		if(isset($_POST['start'])) {
			echo $manageReports->getReports($_POST['start']);
		}
	}
}
mysqli_close($db);
?>