<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if($verify['username']) {
			$feed->user = $verify;
			$feed->username = $verify['username'];
			$feed->id = $verify['idu'];
		}
	}

	$feed->per_page = $settings['sperpage'];
	$feed->categories = $feed->getCategories();
	$feed->time = $settings['time'];
	$feed->l_per_post = $settings['lperpost'];
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('shared/rows'); $rows = '';
	
	// If the $_GET keyword is empty [user]
	if($_GET['q'] == '') {
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}
	if($_GET['filter'] == 'tracks') {
		list($tracks, $error) = $feed->searchTracks(0, $_GET['q']);
		$TMPL['messages'] = $tracks;
	} elseif($_GET['filter'] == 'playlists') {
		$playlist = $feed->getPlaylists(0, 2, $_GET['q']);
		$error = $feed->showError('no_results', 1);
		$TMPL['messages'] = ((empty($playlist)) ? $error[0] : $playlist);
	} else {
		$TMPL['messages'] = $feed->getSearch(0, $settings['sperpage'], $_GET['q'], $_GET['filter']);
	}
	
	$rows = $skin->make();
	
	$skin = new skin('search/sidebar'); $sidebar = '';
	$TMPL['trending'] = $feed->sidebarTrending($_GET['tag'], 10);
	$TMPL['filters'] = $feed->sidebarFilters($_GET['filter'], $_GET['q']);
	$TMPL['ad'] = generateAd($settings['ad6']);
	
	$sidebar = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['top'] = $top;
	$TMPL['rows'] = $rows;
	$TMPL['sidebar'] = $sidebar;

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['search'].' - '.htmlspecialchars($_GET['q']).' - '.$settings['title'];
	$TMPL['header'] = pageHeader($LNG['search'].' - '.$_GET['q']);

	$skin = new skin('shared/content');
	return $skin->make();
}
?>