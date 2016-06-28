<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		
		$verify = $loggedIn->verify();

		if($verify['username']) {
			header("Location: ".$CONF['url']."/index.php?a=stream");
		}
	}
	
	// Get the popular tracks
	$result = $db->query("SELECT `views`.`track`,`tracks`.`title`,`tracks`.`art`, COUNT(`track`) as `count` FROM `views`,`tracks` WHERE `views`.`track` = `tracks`.`id` AND DATE_SUB(CURDATE(),INTERVAL 1 DAY) <= date(`views`.`time`) AND `tracks`.`public` = 1 AND `art` != 'default.png' GROUP BY `track` ORDER BY `count` DESC LIMIT 20");
	$i = 1;
	while($row = $result->fetch_assoc()) {
		if($i > 10) {
			$popular_extra[] = $row;
		} else {
			$popular[] = $row;
		}
		$i++;
	}
	
	$TMPL['popular'] = welcomeTracks($popular, $CONF['url']);
	$TMPL['popular_extra'] = $TMPL['popular'].welcomeTracks($popular_extra, $CONF['url']);
	
	// Get the latest tracks (excludes the tracks with no artwork set)
	$result = $db->query("SELECT *, `tracks`.`id` as `track` FROM `tracks` WHERE `public` = 1 AND `art` != 'default.png' ORDER BY `id` DESC LIMIT 20");
	$i = 1;
	while($row = $result->fetch_assoc()) {
		if($i > 10) {
			$latest_extra[] = $row;
		} else {
			$latest[] = $row;
		}
		$i++;
	}
	
	$TMPL['latest'] = welcomeTracks($latest, $CONF['url']);
	$TMPL['latest_extra'] = $TMPL['latest'].welcomeTracks($latest_extra, $CONF['url']);
	
	// Get the site categories
	$result = $db->query("SELECT * FROM `categories` ORDER BY `name`");
	while($row = $result->fetch_assoc()) {
		$tags[] = $row;
	}
	
	$TMPL['categories'] = welcomeCategories($tags, $CONF['url']);
	
	$TMPL['url'] = $CONF['url'];
	
	if($settings['paypalapp']) {
		$skin = new skin('welcome/gopro'); $go_pro = '';
		$go_pro = $skin->make();
	}
	$TMPL['go_pro'] = $go_pro;
	
	$TMPL['title'] = $LNG['welcome'].' - '.$settings['title'];
	$TMPL['meta_description'] = $settings['title'].' '.$LNG['welcome_about'];
	$TMPL['ad'] = $settings['ad1'];
	
	$skin = new skin('welcome/content');
	return $skin->make();
}
?>