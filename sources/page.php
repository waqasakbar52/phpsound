<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $settings;
	
	$title = array( 'privacy'    => $LNG['privacy_policy'],
					'tos'		 => $LNG['terms_of_use'],
					'about'		 => $LNG['about'],
					'disclaimer' => $LNG['disclaimer'],
					'contact'    => $LNG['contact'],
					'api'		 => $LNG['api_documentation']);
		
	$skin = new skin('page/sidebar'); $sidebar = '';
	foreach($title as $url => $header) {
		if($_GET['b'] == $url) {
			$TMPL['links'] .= '<div class="sidebar-link sidebar-link-active"><a href="'.$CONF['url'].'/index.php?a=page&b='.$url.'" rel="loadpage">'.$header.'</a></div>';
		} else {
			$TMPL['links'] .= '<div class="sidebar-link"><a href="'.$CONF['url'].'/index.php?a=page&b='.$url.'" rel="loadpage">'.$header.'</a></div>';
		}
	}
	$sidebar = $skin->make();
	
	if(!empty($_GET['b']) && isset($title[$_GET['b']])) {
		$b = $_GET['b'];
		
		$TMPL['sidebar'] = $sidebar;
		$TMPL['url'] = $CONF['url'];
		$TMPL['title'] = "{$title[$b]} - ".$settings['title'];
		$TMPL['header'] = $title[$b]; 
		$skin = new skin("page/$b");
		return $skin->make();
	} else {
		header("Location: ".$CONF['url']);
	}
}
?>