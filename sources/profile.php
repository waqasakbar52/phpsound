<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	$_GET['u'] = htmlspecialchars($_GET['u']);
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if(empty($verify['username'])) {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
		
		// If the $_GET user is empty, define default user as current logged in user, else redirect to home-page
		if($_GET['u'] == '') {
			$_GET['u'] = (!empty($verify['username']) ? $verify['username'] : header("Location: ".$CONF['url']."/index.php?a=welcome"));
		}
	}
		 
	// Start displaying the Feed
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	$feed->user = $verify;
	$feed->id = $verify['idu'];
	$feed->username = $verify['username'];
	$feed->per_page = $settings['perpage'];
	$feed->categories = $feed->getCategories();
	$feed->time = $settings['time'];
	$feed->c_per_page = $settings['cperpage'];
	$feed->c_start = 0;
	$feed->l_per_post = $settings['lperpost'];
	
	if($verify['username']) {
		$feed->updateStatus($verify['offline']);
	}
	
	// If the $_GET user is empty, define default user as current logged in user, else redirect to home-pag
	if($_GET['u'] == '') {
		$_GET['u'] = (!empty($feed->username) ? $feed->username : header("Location: ".$CONF['url']."/index.php?a=welcome"));
	}
	
	$feed->profile = $_GET['u'];
	$feed->profile_data = $feed->profileData($_GET['u']);
	$feed->subscriptionsList = $feed->getSubs($feed->profile_data['idu'], 0, null);
	$feed->subscribersList = $feed->getSubs($feed->profile_data['idu'], 1, null);
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('shared/rows'); $rows = '';
	
	if(empty($_GET['filter'])) {
		$_GET['filter'] = '';
	}
	// Allowed types
	list($timeline, $message) = $feed->getProfile(0, $_GET['filter']);

	if($_GET['r'] == 'subscriptions') {
		if($message !== 1) {
			$feed->s_per_page = $settings['sperpage'];
			$feed->subsList = $feed->getSubs($feed->profile_data['idu'], 0, 0);
			$TMPL['messages'] = $feed->listSubs(0);
		} else {
			$TMPL['messages'] = $timeline;
		}
		$title = $LNG['subscriptions'];
	} elseif($_GET['r'] == 'subscribers') {
		if($message !== 1) {
			$feed->s_per_page = $settings['sperpage'];
			$feed->subsList = $feed->getSubs($feed->profile_data['idu'], 1, 0);
			$TMPL['messages'] = $feed->listSubs(1);
		} else {
			$TMPL['messages'] = $timeline;
		}
		$title = $LNG['subscribers'];
	} elseif($_GET['r'] == 'likes') {
		if($message !== 1) {
			$likes = $feed->getLikes(0, 1);
			$TMPL['messages'] = $likes[0];
		} else {
			$TMPL['messages'] = $timeline;
		}
		$title = $LNG['likes'];
	} elseif($_GET['r'] == 'playlists') {
		if($message !== 1) {
			$TMPL['messages'] = $feed->getPlaylists(0, 1);
		} else {
			$TMPL['messages'] = $timeline;
		}
		$title = $LNG['playlists'];
	} else {
		$TMPL['messages'] = $timeline;
	}
	
	$rows = $skin->make();
	
	$skin = new skin('profile/sidebar'); $sidebar = '';
	// If the username doesn't exist
	if($message !== 1) {
		$TMPL['about'] = $feed->fetchProfileInfo($feed->profileData($_GET['u']));
		$TMPL['dates'] = $feed->sidebarDates($_GET['filter'], 'profile');
		
		$TMPL['ad'] = generateAd($settings['ad4']);
	} else {
		$skin = new skin('profile/sidebar'); $sidebar = '';
		$TMPL['ad'] = generateAd($settings['ad4']);
	}
	$sidebar = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $rows;
	$TMPL['sidebar'] = $sidebar;
	$TMPL['cover'] = $feed->fetchProfile($feed->profile_data);

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = (!empty($title) ? $title : $LNG['title_profile']).' - '.realName($_GET['u'], $feed->profile_data['first_name'], $feed->profile_data['last_name'], 1).' - '.$settings['title'];
	$TMPL['meta_description'] = realName($_GET['u'], $feed->profile_data['first_name'], $feed->profile_data['last_name'], 1).' '.$feed->profile_data['description'];

	$skin = new skin('shared/content');
	
	return $skin->make();
}
?>