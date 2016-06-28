<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if(empty($verify['username'])) {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		} else {
			// Start displaying the Feed
			
		}
	}
	
	// Start the music feed
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	$feed->user = $verify;
	$feed->id = $verify['idu'];
	$feed->username = $verify['username'];
	$feed->per_page = $settings['perpage'];
	$feed->categories = $feed->getCategories();
	$feed->time = $settings['time'];
	$feed->l_per_post = $settings['lperpost'];
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('shared/rows'); $rows = '';
	
	if(empty($_GET['filter'])) {
		$_GET['filter'] = '';
	}
	// Allowed types
	list($timeline, $message) = $feed->explore(0, $_GET['filter']);
	$TMPL['messages'] = $timeline;

	$rows = $skin->make();
	
	$skin = new skin('explore/sidebar'); $sidebar = '';
	
	$feed->online_time = $settings['conline'];
	$feed->friends_online = $settings['ronline'];
	$feed->updateStatus($verify['offline']);
	
	if($verify['username']) {
		$TMPL['upload'] = $feed->sidebarButton();
		$TMPL['suggestions'] = $feed->sidebarSuggestions();
	}
	$TMPL['categories'] = $feed->sidebarCategories($_GET['filter']);
	$TMPL['ad'] = generateAd($settings['ad2']);
	
	$sidebar = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $rows;
	$TMPL['sidebar'] = $sidebar;

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['explore'].(!empty($_GET['filter']) ? ' - '.htmlspecialchars($_GET['filter']).' - ' : ' - ').$settings['title'];
	$TMPL['header'] = pageHeader($LNG['explore'].(!empty($_GET['filter']) ? ' - '.$_GET['filter'] : ''));

	$skin = new skin('shared/content');
	return $skin->make();
}
?>