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
		$manageCategories = new manageCategories();
		$manageCategories->db = $db;
		$manageCategories->url = $CONF['url'];
		
		if($_POST['type'] == 1 && !empty($_POST['id'])) {
			echo $manageCategories->addCategory($_POST['id']);
		} elseif($_POST['type'] == 0 && !empty($_POST['id'])) {
			echo $manageCategories->deleteCategory($_POST['id']);
		}
	}
}
mysqli_close($db);
?>