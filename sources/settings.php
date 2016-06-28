<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	require_once('./includes/countries.php');
	
	unset($_POST['suspended']);
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if($verify['username']) {
			
			$TMPL_old = $TMPL; $TMPL = array();
			
			$TMPL['url'] = $CONF['url'];
			$TMPL['token_input'] = generateToken($_SESSION['token_id']);
			
			$updateUserSettings = new updateUserSettings();
			$updateUserSettings->db = $db;
			$updateUserSettings->id = $verify['idu'];
			$updateUserSettings->url = $CONF['url'];
			
			if($_GET['b'] == 'security') {
				$skin = new skin('settings/security'); $page = '';
				
				if(!empty($_POST)) {
					$TMPL['message'] = $updateUserSettings->query_array('users', $_POST);
				}
				
				$userSettings = $updateUserSettings->getSettings();
			} elseif($_GET['b'] == 'avatar') {
				$skin = new skin('settings/avatar'); $page = '';
				
				// Create the class instance
				$TMPL['image'] = '<img src="'.$CONF['url'].'/thumb.php?src='.$verify['image'].'&t=a" width="80" height="80" />';
				$TMPL['cover'] = '<img src="'.$CONF['url'].'/thumb.php?src='.$verify['cover'].'&t=c&w=900&h=200" />';
				
				$maxsize = $settings['size'];

				if(isset($_FILES['avatarselect']['name'])) {
					foreach ($_FILES['avatarselect']['error'] as $key => $error) {
						$ext = pathinfo($_FILES['avatarselect']['name'][$key], PATHINFO_EXTENSION);
						$size = $_FILES['avatarselect']['size'][$key];
						$allowedExt = explode(',', strtolower($settings['format']));
						
						// Get file type validation
						$image = validateFile($_FILES['avatarselect']['tmp_name'][$key], $_FILES['avatarselect']['name'][$key], $allowedExt, 0);
						
						if($image['valid'] && $size < $maxsize && $size > 0 && !empty($image['width']) && !empty($image['height'])) {
							$rand = mt_rand();
							$tmp_name = $_FILES['avatarselect']['tmp_name'][$key];
							$name = pathinfo($_FILES['avatarselect']['name'][$key], PATHINFO_FILENAME);
							$fullname = $_FILES['avatarselect']['name'][$key];
							$size = $_FILES['avatarselect']['size'][$key];
							$type = pathinfo($_FILES['avatarselect']['name'][$key], PATHINFO_EXTENSION);
							$finalName = mt_rand().'_'.mt_rand().'_'.mt_rand().'.'.$db->real_escape_string($ext);
							
							// Fix image orientation if possible
							imageOrientation($tmp_name);
							
							// Move the file into the uploaded folder
							move_uploaded_file($tmp_name, 'uploads/avatars/'.$finalName);
							
							// Delete the old image
							deleteImages(array($verify['image']), 1);

							// Send the image name in array format to the function
							$image = array('image' => $finalName, 'token_id' => $_POST['token_id']);
							$updateUserSettings->query_array('users', $image);
							
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=s");
						} elseif($_FILES['avatarselect']['name'][$key] == '') { 
							// If no file is selected
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=nf");
						} elseif($size > $maxsize || $size == 0) { 
							// If the file size is higher than allowed or 0
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=fs");
						} else { 
							// If the file format is not allowed
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=wf");
						}
					}
				}
				
				if(isset($_FILES['coverselect']['name'])) {
					foreach ($_FILES['coverselect']['error'] as $key => $error) {
						$ext = pathinfo($_FILES['coverselect']['name'][$key], PATHINFO_EXTENSION);
						$size = $_FILES['coverselect']['size'][$key];
						$allowedExt = explode(',', strtolower($settings['format']));
					
						// Get file type validation
						$image = validateFile($_FILES['coverselect']['tmp_name'][$key], $_FILES['coverselect']['name'][$key], $allowedExt, 0);
						
						if($image['valid'] && $size < $maxsize && $size > 0 && !empty($image['width']) && !empty($image['height'])) {
							$rand = mt_rand();
							$tmp_name = $_FILES['coverselect']['tmp_name'][$key];
							$name = pathinfo($_FILES['coverselect']['name'][$key], PATHINFO_FILENAME);
							$fullname = $_FILES['coverselect']['name'][$key];
							$size = $_FILES['coverselect']['size'][$key];
							$type = pathinfo($_FILES['coverselect']['name'][$key], PATHINFO_EXTENSION);
							$finalName = mt_rand().'_'.mt_rand().'_'.mt_rand().'.'.$db->real_escape_string($ext);
							
							// Fix image orientation if possible
							imageOrientation($tmp_name);
							
							// Move the file into the uploaded folder
							move_uploaded_file($tmp_name, 'uploads/covers/'.$finalName);
							
							// Delete the old image
							deleteImages(array($verify['cover']), 0);

							// Send the image name in array format to the function
							$image = array('cover' => $finalName, 'token_id' => $_POST['token_id']);
							$updateUserSettings->query_array('users', $image);
							
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=s");
						} elseif($_FILES['coverselect']['name'][$key] == '') { 
							// If no file is selected
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=nf");
						} elseif($size > $maxsize || $size == 0) { 
							// If the file size is higher than allowed or 0
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=fs");
						} else { 
							// If the file format is not allowed
							header("Location: ".$CONF['url']."/index.php?a=settings&b=avatar&m=wf");
						}
					}
				}

				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['profile_picture_saved']);
				} elseif($_GET['m'] == 'nf') {
					$TMPL['message'] = notificationBox('error', $LNG['no_file']);
				} elseif($_GET['m'] == 'fs') {
					$TMPL['message'] = notificationBox('error', sprintf($LNG['file_exceeded'], round($maxsize / 1048576, 2)));
				} elseif($_GET['m'] == 'wf') {
					$TMPL['message'] = notificationBox('error', sprintf($LNG['file_format'], $settings['format']));
				}
			} elseif($_GET['b'] == 'social') {
				$skin = new skin('settings/social'); $page = '';
				
				if(!empty($_POST)) {
					$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
				}
				
				$userSettings = $updateUserSettings->getSettings();
				
				$TMPL['currentFacebook'] = $userSettings['facebook']; $TMPL['currentTwitter'] = $userSettings['twitter'];  $TMPL['currentGplus'] = $userSettings['gplus']; $TMPL['currentYouTube'] = $userSettings['youtube']; $TMPL['currentSoundCloud'] = $userSettings['soundcloud']; $TMPL['currentLastfm'] = $userSettings['lastfm']; $TMPL['currentMySpace'] = $userSettings['myspace']; $TMPL['currentVimeo'] = $userSettings['vimeo']; $TMPL['currentTumblr'] = $userSettings['tumblr'];
			} elseif($_GET['b'] == 'notifications') {
				$skin = new skin('settings/notifications'); $page = '';
				
				if(!empty($_POST)) {
					$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
				}
				
				$userSettings = $updateUserSettings->getSettings();
				
				if($userSettings['notificationl'] == '0') {
					$TMPL['loff'] = 'selected="selected"';
				} else {
					$TMPL['lon'] = 'selected="selected"';
				}
				
				if($userSettings['notificationc'] == '0') {
					$TMPL['coff'] = 'selected="selected"';
				} else {
					$TMPL['con'] = 'selected="selected"';
				}
				
				if($userSettings['notificationd'] == '0') {
					$TMPL['doff'] = 'selected="selected"';
				} else {
					$TMPL['don'] = 'selected="selected"';
				}
				
				if($userSettings['notificationf'] == '0') {
					$TMPL['foff'] = 'selected="selected"';
				} else {
					$TMPL['fon'] = 'selected="selected"';
				}
				
				if($userSettings['email_comment'] == '0') {
					$TMPL['ecoff'] = 'selected="selected"';
				} else {
					$TMPL['econ'] = 'selected="selected"';
				}
				
				if($userSettings['email_like'] == '0') {
					$TMPL['eloff'] = 'selected="selected"';
				} else {
					$TMPL['elon'] = 'selected="selected"';
				}
				
				if($userSettings['email_new_friend'] == '0') {
					$TMPL['enfoff'] = 'selected="selected"';
				} else {
					$TMPL['enfon'] = 'selected="selected"';
				}
			} elseif($_GET['b'] == 'blocked') {
				$skin = new skin('settings/blocked'); $page = '';
				
				$TMPL['blocked_users'] = $updateUserSettings->getBlockedUsers();
			} else {
				$skin = new skin('settings/general'); $page = '';
				
				if(!empty($_POST)) {
					$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
				}
				
				$userSettings = $updateUserSettings->getSettings();
				
				$TMPL['countries'] = countries(1, $userSettings['country']);
				
				$TMPL['currentFirstName'] = $userSettings['first_name']; $TMPL['currentLastName'] = $userSettings['last_name']; $TMPL['currentEmail'] = $userSettings['email']; $TMPL['currentCity'] = $userSettings['city']; $TMPL['currentWebsite'] = $userSettings['website']; $TMPL['currentDescription'] = $userSettings['description'];
				if($userSettings['private'] == '1') {
					$TMPL['on'] = 'selected="selected"';
				} elseif($userSettings['private'] == '2') {
					$TMPL['semi'] = 'selected="selected"';
				} else {
					$TMPL['off'] = 'selected="selected"';
				}
				
				if($userSettings['offline'] == '1') {
					$TMPL['con'] = 'selected="selected"';
				} else {
					$TMPL['coff'] = 'selected="selected"';
				}
			}
			$page .= $skin->make();
			
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['settings'] = $page;
			
		} else {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
	} else {
		// If the session or cookies are not set, redirect to home-page
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}	
	
	// Start the sidebar menu
	if(isset($_GET['b'])) {
		$TMPL['welcome'] = $LNG["user_ttl_{$_GET['b']}"];
	} else {
		$TMPL['welcome'] = $LNG["user_ttl_general"];
	}
	
	$menu = array(	''					=> 'user_menu_general',
					'&b=avatar'			=> 'user_menu_avatar',
					'&b=notifications'	=> 'user_menu_notifications',
					'&b=social'			=> 'user_menu_social',
					'&b=security'		=> 'user_menu_security',
					'&b=blocked'		=> 'user_menu_blocked');
	
	foreach($menu as $link => $value) {
		$class = '';
		if($link == '&b='.$_GET['b'] || $link == $_GET['b']) {
			$class = ' sidebar-link-active';
			$ttl = $LNG[$title[0]];
		}
		$TMPL['menu'] .= '<div class="sidebar-link'.$class.'"><a href="'.$CONF['url'].'/index.php?a=settings'.$link.'" rel="loadpage">'.$LNG[$value].'</a></div>';
	}
	$TMPL['menu'] .= ($settings['paypalapp'] ? '<div class="sidebar-link"><a href="'.$CONF['url'].'/index.php?a=pro" rel="loadpage">'.$LNG['user_menu_plan'].'</a></div>' : '');

	$TMPL['title'] = $LNG['title_settings'].' - '.$settings['title'];
	
	$skin = new skin('settings/content');
	return $skin->make();
}
?>