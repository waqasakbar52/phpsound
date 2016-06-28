<?php
session_start();
require_once('./includes/config.php');
require_once('./includes/classes.php');
require_once(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), null));
$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}
$db->set_charset("utf8");
$resultSettings = $db->query(getSettings());
// Added to verify whether the user imported the database or not
if($resultSettings) {
	$settings = $resultSettings->fetch_assoc();
} else {
	echo "Error: ".$db->error;
}

// Store the theme path and theme name into the CONF and TMPL
$CONF['theme_path'];
$CONF['theme_name'] = $settings['theme'];
$CONF['theme_url'] = $CONF['theme_path'].'/'.$CONF['theme_name'];

$volume = $settings['volume'];

// Start displaying the Feed
$player = new player();
$player->db = $db;
$player->url = $CONF['url'];
$player->l_per_post = $settings['lperpost'];
$player->title = $settings['title'];

// Get the track
$player = $player->getEmbed($_GET['id']);

// Match the content from the song-title class in order to set it for the title tag
preg_match_all('/<div.*(class="song-title").*>([\d\D]*)<\/div>/iU', $player, $title);

// Get the token_id
$token_id = generateToken();
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo ((!empty($title[2][0])) ? strip_tags($title[2][0]).' - '.$settings['title'] : $settings['title']); ?></title>
<link href="<?php echo $CONF['url'].'/'.$CONF['theme_url']; ?>/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<script type="text/javascript">baseUrl = '<?php echo $CONF['url']; ?>'; token_id = '<?php echo $token_id; ?>'; nowPlaying = 0; player_volume = '<?php echo $volume; ?>';</script>
<script type="text/javascript" src="<?php echo $CONF['url'].'/'.$CONF['theme_url']; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $CONF['url'].'/'.$CONF['theme_url']; ?>/js/functions.js"></script>
<script type="text/javascript" src="<?php echo $CONF['url'].'/'.$CONF['theme_url']; ?>/js/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo $CONF['url'].'/'.$CONF['theme_url']; ?>/js/jquery.timeago.js"></script>
<script type="text/javascript">
$(document).ready(function() {
<?php
if($_GET['autoplay']) {
?>
	setTimeout(function() {
		$("#play<?php echo $_GET['id']; ?>").trigger('click');
	},10);
<?php
}
?>
});
function playSong(song, id) {
	// If the user is on Android, open the track in a new tab rather than playing it on the page
	/*if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		window.location = '<?php echo $CONF['url']; ?>/uploads/tracks/'+song;
		return false;
	}*/

	// Remove the current-song class
	$('.current-song').removeClass('current-song');
	// Show the previously hidden Play button (if any)
	$('.current-play').show();
	$('.current-play').removeClass('current-play');

	// Remove the active player if exist and set the ghost player
	$('.current-seek').html($('#sound_ghost_player').html());

	// Remove the active player class
	$('.current-seek').removeClass('current-seek');

	// Escape the ID (contains dots) http://api.jquery.com/category/selectors/
	var parsedId = song.replace('.', '\\.');

	// Add the current song class
	$('#track'+id).addClass('current-song');
	// Add current play class to the Play button and hide it
	$('#play'+id).addClass('current-play');
	$('.current-play').hide();

	// Get the current played song name
	if ($('#song-name'+id).html().length > 25) {
		var songName = $('#song-name'+id).html().substr(0, 25)+'...';
	} else {
		var songName = $('#song-name'+id).html();
	}
	
	$('#sw-song-name').html(songName);

	// Show the time holder when a song starts playing
	$('.jp-audio .jp-time-holder').show();

	// Add the active player to the current song
	$("#song-controls"+id).html($("#seek-bar-song").html());

	// Add the active player class to the current song
	$("#song-controls"+id).addClass('current-seek');

	// Set the play/pause button position (this is needed for mobile view in order for the play/pause button to be at the same height with the initial play button)
	$('#track'+id+' .jp-play , #track'+id+' .jp-pause').css({ 'margin-top' : '-' + $('.song-top', '#track'+id).outerHeight() + 'px' });

	// Get the track extension
	var ext = getExtension(song);

	$("#sound-player").jPlayer({
		ready: function (event) {
			if(ext == 'mp3') {
				$(this).jPlayer("setMedia", {
					mp3: '<?php echo $CONF['url']; ?>/uploads/tracks/'+song
				}).jPlayer("play");
			} else if(ext == 'm4a') {
				$(this).jPlayer("setMedia", {
					m4a: '<?php echo $CONF['url']; ?>/uploads/tracks/'+song				
				}).jPlayer("play");
			}
		},
		play: function() {
			$.ajax({
				type: "POST",
				url: "<?php echo $CONF['url']; ?>/requests/add_view.php",
				data: "id="+id+"&token_id=<?php echo $token_id; ?>", 
				cache: false,
				success: function(html) {
				
				}
			});
		},
		cssSelectorAncestor: '#sound-container',
		error: function() {
			// If the track fails to play for whatever reasons, hide it
			$('#track'+id).fadeOut();
		},
		swfPath: "<?php echo $CONF['url'].'/'.$CONF['theme_url']; ?>/js",
		supplied: ext,
		wmode: "window",
		volume: player_volume,
		smoothPlayBar: true,
		keyEnabled: true
	});
};
</script>
</head>
<body>
<?php
echo $player;
?>
<div id="sound-player" class="jp-jplayer"></div>
<div id="seek-bar-song" style="display: none;">
	<div id="sound-container" class="jp-audio">
		<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<a class="jp-play">&nbsp;</a><a class="jp-pause">&nbsp;</a>
					
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>
					</div>
			</div>
		</div>
	</div>
</div>
<div id="sound_ghost_player" style="display: none;"><div class="jp-audio"><div class="jp-type-single"><div class="jp-gui jp-interface"><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div></div></div></div></div>
</body>
</html>