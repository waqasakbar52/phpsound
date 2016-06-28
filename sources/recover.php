<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;

	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$verify = $loggedIn->verify();
		
		// If the user is logged in, do not allow him to see this page.
		if($verify['username']) {
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
	}

	// New instance of Recover class
	$recover = new recover();
	$recover->db = $db;
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('recover/username'); $rows = '';
	$TMPL['url'] = $CONF['url'];
	$rows .= $skin->make();
	
	if(isset($_POST['username']) && empty($_POST['username'])) {
		header("Location: ".$CONF['url']."/index.php?a=recover&m=e");
	}
	elseif(isset($_POST['username']) && !empty($_POST['username'])) {
		$recover->username = $_POST['username'];
		
		// Save the Result into a list
		list($username, $email, $salted) = $recover->checkUser();		
		
		// If the POST username is the same with the result
		if(strtolower($_POST['username']) == $username || strtolower($_POST['username']) == $email) {
			
			// Send the recover e-mail		
			sendMail($email, $LNG['recover_mail'], sprintf($LNG['recover_content'], $username, $salted, $CONF['url'].'/index.php?a=recover&r=1', $CONF['url'].'/index.php?a=recover&r=1', $CONF['url'], $settings['title']), $CONF['email']);
			
			header("Location: ".$CONF['url']."/index.php?a=recover&r=1&m=s");
		} else {
			header("Location: ".$CONF['url']."/index.php?a=recover&m=e");
		}
	}
	
	// If there is any attempt of sending blank fields replace them.
	$key = str_replace(' ', '1', $_POST['k']);

	if(isset($_GET['r'])) {
		if(empty($_POST['n']) || empty($key) || (empty($_POST['u']) && empty($key))) {
			
			// Change the skin to empty
			$skin = new skin('recover/error'); $rows = '';
			
			$TMPL['url'] = $CONF['url'];
			
			$rows .= $skin->make();
		} elseif(isset($_POST['n']) && isset($key) && isset($_POST['p'])) {
			// Verify the password length
			if(strlen($_POST['p']) < 6) {
				header("Location: ".$CONF['url']."/index.php?a=recover&r=1&m=pf");
			} else {
				// Execut the changePassword function
				$changePassword = $recover->changePassword($_POST['n'], $_POST['p'], $_POST['k']);
				
				// If the password was changed
				if($changePassword) {
					header("Location: ".$CONF['url']."/index.php?a=recover&r=1&m=ps");
				} else {
					header("Location: ".$CONF['url']."/index.php?a=recover&r=1&m=wk");
				}
			}
		}
	}
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $rows;
	$TMPL['error'] = $error;
	
	if($_GET['m'] == 's') {
		$TMPL['message'] = notificationBox('info', $LNG['email_reset']);
	} elseif($_GET['m'] == 'e') {
		$TMPL['message'] = notificationBox('error', $LNG['username_not_found']);
	} elseif($_GET['m'] == 'wk') {
		$TMPL['message'] = notificationBox('error', $LNG['userkey_not_found']);
	} elseif($_GET['m'] == 'ps') {
		$TMPL['message'] = notificationBox('success', $LNG['password_reset']);
	} elseif($_GET['m'] == 'pf') {
		$TMPL['message'] = notificationBox('error', $LNG['password_too_short']);
	}
	
	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['password_recovery'].' - '.$settings['title'];

	$skin = new skin('recover/content');
	return $skin->make();
}
?>