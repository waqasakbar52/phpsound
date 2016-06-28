<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
	}
	
	// Start displaying the Feed
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	$feed->user = $verify;
	$feed->id = $verify['idu'];
	$feed->username = $verify['username'];
	$feed->per_page = -1;
	$feed->categories = $feed->getCategories();
	$feed->time = $settings['time'];
	$feed->c_start = 0;
	$feed->l_per_post = 0;
	if(isset($_SESSION['usernameAdmin']) && isset($_SESSION['passwordAdmin'])) {
		$loggedInAdmin = new loggedInAdmin();
		$loggedInAdmin->db = $db;
		$loggedInAdmin->url = $CONF['url'];
		$loggedInAdmin->username = $_SESSION['usernameAdmin'];
		$loggedInAdmin->password = $_SESSION['passwordAdmin'];
		$loggedIn = $loggedInAdmin->verify();
		
		if($loggedIn['username']) {
		// Set admin level
		$feed->is_admin = 1;
		}
	}
	
	$TMPL_old = $TMPL; $TMPL = array();
	
	// Get the track
	$playlist = $feed->getPlaylists(0, 3, $_GET['id']);
	
	// Match the content from the song-title class in order to set it for the title tag
	preg_match_all('/<div.*(class="playlist-title").*>([\d\D]*)<\/div>/iU', $playlist[0], $title);
	if(empty($title[2][0])) {
		preg_match_all('/<div.*(class="page-header").*>([\d\D]*)<\/div>/iU', $playlist[0], $title);
	}
	
	$TMPL['id'] = $_GET['id'];
	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = strip_tags($title[2][0]);
	
	if(isset($_GET['edit']) && $feed->sidebarButton($_GET['id'], 2)) {
		$skin = new skin('playlist/edit'); $rows = '';
		
		// Send the form
		if(isset($_POST['edit'])) {
			$TMPL['message'] = $feed->managePlaylist($_GET['id'], 1, $_POST);
		}

		// Get the current values
		list($TMPL['name'], $TMPL['description']) = $feed->managePlaylist($_GET['id'], 0);
		
		// Reset the page title, and the content title
		$TMPL['title'] = $title[2][0] = $TMPL['name'];
	} else {
		$skin = new skin('track/rows'); $rows = '';
		// If the playlist id is not set, or it doesn't consist from digits
		if(!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
			header("Location: ".$CONF['url']);
		}
		// If the output is empty redirect to home-page
		if(empty($playlist[0])) {
			header("Location: ".$CONF['url']);
		}
		$TMPL['messages'] = $playlist[0];
		
	}
	$rows = $skin->make();
	
	$skin = new skin('playlist/sidebar'); $sidebar = '';
	$TMPL['ad'] = generateAd($settings['ad5']);
	
	// If the track can be viewed
	if(!$playlist[1]) {
		$TMPL['edit'] = $feed->sidebarButton($_GET['id'], 2);
		$TMPL['description'] = $feed->sidebarDescription($_GET['id'], 1);
		$TMPL['tags'] = $feed->sidebarKeywords($_GET['id'], 1);
	}
	$sidebar = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $rows;
	$TMPL['sidebar'] = $sidebar;

	$TMPL['url'] = $CONF['url'];
	
	$title = trim(strip_tags($title[2][0]));
	$TMPL['title'] = $title.' - '.$settings['title'];
	$TMPL['meta_description'] = $title.' '.$feed->sidebarDescription($_GET['id'], 1, 1);

	$skin = new skin('shared/content');
	return $skin->make();
}
?>