<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;
	require_once('./includes/countries.php');
	
	if(isset($_POST['login'])) {
		$logInAdmin = new logInAdmin();
		$logInAdmin->db = $db;
		$logInAdmin->url = $CONF['url'];
		$logInAdmin->username = $_POST['username'];
		$logInAdmin->password = $_POST['password'];
		
		$TMPL['message'] = $logInAdmin->in();
	}
	if(isset($_SESSION['usernameAdmin']) && isset($_SESSION['passwordAdmin'])) {
		$loggedInAdmin = new loggedInAdmin();
		$loggedInAdmin->db = $db;
		$loggedInAdmin->url = $CONF['url'];
		$loggedInAdmin->username = $_SESSION['usernameAdmin'];
		$loggedInAdmin->password = $_SESSION['passwordAdmin'];
		$loggedIn = $loggedInAdmin->verify();

		if($loggedIn['username']) {
			// Set the content to true, change the $skin to content
			$content = true;
			
			$TMPL_old = $TMPL; $TMPL = array();
			
			$TMPL['url'] = $CONF['url'];
			$TMPL['token_input'] = generateToken($_SESSION['token_id']);
			$TMPL['token_id'] = $_SESSION['token_id'];
			
			if($_GET['b'] == 'security') { // Security Admin Tab
				$skin = new skin('admin/security'); $page = '';

				if(!empty($_POST)) {
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('admin', $_POST);
					
					header("Location: ".$CONF['url']."/index.php?a=admin&b=security&m=".$updated);
				}
				
				if($_GET['m'] == 1) {
					$TMPL['message'] = notificationBox('success', $LNG['password_changed']);
				} elseif($_GET['m'] == 2) {
					$TMPL['message'] = notificationBox('error', $LNG['wrong_current_password']);
				} elseif($_GET['m'] == 3) {
					$TMPL['message'] = notificationBox('error', $LNG['password_not_match']);
				} elseif($_GET['m'] == 4) {
					$TMPL['message'] = notificationBox('error', $LNG['password_too_short']);
				} elseif($_GET['m'] == 0 && isset($_GET['m'])) {
					$TMPL['message'] = notificationBox('info', $LNG['password_not_changed']);
				}
			} elseif($_GET['b'] == 'payments') {
				$managePayments = new managePayments();
				$managePayments->db = $db;
				$managePayments->url = $CONF['url'];
				$managePayments->per_page = $settings['rperpage'];
				
				if(isset($_GET['id'])) {
					$skin = new skin('admin/payment'); $page = '';
					if(isset($_GET['type']) && $_GET['token_id'] == $_SESSION['token_id']) {
						$managePayments->updatePayment($_GET['id'], $_GET['type']);
						header("Location: ".$CONF['url']."/index.php?a=admin&b=payments&id=".$_GET['id']);
					}
					$TMPL['content'] = $managePayments->getPayment($_GET['id']);
					
					// If the payment doens't exist
					if(empty($TMPL['content'])) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=payments&m=i");
					}
				} else {
					$skin = new skin('admin/manage_payments'); $page = '';
					$TMPL['payments'] = $managePayments->getPayments(0);
				}
				if($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('error', $LNG['payment_not_exist']);
				}
			} elseif($_GET['b'] == 'pro') { // Security Admin Tab
				$skin = new skin('admin/pro'); $page = '';
				
				if(!extension_loaded('openssl')) {
					$TMPL['message'] .= notificationBox('error', $LNG['openssl_error']);
				}
				if(!function_exists('curl_exec')) {
					$TMPL['message'] .= notificationBox('info', $LNG['curl_error']);
				}

				$TMPL['ppuser'] = $settings['paypaluser']; $TMPL['pppass'] = $settings['paypalpass']; $TMPL['ppsign'] = $settings['paypalsign']; $TMPL['currentProMonth'] = $settings['promonth']; $TMPL['currentProYear'] = $settings['proyear'];

				if(empty($settings['paypalapp'])) {
					$TMPL['ppappoff'] = ' selected="selected"';
				} else {
					$TMPL['ppappon'] = ' selected="selected"';
				}
				
				if(empty($settings['paypalsand'])) {
					$TMPL['ppsandoff'] = ' selected="selected"';
				} else {
					$TMPL['ppsandon'] = ' selected="selected"';
				}
				
				$TMPL['protracksize'] = round(($settings['protracksize'] / 1024) / 1024);
				$TMPL['protracktotal'] = round(($settings['protracktotal'] / 1024) / 1024);
				$TMPL['tracksize'] = round(($settings['tracksize'] / 1024) / 1024);
				$TMPL['tracksizetotal'] = round(($settings['tracksizetotal'] / 1024) / 1024);
				$TMPL['currency'] = $settings['currency'];
				
				if(!empty($_POST)) {
					// Transform the user's value in the appropriate format
					$_POST['protracksize'] = ($_POST['protracksize'] * 1024) * 1024;
					$_POST['protracktotal'] = ($_POST['protracktotal'] * 1024) * 1024;
					$_POST['tracksize'] = ($_POST['tracksize'] * 1024) * 1024;
					$_POST['tracksizetotal'] = ($_POST['tracksizetotal'] * 1024) * 1024;

					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('settings', $_POST);

					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=pro&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=pro&m=i");
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] .= notificationBox('success', $LNG['settings_saved']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] .= notificationBox('info', $LNG['nothing_changed']);
				}
			} elseif($_GET['b'] == 'stats') { // Security Admin Tab
				$skin = new skin('admin/stats'); $page = '';
				
				list($TMPL['tracks_total'], $TMPL['tracks_public'], $TMPL['tracks_private'], $TMPL['comments_total'], $TMPL['users_today'], $TMPL['users_this_month'], $TMPL['users_last_30'], $TMPL['users_total'], $TMPL['total_reports'], $TMPL['pending_reports'], $TMPL['safe_reports'], $TMPL['deleted_reports'], $TMPL['total_tracks_reports'], $TMPL['pending_track_reports'], $TMPL['safe_track_reports'], $TMPL['deleted_track_reports'], $TMPL['total_comment_reports'], $TMPL['pending_comment_reports'], $TMPL['safe_comment_reports'], $TMPL['deleted_comment_reports'], $TMPL['total_likes'], $TMPL['likes_today'], $TMPL['likes_this_month'], $TMPL['likes_last_30'], $TMPL['total_plays'], $TMPL['plays_today'], $TMPL['plays_this_month'], $TMPL['plays_last_30'], $TMPL['total_downloads'], $TMPL['downloads_today'], $TMPL['downloads_this_month'], $TMPL['downloads_last_30'], $TMPL['total_playlists'], $TMPL['playlists_today'], $TMPL['playlists_this_month'], $TMPL['playlists_last_30'], $TMPL['total_payments'], $TMPL['payments_today'], $TMPL['payments_this_month'], $TMPL['payments_last_30'], $TMPL['total_earnings'], $TMPL['earnings_today'], $TMPL['earnings_this_month'], $TMPL['earnings_last_30']) = admin_stats($db, 0, array('currency' => $settings['currency']));
				
				$TMPL['currency'] = $settings['currency'];
			} elseif($_GET['b'] == 'themes') {
				$skin = new skin('admin/themes'); $page = '';
				$updateSettings = new updateSettings();
				$updateSettings->db = $db;
				
				$themes = $updateSettings->getThemes();
				
				$TMPL['themes_list'] = $themes[0];
				
				if(isset($_GET['theme'])) {
					// If theme is in array
					if(in_array($_GET['theme'], $themes[1])) {
						$updated = $updateSettings->query_array('settings', array('theme' => $_GET['theme'], 'token_id' => $_GET['token_id']));
						
						if($updated == 1) {
							header("Location: ".$CONF['url']."/index.php?a=admin&b=themes&m=s");
						} else {
							header("Location: ".$CONF['url']."/index.php?a=admin&b=themes&m=i");
						}
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['theme_changed']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('error', $LNG['nothing_changed']);
				}
				
			}elseif ($_GET['b'] == 'drivefile') {
				$skin = new skin('admin/drivefile'); $page = '';
				$manageDriveFiles = new manageDriveFiles();
				$manageDriveFiles->db = $db;
				$manageDriveFiles->url = $CONF['url'];
				$manageDriveFiles->title = $settings['title'];
				$manageDriveFiles->per_page = $settings['rperpage'];
				
				if(isset($_GET['sync'])) {
					if(isset($_GET['code'])){
						$_SESSION['authCode'] = $_GET['code'];
					}
					$TMPL['message'] = $manageDriveFiles->sync_drive();
				}else{
					$TMPL['drivefile'] = $manageDriveFiles->getstatus(0);
				}
				//$TMPL['message'] = notificationBox('error', $LNG['user_not_exist']);
				
			}elseif($_GET['b'] == 'reports') {
				$manageReports = new manageReports();
				$manageReports->db = $db;
				$manageReports->url = $CONF['url'];
				$manageReports->title = $settings['title'];
				$manageReports->per_page = $settings['rperpage'];
					
				if(ctype_digit($_GET['id'])) {
					if(isset($_GET['type']) && $_GET['token_id'] == $_SESSION['token_id']) {
						// Do the manage report action
						$manageReport = $manageReports->manageReport($_GET['id'], $_GET['type']);
						header("Location: ".$CONF['url']."/index.php?a=admin&b=reports&id=".$_GET['id']);
					}
					$skin = new skin('admin/report'); $page = '';
					$TMPL['content'] = $manageReports->getReport($_GET['id']);
					
					// If the report doesn't exist
					if(empty($TMPL['content'])) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=reports&m=i");
					}
				} else {
					$skin = new skin('admin/manage_reports'); $page = '';
					
					$TMPL['reports'] = $manageReports->getReports(0);
				}
				if($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('error', $LNG['report_not_exist']);
				}
			} elseif($_GET['b'] == 'users') {
				$manageUsers = new manageUsers();
				$manageUsers->db = $db;
				$manageUsers->url = $CONF['url'];
				$manageUsers->title = $settings['title'];
				$manageUsers->per_page = $settings['rperpage'];
				
				if(!isset($_GET['id']) && !isset($_GET['idu'])) {
					$skin = new skin('admin/manage_users'); $page = '';

					// Save the array returned into a list
					$TMPL['users'] = $manageUsers->getUsers(0);
				} else {
					$skin = new skin('admin/user'); $page = '';
					$getUser = $manageUsers->getUser($_GET['id'], $_GET['idu']);
					if(!$getUser) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=users&m=un");
					}
					// Create the class instance
					$updateUserSettings = new updateUserSettings();
					$updateUserSettings->db = $db;
					$updateUserSettings->id = $getUser['idu'];
					
					if(!empty($_POST)) {
						$TMPL['message'] = $updateUserSettings->query_array('users', array_map("strip_tags_array", $_POST));
					}
					
					$userSettings = $updateUserSettings->getSettings();
					$TMPL['countries'] = countries(1, $userSettings['country']);
					
					$TMPL['username'] = $userSettings['username']; $TMPL['idu'] = $userSettings['idu']; $TMPL['currentFirstName'] = $userSettings['first_name']; $TMPL['currentLastName'] = $userSettings['last_name']; $TMPL['currentEmail'] = $userSettings['email']; $TMPL['currentCity'] = $userSettings['city']; $TMPL['currentWebsite'] = $userSettings['website']; $TMPL['currentDescription'] = $userSettings['description']; $TMPL['currentFacebook'] = $userSettings['facebook']; $TMPL['currentTwitter'] = $userSettings['twitter'];  $TMPL['currentGplus'] = $userSettings['gplus']; $TMPL['currentYouTube'] = $userSettings['youtube']; $TMPL['currentSoundCloud'] = $userSettings['soundcloud']; $TMPL['currentLastfm'] = $userSettings['lastfm']; $TMPL['currentMySpace'] = $userSettings['myspace']; $TMPL['currentVimeo'] = $userSettings['vimeo']; $TMPL['currentTumblr'] = $userSettings['tumblr']; $TMPL['join_date'] = $userSettings['date'];

					$feed = new feed();
					$feed->db = $db;
					$feed->id = $updateUserSettings->id;
					$feed->paypalapp = $settings['paypalapp'];
					
					$manageReports = new manageReports();
					$manageReports->db = $db;
					$manageReports->url = $CONF['url'];
					$manageReports->per_page = $settings['rperpage'];

					if(isset($_GET['suspend']) && $_GET['token_id'] == $_SESSION['token_id']) {
						$manageUsers->suspendUser($feed->id, $_GET['suspend']);
						header("Location: ".$CONF['url']."/index.php?a=admin&b=users&id=".$_GET['id']);
					}
					
					$user = $manageUsers->getUser($getUser['idu']);
					
					// Get the Pro Status
					$pro_status = $feed->getProStatus($user['idu']);
					
					// If the Pro Accounts are enabled
					if($settings['paypalapp']) {
						// Promote the user
						if(!$pro_status && $_GET['promote'] == 1 && $_GET['token_id'] == $_SESSION['token_id']) {
							emulatePayment($db, $settings, $user);
							header("Location: ".$CONF['url']."/index.php?a=admin&b=users&id=".$_GET['id'].'&promoted=1');
						}
						
						// If the user is not pro, display the button
						if(!$pro_status && !isset($_GET['promote'])) {
							$promote = '<div class="manage-users-buttons"><div class="modal-btn list-button"><a href="'.$CONF['url'].'/index.php?a=admin&b=users&id='.$user['idu'].'&promote=1&token_id='.$_SESSION['token_id'].'" title="'.$LNG['promote_info'].'">'.$LNG['promote'].'</a></div></div>';
						}
					}
					
					$TMPL['username'] = '<div class="manage-users-image"><a href="'.$CONF['url'].'/index.php?a=profile&u='.$user['username'].'" target="_blank"><img src="'.$CONF['url'].'/thumb.php?src='.$user['image'].'&t=a&w=112&h=112"></a></div><div class="manage-users-content"><a href="'.$CONF['url'].'/index.php?a=profile&u='.$user['username'].'" target="_blank">'.$user['username'].'</a><br>'.$user['email'].'</div>'.$promote;
					
					$TMPL['user'] = $userSettings['username'];
					
					$TMPL['reports'] = $manageReports->getReports(0, ($feed->getTrackList($feed->id) ? $feed->getTrackList($feed->id) : 1));
					if(empty($TMPL['reports'])) {
						$TMPL['hide_r'] = ' style="display: none;"';
					}
					
					// If the user has payments history
					$managePayments = new managePayments();
					$managePayments->db = $db;
					$managePayments->url = $CONF['url'];
					$managePayments->per_page = $settings['rperpage'];
			
					$TMPL['history'] = $managePayments->getPayments(0, $updateUserSettings->id);

					if(empty($TMPL['history'])) {
						$TMPL['hide_p'] = ' style="display: none;"';
					}
					
					// Suspend variable for the suspend url
					$TMPL['suspend'] = ($user['suspended'] ? '0' : '1');

					$TMPL['status_desc'] = ($user['suspended'] ? $LNG['restore_account'] : $LNG['suspend_account']);
					
					if($_GET['promoted']) {
						$TMPL['status'] = notificationBox('success', $LNG['promoted']);
					}
					$TMPL['status'] .= ($user['suspended'] ? notificationBox('error', $LNG['account_suspended']) : '');
					
					if($user['suspended']) {
						$TMPL['suspended'] = $LNG['restore'];
					} else {
						$TMPL['suspended'] = $LNG['suspend'];
					}
				}
				// If GET delete is set, delete the user
				if($_GET['delete'] && $_GET['token_id'] == $_SESSION['token_id']) {
					$manageUsers->deleteUser($_GET['delete']);
					header("Location: ".$CONF['url']."/index.php?a=admin&b=users&m=".$_GET['deleted']);
				}
				
				if($_GET['m'] == 'un') {
					$TMPL['message'] = notificationBox('error', $LNG['user_not_exist']);
				} elseif(!empty($_GET['m'])) {
					$TMPL['message'] = notificationBox('success', sprintf($LNG['user_has_been_deleted'], $_GET['m']));
				}
			} elseif($_GET['b'] == 'categories') {
				$manageCategories = new manageCategories();
				$manageCategories->db = $db;
				$manageCategories->url = $CONF['url'];
				
				$skin = new skin('admin/manage_categories'); $page = '';
				
				$TMPL['categories'] = $manageCategories->getCategories();

			} elseif($_GET['b'] == 'ads') {
				$skin = new skin('admin/manage_ads'); $page = '';
				
				$TMPL['ad1'] = $settings['ad1']; $TMPL['ad2'] = $settings['ad2']; $TMPL['ad3'] = $settings['ad3']; $TMPL['ad4'] = $settings['ad4']; $TMPL['ad5'] = $settings['ad5']; $TMPL['ad6'] = $settings['ad6']; $TMPL['ad7'] = $settings['ad7'];
				if(!empty($_POST)) {
					// Unset the submit array element
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('settings', $_POST);
					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=ads&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=ads&m=i");
					}
				}
				if($_GET['m'] == 's') {
					$TMPL['message'] = notificationBox('success', $LNG['settings_saved']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] = notificationBox('info', $LNG['nothing_changed']);
				}
			} elseif($_GET['b'] == 'site_settings') {
				$skin = new skin('admin/site_settings'); $page = '';
				
				$TMPL['currentTitle'] = $settings['title'];
				$TMPL['rperpage'] = $settings['rperpage'];
				$TMPL['perpage'] = $settings['perpage'];
				$TMPL['cperpage'] = $settings['cperpage'];
				$TMPL['mperpage'] = $settings['mperpage'];
				$TMPL['sperpage'] = $settings['sperpage'];
				$TMPL['nperpage'] = $settings['nperpage'];
				$TMPL['mlimit'] = $settings['mlimit'];
				$TMPL['intervaln'] = $settings['intervaln'] / 1000;
				$TMPL['lperpost'] = $settings['lperpost'];
				$TMPL['ronline'] = $settings['ronline'];
				$TMPL['nperwidget'] = $settings['nperwidget'];
				$TMPL['chatr'] = $settings['chatr'];
				$TMPL['conline'] = $settings['conline'];
				$TMPL['size'] = round(($settings['size'] / 1024) / 1024);
				$TMPL['format'] = $settings['format'];
				$TMPL['artsize'] = round(($settings['artsize'] / 1024) / 1024);;
				$TMPL['artformat'] = $settings['artformat'];
				$TMPL['trackformat'] = $settings['trackformat'];
				$TMPL['aperip'] = $settings['aperip'];
				$TMPL['tracking_code'] = $settings['tracking_code'];
				$TMPL['fbappid'] = $settings['fbappid'];
				$TMPL['fbappsecret'] = $settings['fbappsecret'];
				$TMPL['smtp_host'] = $settings['smtp_host'];
				$TMPL['smtp_port'] = $settings['smtp_port'];
				$TMPL['smtp_username'] = $settings['smtp_username'];
				$TMPL['smtp_password'] = $settings['smtp_password'];
				
				if(empty($settings['fbapp'])) {
					$TMPL['fbappoff'] = ' selected="selected"';
				} else {
					$TMPL['fbappon'] = ' selected="selected"';
				}
				
				if($settings['smtp_email'] == '1') {
					$TMPL['smtpon'] = 'selected="selected"';
				} else {
					$TMPL['smtpoff'] = 'selected="selected"';
				}
				
				if($settings['smtp_auth'] == '1') {
					$TMPL['smtpaon'] = 'selected="selected"';
				} else {
					$TMPL['smtpaoff'] = 'selected="selected"';
				}
				
				if($settings['captcha'] == '1') {
					$TMPL['on'] = 'selected="selected"';
				} else {
					$TMPL['off'] = 'selected="selected"';
				}
				
				if($settings['time'] == '0') {
					$TMPL['one'] = 'selected="selected"';
				} elseif($settings['time'] == '1') {
					$TMPL['two'] = 'selected="selected"';
				} elseif($settings['time'] == '2') {
					$TMPL['three'] = 'selected="selected"';
				} else {
					$TMPL['four'] = 'selected="selected"';
				}
				
				if($settings['volume'] == '0.20') {
					$TMPL['vtwenty'] = 'selected="selected"';
				} elseif($settings['volume'] == '0.40') {
					$TMPL['vfourty'] = 'selected="selected"';
				} elseif($settings['volume'] == '0.60') {
					$TMPL['vsixty'] = 'selected="selected"';
				} elseif($settings['volume'] == '0.80') {
					$TMPL['veighty'] = 'selected="selected"';
				} elseif($settings['volume'] == '1') {
					$TMPL['vhundred'] = 'selected="selected"';
				}
				
				if($settings['mail'] == '1') {
					$TMPL['mailon'] = 'selected="selected"';
				} else {
					$TMPL['mailoff'] = 'selected="selected"';
				}
				
				if($settings['email_comment'] == '0') {
					$TMPL['ecoff'] = 'selected="selected"';
				} else {
					$TMPL['econ'] = 'selected="selected"';
				}
				
				if($settings['email_like'] == '0') {
					$TMPL['eloff'] = 'selected="selected"';
				} else {
					$TMPL['elon'] = 'selected="selected"';
				}
				
				if($settings['email_new_friend'] == '0') {
					$TMPL['enfoff'] = 'selected="selected"';
				} else {
					$TMPL['enfon'] = 'selected="selected"';
				}
				
				if(isset($_POST['submit'])) {
					// Unset the submit array element
					unset($_POST['submit']);
					// Transform the user's value in the appropriate format
					$_POST['intervaln'] = $_POST['intervaln'] * 1000;
					$_POST['size'] = ($_POST['size'] * 1024) * 1024;
					$_POST['artsize'] = ($_POST['artsize'] * 1024) * 1024;
					
					$updateSettings = new updateSettings();
					$updateSettings->db = $db;
					$updated = $updateSettings->query_array('settings', $_POST);
					if($updated == 1) {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=site_settings&m=s");
					} else {
						header("Location: ".$CONF['url']."/index.php?a=admin&b=site_settings&m=i");
					}
				}
				
				if($_GET['m'] == 's') {
					$TMPL['message'] .= notificationBox('success', $LNG['settings_saved']);
				} elseif($_GET['m'] == 'i') {
					$TMPL['message'] .= notificationBox('info', $LNG['nothing_changed']);
				}

				if(!extension_loaded('openssl') && ($settings['fbapp'] || $settings['smtp_email'])) {
					$TMPL['message'] .= notificationBox('error', $LNG['openssl_error']);
				}
				if(!function_exists('curl_exec')) {
					$TMPL['message'] .= notificationBox('info', $LNG['curl_error']);
				}
			} else {
				$skin = new skin('admin/dashboard'); $page = '';

				// Get the Today's Activity
				list(
				$TMPL['users_today'], $TMPL['users_yesterday'], $TMPL['users_two_days'], $TMPL['users_three_days'], $TMPL['users_four_days'], $TMPL['users_five_days'], $TMPL['users_six_days'],
				$TMPL['playlists_today'], $TMPL['playlists_yesterday'], $TMPL['playlists_two_days'], $TMPL['playlists_three_days'], $TMPL['playlists_four_days'], $TMPL['playlists_five_days'], $TMPL['playlists_six_days'],
				$TMPL['messages_today'], $TMPL['messages_yesterday'], $TMPL['messages_two_days'], $TMPL['messages_three_days'], $TMPL['messages_four_days'], $TMPL['messages_five_days'], $TMPL['messages_six_days'],
				$TMPL['comments_today'], $TMPL['comments_yesterday'], $TMPL['comments_two_days'], $TMPL['comments_three_days'], $TMPL['comments_four_days'], $TMPL['comments_five_days'], $TMPL['comments_six_days'],
				$TMPL['likes_today'], $TMPL['likes_yesterday'], $TMPL['likes_two_days'], $TMPL['likes_three_days'], $TMPL['likes_four_days'], $TMPL['likes_five_days'], $TMPL['likes_six_days'],
				$TMPL['downloads_today'], $TMPL['downloads_yesterday'], $TMPL['downloads_two_days'], $TMPL['downloads_three_days'], $TMPL['downloads_four_days'], $TMPL['downloads_five_days'], $TMPL['downloads_six_days'],
				$TMPL['online_users']) = admin_stats($db, 1, array('conline' => $settings['conline']));
				
				// Stats to generate the graps for
				$stats = array('users', 'playlists', 'messages', 'comments', 'likes', 'downloads');
				
				foreach($stats as $val) {
					// Get the stats values
					$stats_days = array($TMPL[$val.'_today'], $TMPL[$val.'_yesterday'], $TMPL[$val.'_two_days'], $TMPL[$val.'_three_days'], $TMPL[$val.'_four_days'], $TMPL[$val.'_five_days'], $TMPL[$val.'_six_days']);
					
					// Get the maximum value in a day
					$val_max = max($stats_days);
					
					$i = 0;
					foreach($stats_days as $value) {
						// Get the dates
						$date = date('Y-m-d', strtotime("-$i days", strtotime(date('Y-m-d'))));
						$date = explode('-', $date);
						
						$month = intval($date[1]);
						
						// Calculate the percentage
						$percentage = ($value * 100) / $val_max;
						$TMPL[$val.'_stats'] .= '<li title="'.$LNG["month_$month"].' '.$date[2].': '.$value.' '.$LNG[$val].'"><span style="height:'.$percentage.'%"></span></li>';
						$i++;
					}
				}
				
				$TMPL['users_percentage'] = percentage($TMPL['users_today'], $TMPL['users_yesterday']);
				$TMPL['playlists_percentage'] = percentage($TMPL['playlists_today'], $TMPL['playlists_yesterday']);
				$TMPL['messages_percentage'] = percentage($TMPL['messages_today'], $TMPL['messages_yesterday']);
				$TMPL['comments_percentage'] = percentage($TMPL['comments_today'], $TMPL['comments_yesterday']);
				$TMPL['likes_percentage'] = percentage($TMPL['likes_today'], $TMPL['likes_yesterday']);
				$TMPL['downloads_percentage'] = percentage($TMPL['downloads_today'], $TMPL['downloads_yesterday']);
							
				// Get the current theme's info
				include(__DIR__ .'/../'.$CONF['theme_path'].'/'.$CONF['theme_name'].'/info.php');
				$theme_name = $name;
				
				// Get the software's info
				include(__DIR__ .'/../info.php');
				$TMPL['site_version'] = sprintf($LNG['site_version'], $url, $name, $version, $CONF['url'].'/index.php?a=admin&b=themes', $theme_name);
				$TMPL['soft_url'] = $url;
			}
			
			$page .= $skin->make();
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['settings'] = $page;
			
			if(isset($_GET['logout']) == 1 && $_GET['token_id'] == $_SESSION['token_id']) {
				$loggedInAdmin->logOut();
				header("Location: ".$CONF['url']."/index.php?a=admin");
			}
			
		} else {
			// Set the content to false, change the $skin to log-in.
			$content = false;
		}
	}
	
	// Bold the current link
	if(isset($_GET['b'])) {
		$TMPL['welcome'] = $LNG["admin_ttl_{$_GET['b']}"];
	} else {
		$TMPL['welcome'] = $LNG["admin_ttl_dashboard"];
	}
	
	function adminMenuCounts($db, $type) {
		// Type 0: Return the reports number
		
		if($type == 0) {
			$query = $db->query('SELECT COUNT(`id`) as `count` FROM `reports` WHERE `state` = 0');
		}
		$result = $query->fetch_assoc();
		
		return $result['count'];
	}
	
	$menu = array(	''											=> array('admin_menu_dashboard', ''),
					'&b=site_settings'							=> array('admin_menu_site_settings', ''),
					'&b=pro'									=> array('admin_menu_pro', ''),
					'&b=themes' 								=> array('admin_menu_themes', ''),
					'&b=stats'									=> array('admin_menu_stats', ''),
					'&b=users'									=> array('admin_menu_manage_users', ''),
					'&b=payments'								=> array('admin_menu_manage_payments', ''),
					'&b=reports'								=> array('admin_menu_manage_reports', adminMenuCounts($db, 0)),
					'&b=categories'								=> array('admin_menu_manage_categories', ''),
					'&b=ads'									=> array('admin_menu_manage_ads', ''),
					'&b=drivefile'									=> array('admin_menu_drivefile', ''),
					'&b=security'								=> array('admin_menu_security', ''),
					'&logout=1&token_id='.$_SESSION['token_id']	=> array('admin_menu_logout', ''));
	
	foreach($menu as $link => $title) {
		$class = '';
		if($link == '&b='.$_GET['b'] || $link == $_GET['b']) {
			$class = ' sidebar-link-active';
			$ttl = $LNG[$title[0]];
		}
		$TMPL['menu'] .= '<div class="sidebar-link'.$class.'"><a href="'.$CONF['url'].'/index.php?a=admin'.$link.'" '.(($title[0] == 'admin_menu_logout') ? '' : 'rel="loadpage"').'>'.$LNG[$title[0]].' '.($title[1] ? '<span class="admin-notifications-number">'.$title[1].'</span>' : '').'</a></div>';
	}
	
	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['title_admin'].' - '.($loggedIn['username'] ? $ttl : $LNG['login']).' - '.$settings['title'];
	if($content) {
		$skin = new skin('admin/content');
	} else {
		$skin = new skin('admin/login');
	}
	return $skin->make();
}
?>