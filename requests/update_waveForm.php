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
//$db->set_charset("utf8");
if(isset($_REQUEST['fileid']) && isset($_REQUEST['png_Image'])){
	$query = "UPDATE `tracks` SET waveformpng = '{$_REQUEST['png_Image']}' WHERE gdfileid = '{$_REQUEST['fileid']}'";
	$resultSettings = $db->query(); 
}

mysqli_close($db);
?>