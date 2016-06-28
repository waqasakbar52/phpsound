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
			$feed = new feed();
			$feed->db = $db;
			$feed->url = $CONF['url'];
			$feed->user = $verify;
			$feed->id = $verify['idu'];
			$feed->username = $verify['username'];
			$feed->time = $settings['time'];
			$feed->updateStatus($verify['offline']);
			
			$TMPL_old = $TMPL; $TMPL = array();
			$skin = new skin('track/edit'); $rows = '';
			$TMPL['token_input'] = generateToken(1);
			$TMPL['url'] = $CONF['url'];
			$TMPL['page_title'] = $LNG['upload'];
			$TMPL['form_url'] = $CONF['url'].'/requests/post_track.php';
			$feed->art_size = $settings['artsize'];
			$feed->art_format = $settings['artformat'];
			$feed->paypalapp = $settings['paypalapp'];
			$feed->track_size_total = ($feed->getProStatus($feed->id, 1) ? $settings['protracktotal'] : $settings['tracksizetotal']);
			$feed->track_size = ($feed->getProStatus($feed->id, 1) ? $settings['protracksize'] : $settings['tracksize']);
			$feed->track_format = $settings['trackformat'];
			$TMPL['art'] = 'default.png';
			
			$date = explode('-', $TMPL['release']);
				
			$TMPL['years'] = generateDateForm(0, $date[0]);
			$TMPL['months'] = generateDateForm(1, $date[1]);
			$TMPL['days'] = generateDateForm(2, $date[2]);
		
			// Se the download to off by default
			$TMPL['doff'] = ' selected="selected"';	
			
			// Set the visiblity to public by default
			$TMPL['pon'] = ' selected="selected"';
			
			if($TMPL['license'] == 0) {
				$TMPL['ar'] = 'checked';
			} else {
				$TMPL['cc'] = 'checked';
				$license = str_split($TMPL['license']);
				$TMPL['nc'] = $license[1];
				$TMPL['nd_sa'] = $license[2];
			}
			
			$TMPL['display'] = 'inhert';
			$TMPL['onclick'] = 'startUpload(); return false;';
			$TMPL['btntext'] = $LNG['upload'];
			
			$rows = $skin->make();
			
			$skin = new skin('upload/sidebar'); $sidebar = '';
			$TMPL['statistics'] = $feed->sidebarStatistics(null, 2);
			$TMPL['go_pro'] = $feed->goProMessage(1, 1);
			$sidebar = $skin->make();
			
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['rows'] = $rows;
			$TMPL['sidebar'] = $sidebar;
		}
	
	} else {
		// If the session or cookies are not set, redirect to home-page
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['upload'].' - '.$settings['title'];

	$skin = new skin('upload/content');
	
	return $skin->make();
}
?>