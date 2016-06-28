function autosize() {
	// auto adjust the height of
	$('body').on('keyup', '.message-comment-box-form > textarea', function (){
		$(this).height(0);
		$(this).height((this.scrollHeight-15));
	});
	// $('body').find('textarea.comment-reply-textarea').keyup();
}
function showButton(id) {
	$('#comment_btn_'+id).fadeIn('slow');
}
function loadChat(uid, username, block, cid, start) {
	if(!cid) {
		$('.header-loader').show();
	} else {
		$('.load-more-chat').html('<div class="preloader-retina preloader-center"></div>');
	}
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_chat.php",
		data: "uid="+uid+"&cid="+cid+"&start="+start+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			// Remove the loader animation
			if(!cid) {
				$('.chat-container').empty();
				$('.header-loader').hide();
				$('#chat').attr('class', 'chat-user'+uid);
			} else {
				$('.load-more-chat').remove();
			}
			
			if(block) {
				doBlock(uid, 0);
			}
			
			// Append the new comment to the div id
			$('.chat-container').prepend(html);
		
			if(username) {
				$('.chat-username').html(username);
				$(".chat-container").scrollTop($(".chat-container")[0].scrollHeight);
			}
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
		}
	});
}
function loadComments(id, cid, start) {
	$('#comments'+id).html('<div class="preloader-retina preloader-center"></div>');
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_comments.php",
		data: "id="+id+"&start="+start+"&cid="+cid+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			// Remove the loader animation
			$('#comments'+id).remove();
			
			// Append the new comment to the div id
			$('#comments-list'+id).append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
		}
	});
}
function exploreTracks(start, filter) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	if(filter == '') {
		q = '';
	} else {
		q = '&filter='+filter;
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_explore.php",
		data: "start="+start+q+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
			
			// Update the Track Information
			updateTrackInfo(nowPlaying);
		}
	});
}
function searchTracks(start, value, filter) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	if(filter == '') {
		q = '';
	} else {
		q = '&filter='+filter;
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_search.php",
		data: "start="+start+'&q='+encodeURIComponent(value)+q+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
			
			// Update the Track Information
			updateTrackInfo(nowPlaying);
		}
	});
}
function loadStream(start, filter) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	if(filter == '') {
		q = '';
	} else {
		q = '&filter='+filter;
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_stream.php",
		data: "start="+start+q+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
			
			// Update the Track Information
			updateTrackInfo(nowPlaying);
		}
	});
}
function loadPeople(start, value, filter) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	if(filter == '') {
		q = '';
	} else {
		q = '&filter='+filter;
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_people.php",
		data: "start="+start+'&q='+encodeURIComponent(value)+q+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
		}
	});
}
function loadProfile(start, filter, profile) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	if(filter == '') {
		q = '';
	} else {
		q = '&filter='+filter;
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_profile.php",
		data: "profile="+profile+"&start="+start+q+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
			
			// Update the Track Information
			updateTrackInfo(nowPlaying);
		}
	});
}
function loadPlaylists(start, type, query) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_playlists.php",
		data: "query="+query+"&start="+start+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
			
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
		}
	});
}
function loadLikes(start, profile, type) {
	// Type 1: Returns the likes from a user
	// Type 2: Returns the likes from a track
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	if(type == 2) {
		var query = "start="+start+'&query='+profile+'&type=2';
	} else {
		var query = "start="+start+'&profile='+profile+'&type=1';
	}
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_likes.php",
		data: query+"&token_id="+token_id,
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
			
			// Update the Track Information
			updateTrackInfo(nowPlaying);
		}
	});
}
function loadSubs(start, type, profile) {
	$('#load-more').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/load_subs.php",
		data: "id="+profile+"&start="+start+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#load-more').remove();
			
			// Append the new comment to the div id
			$('#main-content').append(html);
		}
	});
}
function postComment(id) {
	var comment = $('#comment-form'+id).val();
	
	$('#post_comment_'+id).html('<div class="preloader-retina-large preloader-center"></div>');
	
	// Remove the post button
	$('#comment_btn_'+id).fadeOut('slow');
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/post_comment.php",
		data: "id="+id+"&comment="+encodeURIComponent(comment)+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			// Remove the loader animation
			$('#post_comment_'+id).html('');
			
			// Append the new comment to the div id
			$('#comments-list'+id).prepend(html);
			
			// Fade In the style="display: none" class
			$('.message-reply-container').fadeIn(500);
			
			// Reload the timeago plugin
			jQuery("div.timeago").timeago();
			
			// Empty the text area
			$('#comment-form'+id).val('');
		}
	});
}
function addInPlaylist(track, id) {
	// Track: The track ID
	// ID: The playlist ID
	$('#playlist-entry'+id).attr('class', 'playlist-entry-loading');
	$('#playlist-entry'+id).removeAttr('onclick');
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/manage_playlists.php",
		data: "id="+track+"&playlist="+id+"&type=3&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#playlist-entry'+id).replaceWith(html);
			if(window.location.search.indexOf('playlist') > -1 && window.location.search.indexOf(id) > -1) {
				if(html.indexOf('added') == -1) {
					$('#track'+track).fadeOut(400, function() { $('#track'+track).remove(); });
					playlist('0', '0');
				}
			}
		}
	});
}
function playlist(id, type) {
	// ID: Track ID
	// Type 0: Close the Playlist modal
	// Type 1: Playlist [Load Playlists]
	// Type 2: Add new playlist
	
	if(type == 0) {
		// Hiden Modal, Background, Tab contents
		$('#playlist').fadeOut();
		$('.modal-background').fadeOut();
		$('.tab-share,.tab-embed').fadeOut();
	} else if(type == 1) {
		// Store the track id to be used when creating new playlist
		track_id = id;
		// Show Modal, Background, Share Tab
		$('#playlist').fadeIn();
		$('#playlists').html('');
		$('.modal-background').fadeIn();
		$('.tab-playlist, .modal-loading').show();
		
		// Set dynamic size for playlist name input
		$('#playlist-name').width(($('.tab-playlist').width()-70)-$('#playlist-save').width());
		
		// Rounds the width for IE [keeps the button inline]
		$('#playlist-save').width($('#playlist-save').width());
		
		// Add active class on tab
		$('#tab-playlist').addClass('modal-menu-item-active').siblings().removeClass('modal-menu-item-active');
		
		$.ajax({
			type: "POST",
			url: baseUrl+"/requests/manage_playlists.php",
			data: "id="+id+"&type="+type+"&token_id="+token_id,
			cache: false,
			success: function(html) {
				$('#playlists').html(html);
				$('.modal-loading').hide();
			}
		});
	} else if(type == 2) {
		var name = $('#playlist-name').val();
		$('.modal-loading').show();
		$('#playlist-name').val('');
		$('#add-category').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');

		$.ajax({
			type: "POST",
			url: baseUrl+"/requests/manage_playlists.php",
			data: "id="+track_id+"&name="+encodeURIComponent(name)+"&type="+type+"&token_id="+token_id, 
			cache: false,
			success: function(html) {
				$('#playlists').prepend(html);
				$('.modal-loading').hide();
			}
		});
	}
}
function connect(type) {
	// Type 0: Register
	// Type 1: Login
	
	$('.modal-loading').show();
	
	if(type == 1) {
		$('#login-button').removeAttr('onclick');
		
		var username = $('.tab-login input[name="username"]').val();
		var password = $('.tab-login input[name="password"]').val();
		var remember = $('.tab-login #remember-me').is(':checked') ? 1 : 0;

		$.ajax({
			type: "POST",
			url: baseUrl+"/requests/connect.php",
			data: "username="+username+"&password="+password+"&remember="+remember+"&login=1", 
			cache: false,
			success: function(html) {
				if(html == 1) {
					location.reload();
				} else {
					$('.modal-loading').hide();
					$('#login-message').html(html);
					$('#login-button').attr('onclick', 'connect(1)');
				}
			}
		});
	} else {
		$('#register-button').removeAttr('onclick');
		var captcha_image = $('#captcha-register').html();
		var username = $('.tab-register input[name="username"]').val();
		var password = $('.tab-register input[name="password"]').val();
		var email = $('.tab-register input[name="email"]').val();
		var captcha = $('.tab-register input[name="captcha"]').val();

		$.ajax({
			type: "POST",
			url: baseUrl+"/requests/connect.php",
			data: "username="+username+"&password="+password+"&email="+email+"&captcha="+captcha+"&register=1", 
			cache: false,
			success: function(html) {
				if(html == 1) {
					location.reload();
				} else {
					$('.modal-loading').hide();
					$('#captcha-register').html(captcha_image);
					$('#register-message').html(html);
					$('#register-button').attr('onclick', 'connect(0)');
				}
			}
		});
	}
}
function connect_modal() {
	$('#connect').fadeIn();
	$('.modal-background').fadeIn();
	$('.tab-login').show();
	
	// Add active class on tab
	$('#tab-login').addClass('modal-menu-item-active').siblings().removeClass('modal-menu-item-active');
}
function delete_modal(id, type) {
	// Type 1: Delete Track
	// Type 3: Delete Playlist
	if(type == 1) {
		$('#delete').fadeIn();
		$('.modal-background').fadeIn();
		$('.tab-delete, #delete-track').show();
		$('#delete-playlist').hide();
	} else if(type == 3) {
		$('#delete').fadeIn();
		$('.modal-background').fadeIn();
		$('.tab-delete, #delete-playlist').show();
		$('#delete-track').hide();
	} else if(type == 'cancel') {
		$('#delete').fadeOut();
		$('.modal-background').fadeOut();
	}
	$('#delete-button').attr('onclick', 'delete_the('+id+', '+type+')');
}
function share(id, type) {
	// ID: Track ID
	// Type 0: Close the Share modal
	// Type 1: Share Track
	// Type 2: Share Playlist
	
	if(type == 0) {
		// Hiden Modal, Background, Tab contents
		$('#share').fadeOut();
		$('.modal-background').fadeOut();
		$('.tab-share,.tab-embed').fadeOut();
		$('#autoplay').prop('checked', false);
	} else {
		// Show Modal, Background, Share Tab
		$('#share').fadeIn();
		$('.modal-background').fadeIn();
		$('.tab-share').show();
		$('#tab-embed').show(); // Prevent it from being left hidden on Playlist Page
		
		// Add active class on tab
		$('#tab-share').addClass('modal-menu-item-active').siblings().removeClass('modal-menu-item-active');
		
		var url = $("#song-url"+id).attr('href');
		// Set the URL to share
		if(type == 1) {
			$('#share-url').val(url);
			$('#embed-url').val('<iframe width="100%" height="140" frameborder="no" scrolling="no" src="'+url.replace('index.php?a=track&', 'embed.php?')+'"></iframe>');
			$('.dummy-artwork').html('<img src="'+$("#song-art"+id).attr('src')+'">');
		} else if(type == 2) {
			$('#share-url').val($("#playlist-url"+id).attr('href'));
			// Hide the Embed tab for Playlists
			$('#tab-embed').hide();
		}
		// Auto-Select the URL to share
		$('#share-url').select();
		
		// Show Modal Button
		$('.modal-btn').show();

		// Add attributes to social icons
		$('#fb-share').attr('onclick', 'doShare(1, '+type+', '+id+')');
		$('#tw-share').attr('onclick', 'doShare(2, '+type+', '+id+')');
		$('#gp-share').attr('onclick', 'doShare(3, '+type+', '+id+')');
		$('#pn-share').attr('onclick', 'doShare(4, '+type+', '+id+')');
		$('#em-share').attr('onclick', 'doShare(5, '+type+', '+id+')');
	}
}
function doShare(social, type, id) {
	// Social 1: Facebook
	// Social 2: Twitter
	// Social 3: Google+
	// Social 4: Pinterest
	// Social 5: Mail
	
	// Type 1: Song
	// Type 2: Playlist
	
	if(type == 1) {
		var url = encodeURIComponent($("#song-url"+id).attr('href'));
		var title = encodeURIComponent($("#song-name"+id).text());
		var art = encodeURIComponent($("#song-art"+id).attr('src'));
	} else {
		var url = encodeURIComponent($("#playlist-url"+id).attr('href'));
		var title = encodeURIComponent($("#playlist-name"+id).text());
		var art = encodeURIComponent($("#playlist-art"+id).attr('src'));
	}
	
	if(social == 1) {
		window.open("https://www.facebook.com/sharer/sharer.php?u="+url, "", "width=500, height=250");
	} else if(social == 2) {
		window.open("https://twitter.com/intent/tweet?text="+title+"&url="+url, "", "width=500, height=250");
	} else if(social == 3) {
		window.open("https://plus.google.com/share?url="+url, "", "width=500, height=250");
	} else if(social == 4) {
		window.open("https://pinterest.com/pin/create/button/?url="+url+"&description="+title+"&media="+art, "", "width=500, height=250");
	} else if(social == 5) {
		window.open("mailto:?Subject="+title+"&body="+title+" - "+url, "_self");
	}
}
function delete_the(id, type) {
	// id = unique id of the message/comment/chat/playlist
	// type = type of post: message/comment/chat/playlist
	if(type == 0) {
		$('#del_comment_'+id).html('<div class="preloader-retina"></div>');
	} else if(type == 1) {
		$('.modal-loading').show();
		$('#delete-button').removeAttr('onclick');
	} else if(type == 2) {
		$('#del_chat_'+id).html('<div class="preloader-retina"></div>');
	} else if(type == 3) {
		$('.modal-loading').show();
		$('#delete-button').removeAttr('onclick');
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/delete.php",
		data: "id="+id+"&type="+type+"&token_id="+token_id,
		cache: false,
		success: function(html) {
			if(type == 0) {
				$('#comment'+id).fadeOut(500, function() { $('#comment'+id).remove(); });
			} else if(type == 1) {
				$('#track'+id).fadeOut(400, function() { $('#track'+id).remove(); });
				$('#delete, .modal-background, .modal-loading').fadeOut();
				
				// If the deletion happened on the track page, reload the page
				if(window.location.search.indexOf('track') > -1) {
					location.reload();
				}
			} else if(type == 2) {
				$('#chat'+id).fadeOut(500, function() { $('#chat'+id).remove(); });
			} else if(type == 3) {
				$('#playlist'+id).fadeOut(400, function() { $('#playlist'+id).remove(); });
				$('#delete, .modal-background, .modal-loading').fadeOut();
				
				// If the deletion happens on the playlist page, reload the page
				if(window.location.search.indexOf('playlists') < 0) {
					location.reload();
				}
			}
		}
	});
}
function report_the(id, type) {
	// id = unique id of the message/comment
	// type = type of post: message/comment
	
	if(type == 0) {
		$('#comment'+id).html('<div class="message-reported"><div class="preloader-retina"></div></div>');
	} if(type == 1) {
		$('#message'+id).html('<div class="message-reported"><div class="preloader-retina-large preloader-center"></div></div>');
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/report.php",
		data: "id="+id+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			if(type == 0) {
				$('#comment'+id).html('<div class="message-reported">'+html+'</div>');
			} if(type == 1) {
				$('#message'+id).html('<div class="message-content"><div class="message-inner">'+html+'</div></div>');
			}
		}
	});
}
function subscribe(id, type, z) {
	// id = unique id of the viewed profile
	// type = if is set, is an insert/delete type
	// z if on, activate the sublist class which sets another margin (friends dedicated profile page)
	
	if(z == 1) {
		$('#subscribe'+id).html('<div class="sub-loading subslist"></div>');
	} else {
		$('#subscribe'+id).html('<div class="sub-loading"></div>');
	}
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/subscribe.php",
		data: "id="+id+"&type="+type+"&z="+z+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#subscribe'+id).html(html);
		}
	});
}
function deleteNotification(type, id) {
	if(type == 0) {
		$('#notification'+id).fadeOut(500, function() { $('#notification'+id).remove(); });
	} else if(type == 1) {
		$('#post_comment_'+id).fadeOut(500, function() { $('#post_comment_'+id).remove(); });
	}
}
function privacy(id, value, type) {
	// id = unique id of the message/comment
	// value = value to set on the post
	// type 0 = tracks, 1 = playlists
	if(type == 1) {
		var id_type = '-pl';
	} else {
		var id_type = '';
	}
	$('#privacy'+id_type+id).empty();
	$('#privacy'+id_type+id).html('<div class="loading-button"></div>');
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/privacy.php",
		data: "track="+id+"&value="+value+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#privacy'+id_type+id).empty();
			if(html == 1) {
				if(value == 1) {
					var newVal = 0;
					var newClass = 'public';
					$('#comment_box_'+id).show('slow');
				} else if(value == 0) {
					var newVal = 1;
					var newClass = 'private';
					$('#comment_box_'+id).hide('slow');
				}
			$('#privacy'+id_type+id).html('<div class="'+newClass+'-button" onclick="privacy('+id+', '+newVal+', '+type+')" title="This '+((type) ? 'playlist' : 'track')+' is '+newClass+'"></div>');
			}
		}
	});
}
function manage_the(start, type) {
	if(type == 2) {
		type = 'payments';
	} else if(type == 1) {
		type = 'reports';
	} else {
		type = 'users';
	}
	$('#more_'+type).html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/manage_"+type+".php",
		data: "start="+start+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#more_'+type).remove();
			
			// Append the new comment to the div id
			$('#'+type).append(html);
		}
	});
}
function manage_report(id, type, post, kind) {
	$('#report'+id).html('<div class="preloader-retina"></div>');
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/manage_reports.php",
		data: "id="+id+"&type="+type+"&post="+post+"&kind="+kind+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			if(html == '1') {
				$('#report'+id).fadeOut(500, function() { $('#message'+id).remove(); });
			} else {
				$('#report'+id).html('Sorry, but something went wrong, please refresh the page and try again.');
			}
		}
	});
}
function manage_categories(id, type) {
	// type 1 insert category, 0 delete category
	if(type == '0') {
		$('#category'+id).html('<div class="preloader-retina"></div>');
	} else {
		var id = $('#category').val();
		$('#category').val('');
		$('#add-category').html('<div class="load_more"><div class="preloader-retina-large preloader-center"></div></div>');
	}
	
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/manage_categories.php",
		data: "id="+id+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			if(type == '0') {
				if(html == '1') {
					$('#category'+id).fadeOut(500, function() { $('#category'+id).remove(); });
				} else {
					$('#category'+id).html('Sorry, but something went wrong, please refresh the page and try again.');
				}
			} else {
				$('#categories').prepend(html);
				$('#add-category').html('');
			}
		}
	});
}
function addDownload(id) {
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/download.php",
		data: "id="+id+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
		
		}
	});
}
function doLike(id, type) {
	// id = unique id of the message
	// type = 1 do the like, 2 do the dislike
	$('#like_btn'+id).html('<div class="small-loader"></div>');
	$('#doLike'+id).removeAttr('onclick');
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/like.php",
		data: "id="+id+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('#track-action'+id).empty();
			$('#track-action'+id).html(html);
		}
	});
}
function doBlock(id, type) {
	// id = unique id of the message
	// type 0: do nothing, just display the block, type 1: do/undo block
	$('.blocked-button').html('<div class="small-loader"></div>');
	$('#blocked'+id).remove();
	$.ajax({
		type: "POST",
		url: baseUrl+"/requests/block.php",
		data: "id="+id+"&type="+type+"&token_id="+token_id, 
		cache: false,
		success: function(html) {
			$('.blocked-button').html(html);
		}
	});
}
function showNotification(x, y) {
	// Y1: Show the global notifications
	// Y2: Show the messages notifications
	if(x == 'close') {
		$('.notification-container').hide();
		$('#messages_btn').removeClass('menu_hover_messages');
		$('#notifications_btn').removeClass('menu_hover_notifications');
		// Check the notification state
		// Prevent from double instance when loadpage
		if(notificationState == false) {
			checkNewNotifications();
		}
	} else {
		// Stop checking for new notifications while reading them
		clearTimeout(stopNotifications);
		notificationState = false;
		
		$('.notification-container').show();
		if(y == 1) {
			$('#notifications_btn').addClass('menu_hover_notifications');
			$('#notifications_btn').html(getNotificationImage());
			
			// Remove the other hovered class if exist
			$('#messages_btn').removeClass('menu_hover_messages');
			
			// Show-Hide the top urls for global and chat messages drop-downs
			$('#global_page_url').show();
			$('#chat_page_url').hide();
		} else {
			$('#messages_btn').addClass('menu_hover_messages');
			$('#messages_btn').html(getMessagesImageUrl(1));
			
			// Remove the other hovered class if exist
			$('#notifications_btn').removeClass('menu_hover_notifications');
			
			// Show-Hide the top urls for global and chat messages drop-downs
			$('#global_page_url').hide();
			$('#chat_page_url').show();
			
			var extra = '&for=1';
		}
		$('#notifications-content').html('<div class="menu-divider"></div><div class="notification-inner"><div class="preloader-normal preloader-dark"></div></div>');
		
		$.ajax({
			type: "POST",
			url: baseUrl+"/requests/check_notifications.php",
			data: "type=1"+extra+"&token_id="+token_id,
			cache: false,
			success: function(html) {
				if(html) {
					$('#notifications-content').html(html);
					jQuery("span.timeago").timeago();
				}
				if(extra) {
					$('#messages_url').removeAttr('onclick');
					$('#messages_url').attr('href', getMessagesImageUrl());
					$("#messages_url").attr("rel", "loadpage");
				}
			}
		});
	}
}
function progressHandler(event) {
	// Get the current progress
	var percent = ((event.loaded / event.total) * 100).toFixed(0);
	// Set the progress values
	$('#upload-pbv').css('width', percent+'%');
	$('#upload-pvt').text(percent);
	
	// Display the processing text
	if(percent == 100) {
		$('#upload-processing').show();
		$('#upload-text').hide();
	}
}
function completeHandler(event) {
	// Parse the response
	try {
		var response = JSON.parse(event.target.responseText);
	} catch(error) {
		var response = false;
	}
	
	// $('#track-upload').remove();
	
	// Reset the form and the select file buttons
	if(upload_form_reset == 1) {
		$('#track-upload')[0].reset();
		
		$('#cover-art').show();
		$('#cover-art-sel').hide();
		$('#upload-art-btn').removeClass('upload-btn-selected');
		
		$('#track-file').show();
		$('#track-file-sel').hide();
		$('#upload-track-btn').removeClass('upload-btn-selected');
		
		// Empty any extra files
		$('#extra-files').empty();
	}
	// Display the upload button
	$('#upload-button').show();
	
	// Return the response
	$('#upload-message').html(response.message);
	$('#upload-pb').hide();
	return true;
}
function errorHandler(event) {
	console.log(event);
}
function abortHandler(event) {
	console.log(event);
}
function startUpload(event) {
	// Prepare the request
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", baseUrl+"/requests/post_track.php");
	
	// Client side form validation check
	
	// Validate the tags input
	var tag_min = 0;
	var tag_max = 0;
	var upload_tags = $('input[name="tag"]').val();
	if(upload_tags == 0) {
		tag_min = 1;
	}
	if(upload_tags.split(',').length > 30) {
		tag_max = 1;
	}
	
	// Validate the title inputs
	var ttl_min = 0;
	var ttl_max = 0;
	var upload_titles = $('input[name="title[]"]');
	for(var i = 0; i < upload_titles.length; i++) {
		if(upload_titles[i].value.length < 1) {
			var ttl_min = 1;
		}
		if(upload_titles[i].value.length > 99) {
			var ttl_max = 1;
		}
	}
	
	// Validate the description input
	var desc_err = 0;
	if($('textarea[name="description"]').val().length > 5000) {
		var desc_err = 1;
	}
	
	// Validate the URL input
	var buy_err = 0;
	var buy_input = $('input[name="buy"]').val();
	if(buy_input.length > 0 ) {
		if(/^(http|https):\/\/[^ "]+$/.test(buy_input) == false) {
			var buy_err = 1;
		}
	}
	
	if(tag_min || tag_max || ttl_min || ttl_max || desc_err || buy_err) {
		// Do not reset the form
		upload_form_reset = 0;
		
		// Send out the request
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("error=1&tag_min="+tag_min+"&tag_max="+tag_max+"&ttl_min="+ttl_min+"&ttl_max="+ttl_max+"&desc="+desc_err+"&buy="+buy_err+"&token_id="+token_id);
	} else {
		// Reset the form
		upload_form_reset = 1;
		
		// Get the upload form
		var upload_form = $("#track-upload")[0];

		// Create a new form data object
		var formdata = new FormData(upload_form);

		// Send out the request
		ajax.send(formdata);
	}
	// Show the progress bar
	$('#upload-pb').show();
	$('#upload-processing').hide();
	$('#upload-text').show();
	
	// Hide the upload button
	$('#upload-button').hide();
}
function focus_form(id) {
	document.getElementById('comment-form'+id).focus();
	showButton(id);
}
function manageResults(x) {
	if(x == 0) {
		hideSearch();
	} else if(x == 1) {
		var q = $("#search").val();
		liveLoad('index.php?a=search&q='+q.replace(' ','+')+'&filter=tracks');
	} else if(x == 2) {
		var q = $("#search").val();
		liveLoad('index.php?a=explore&filter='+q.replace('#',''));
	}
}
function chatLiveSearch() {
	var q = $('#search-list').val();
	$('.sidebar-chat-list').empty();
	
	// If the text input is 0, remove everything instantly by setting the MS to 1
	
	$('.search-list-container').show();
	$('.search-list-container').html('<div class="search-content"><div class="message-inner"><div class="preloader-retina-large preloader-center"></div></div></div>');
	var ms = 200;
	
	// Start the delay (to prevent some useless queries)
	setTimeout(function() {
		if(q == $('#search-list').val()) {
			
			$.ajax({
				type: "POST",
				url: baseUrl+"/requests/load_people.php",
				data: 'q='+q+'&start=1&live=1&list=1&token_id='+token_id, // start is not used in this particular case, only needs to be set
				cache: false,
				success: function(html) {
					$('.search-list-container').html('');
					$('.sidebar-chat-list').html(html);
				}
			});
			
		}
	}, ms);
}
function profileCard(id, post, type, delay) {
	// ID: Unique user ID
	// Post: Unique Sound/Post ID
	// Type: 0 - Sound; 1 - Comment; 2 - Playlist; 3 - User
	// Delay: 0 - on mouse IN; 1 - on mouse OUT;
	if(delay == 1) {
		clearInterval(pcTimer);
	} else {
		pcTimer = setInterval(function() {
			if(type == 1) {
				var classType = 'comment';
				// The position to be increased
				var height = 45;
				var left = 0;
			} else if(type == 2) {
				var classType = 'playlist';
				var height = 60;
				var left = 120;
			} else if(type == 3) {
				var classType = 'user';
				var height = 25;
				var left = 70;
			} else {
				var classType = 'track';
				var height = 58;
				var left = 150;
			}
			
			// Start displaying the profile card with the preloader
			$('#profile-card').show();
			$('#profile-card').html('<div class="profile-card-padding"><div class="preloader-retina preloader-center"></div></div>');

			// Get the position of the parent element
			var position = $("#"+classType+post).position();
			
			// Store the position into an array
			var pos = {
				top: (position.top + height) + 'px',
				left: (position.left + left) + 'px'
			};
			
			// Set the position of the profile card
			$('#profile-card').css(pos);
			$.ajax({
				type: "POST",
				url: baseUrl+"/requests/load_profilecard.php",
				data: 'id='+id+"&token_id="+token_id,
				cache: false,
				success: function(html) {			
					$('#profile-card').html(html);
				},
				error: function() {
					$('#profile-card').hide();
				}
			});
			clearInterval(pcTimer);
		}, 500);
	}
}
function notificationTitle(type) {
	// Type 1: Play the New Chat Message notification
	if(!document.hasFocus()) {
		// If the current document title doesn't have an alert, add one
		if(document.title.indexOf('(!)') == -1) {
			document.title = '(!) ' + document.title;
		}
	}
}
function checkNewChat(x) {
	var uid = $('#chat').attr('class');
	if(uid === 'chat-user') {
		setTimeout(checkNewChat, chatr);
	} else {
		// Check whether uid is defined or not [prevent from making requests when leaving the chat page]
		if(uid) {
			$.ajax({
				type: "POST",
				url: baseUrl+"/requests/load_chat.php",
				data: "uid="+uid.replace('chat-user', '')+"&type=1&token_id="+token_id,
				success: function(html) {
					 // html is a string of all output of the server script.
					if(html) {
						$('.chat-container').append(html);
						jQuery("div.timeago").timeago();
						
						// Scroll at the bottom of the div (focus new content)
						$(".chat-container").scrollTop($(".chat-container")[0].scrollHeight);
					}
					if(!x) {
						setTimeout(checkNewChat, chatr);
					}
			   }
			});
		}
	}
}
function playerVolume() {
	// Delay the function for a second to get the latest style value
	setTimeout(function() {
		// Get the style attribute value
		var new_volume = $(".jp-volume-bar-value").attr("style");
		
		// Strip off the width text
		var new_volume = new_volume.replace("width: ", "");
		
		// Remove everything after the first two characters 00
		var new_volume = new_volume.substring(0, 2).replace(".", "").replace("%", "");
		
		if(new_volume.length == 1) {
			var new_volume = "0.0"+new_volume;
		} else if(new_volume.length == 2) {
			var new_volume = "0."+new_volume;
		}
		
		// Save the new volume value
		localStorage.setItem("volume", new_volume);
	}, 1);	
}
function getUrlParameter(id) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == id) {
            return sParameterName[1];
        }
    }
}
function dropdownMenu(type) {
	// 1: Reset the menu
	if(type) {
		$('.menu-image').removeClass('menu-image-active');
		$('#menu-dd-container').hide();
	} else {
		// Dropdown Menu Icon
		$('.menu-image').on("click", function() {
			$('.menu-image').toggleClass('menu-image-active');
			$('#menu-dd-container').toggle();
		});
		
		$(document).on("click", function(){
			// Hide the image drop-down menu
			dropdownMenu(1);
			
			// Hide the search results
			manageResults(0);
		});

		$(".menu-image, .search-results").on("click", function(e) {
			e.stopPropagation();
		});
	}
}
$(document).ready(function() {
	// Start loading
	dropdownMenu();
	
	$(document).on('keydown', 'input#chat', function(e) {
		if(e.keyCode==13) {
			// Store the message into var
			var message = $('input#chat').val();
			var id = $('#chat').attr('class');
			if(message) {
				// Remove chat errors if any
				$('.chat-error').remove();
				
				// Show the progress animation
				$('.header-loader').show();
				
				// Reset the chat input area			
				document.getElementById("chat").style.height = "25px";
				$('input#chat').val('');
				
				$.ajax({
					type: "POST",
					url: baseUrl+"/requests/post_chat.php",
					data: 'message='+encodeURIComponent(message)+'&id='+id.replace('chat-user', '')+"&token_id="+token_id,
					cache: false,
					success: function(html) {
						// Check if in the mean time any message was sent
						checkNewChat(1);
						
						// Append the new chat to the div chat container
						$('.chat-container').append(html);
						$('.header-loader').hide();
						
						jQuery("div.timeago").timeago();
						
						// Scroll at the bottom of the div (focus new content)
						$(".chat-container").scrollTop($(".chat-container")[0].scrollHeight);
					}
				});
			}
		}
	});
	
	$("#search").on('keyup', function(e) {
		var q = $('#search').val();
		
		if(typeof last_search != 'undefined') {
			if(q == last_search && e.which != 13) {
				return false;
			}
		}
		
		last_search = q;
		
		// If the query is empty, don't do anything
		if(q.length < 1) {
			hideSearch();
			return false;
		}
		
		// If the query starts with #, do not execute anything
		if(q == '#') {
			hideSearch();
			return false;
		}
		
		// Check the notification state
		if(typeof notificationState != 'undefined') {
			showNotification('close');
		}
		
		// Search if the hashtag is typed
		if(q.substring(0, 1) == '#') {
			var y = 'filter';
			var url = 'tags';
			var full_url = 'index.php?a=explore&'+y+'='+q.replace('#','');
		} else {
			var y = 'q';
			var url = 'people';
			var full_url = 'index.php?a=search&'+y+'='+q.replace(' ','+')+'&filter=tracks';
		}
		var data = 'q='+q+'&start=1&live=1';
			
		// If the text input is 0, remove everything instantly by setting the MS to 1
		if(q == 0) {
			var ms = 0;
		} else {
			$('.search-container').show();
			$('.search-container').html('<div class="search-content"><div class="search-results"><div class="message-inner"><div class="retrieving-results">Retrieving Results</div> <div class="preloader-left preloader-dark"></div></div></div></div>');
			var ms = 200;
		}
		
		if(e.which == 13) {
			liveLoad(full_url);
			hideSearch();
			return false;
		}
		
		// Start the delay (to prevent some useless queries)
		setTimeout(function() {
			if(q == $('#search').val()) {
				if(q == 0) {
					hideSearch();
				} else {
					$.ajax({
					type: "POST",
					url: baseUrl+"/requests/load_"+url+".php",
					data: data+'&token_id='+token_id, // start is not used in this particular case, only needs to be set
					cache: false,
					success: function(html) {
						$(".search-container").html(html).show();
					}
					});
				}
			}
		}, ms);
	});
	
	$(document).on('keyup', "#search-list", chatLiveSearch);
	
	$('#values input:radio').addClass('input_hidden');
	$('#values label').click(function() {
		$(this).addClass('selected').siblings().removeClass('selected');
		$('#form-value').attr("Placeholder", $(this).attr('title'));
		$('#form-value').val('');
		$('#my_file').val('');
		$('.message-form-input').show('slow');
		$('.selected-files').hide('slow');
	});
	
	$('#my_file').click(function() {
		$('#form-value').val('');
		$('.message-form-input').hide('slow');
		$('.selected-files').show('slow');
		$('#values label').removeClass('selected');
	});
	
	$(document).on('change', '#upload-art:file', function() {
		if(this.files.length == 0) {
			$('#cover-art').show();
			$('#cover-art-sel').hide();
			$('#upload-art-btn').removeClass('upload-btn-selected');
		} else {
			$('#cover-art').hide();
			$('#cover-art-sel').show();
			$('#upload-art-btn').addClass('upload-btn-selected');
		}
	});
	
	$(document).on('change', '#upload-track:file', function() {
		$('#extra-files').empty();
		for(var i = 0; i < this.files.length; ++i) {
			var track_name = this.files.item(i).name.replace(/C:\\fakepath\\/i, '').replace(/.mp3/i, '').replace(/.m4a/i, '');
			var track_original = this.files.item(i).name;
			if(i > 0) {
				$('#extra-files').append('<div class="track-info-container"><div class="track-info-inputs"><div class="track-info-input" style="padding: 0; margin-top: -5px;"><!--<div class="track-info-title">'+track_original+'</div>--><input type="text" name="title[]" value="'+track_name+'"></div></div></div><div class="divider"></div>');
			} else {
				$('#track-title').val(track_name);
			}
		}
		
		if(this.files.length == 0) {
			$('#track-file').show();
			$('#track-file-sel').hide();
			$('#upload-track-btn').removeClass('upload-btn-selected');
			$('#extra-files').empty();
		} else {
			$('#track-file').hide();
			$('#track-file-sel').show();
			$('#upload-track-btn').addClass('upload-btn-selected');
		}
	});
	
	$(document).on('click', '#license-nc', function() {
		if($('input[name='+this.id+']').val() == 1) {
			$('#'+this.id).removeClass('license-box-active');
			$('.'+this.id+', .'+this.id+'-icon', '#license-container').hide();
			$('input[name='+this.id+']').val(0);
		} else {
			$('#'+this.id).addClass('license-box-active');
			$('.'+this.id+', .'+this.id+'-icon', '#license-container').show();
			$('input[name='+this.id+']').val(1);
		}
	});
	
	$(document).on('click', '#license-nd', function() {
		if($('input[name=license-nd-sa]').val() == 1) {
			$('#'+this.id).removeClass('license-box-active');
			$('.'+this.id+', .'+this.id+'-icon', '#license-container').hide();
			$('input[name=license-nd-sa]').val(0);
		} else {
			$('#'+this.id).addClass('license-box-active');
			$('.'+this.id+', .'+this.id+'-icon').show();
			$('#license-sa').removeClass('license-box-active');
			$('.license-sa, .license-sa-icon', '#license-container').hide();
			$('input[name=license-nd-sa]').val(1);
		}
	});
	
	$(document).on('click', '#license-sa', function() {
		if($('input[name=license-nd-sa]').val() == 2) {
			$('#'+this.id).removeClass('license-box-active');
			$('.'+this.id+', .'+this.id+'-icon', '#license-container').hide();
			$('input[name=license-nd-sa]').val(0);
		} else {
			$('#'+this.id).addClass('license-box-active');
			$('.'+this.id+', .'+this.id+'-icon').show();
			$('#license-nd').removeClass('license-box-active');
			$('.license-nd, .license-nd-icon', '#license-container').hide();
			$('input[name=license-nd-sa]').val(2);
		}
	});
	
	// Allow volume bar dragging
	$(document).on('mousedown', '.jp-volume-bar', function() {
		var parentOffset = $(this).offset(),
			width = $(this).width();
			$(window).mousemove(function(e) {
				var x = e.pageX - parentOffset.left,
				volume = x/width
				if (volume > 1) {
					$("#sound-player").jPlayer("volume", 1);
				} else if (volume <= 0) {
					$("#sound-player").jPlayer("mute");
				} else {
					$("#sound-player").jPlayer("volume", volume);
					$("#sound-player").jPlayer("unmute");
				}
				playerVolume();
			});
		return false;
	});
	$(document).on('mouseup', function() {
		$(window).unbind("mousemove");
	});
	
	$(document).on('click', '.scroll_to', function(event) {
		event.preventDefault();
		$('#'+$(this).data("section")).scrollIntoView(55);
	});
	
	// Disable the enter key on login/register forms
	$('#register-form').submit(function() {
		connect(0);
		return false;
	});
	$('#login-form').submit(function() {
		connect(1);
		return false;
	});
	$('.facebook-button').on('click', function() {
		$('.modal-loading').show();
	});
	
	$(document).on('click', '.notification-close-error, .notification-close-warning, .notification-close-success, .notification-close-info', function() {
		$(this).parent().fadeOut("slow"); return false;
	});
	
	$(document).on('click touchend', '.track', function(e) {
		var track = $(this).data('track-name');
		var id = $(this).data('track-id');

		playSong(track, id);
		e.preventDefault();
	});
	
	$('#privacy-btn').on('click', function() {
		if($('#message-privacy').val() == 1) {
			$('#message-privacy').val('0');
			$('#privacy-btn').addClass('message-private-active');
			$('#privacy-btn').attr('title', 'Private message');
		} else {
			$('#message-privacy').val('1');
			$('#privacy-btn').removeClass('message-private-active');
			$('#privacy-btn').attr('title', 'Public message');
		}
	});
	
	// When the window is focused
	$(window).focus(function() {
		// If the currentTitle has the (!) notification, then remove it
		if(document.title.indexOf('(!)') >= 0) {
			document.title = document.title.replace("(!) ", "");
		}
	});
	
	// When the window is fully loaded
	$(window).load(function() {
		updateCssBoxes();
	});
	
	// When the window is resized
	$(window).resize(function () {
		updateCssBoxes();
	});

	// Start the player keyboard controls
	$(document).on("keydown", function(key) {
		if(key.keyCode == 32) {
			if($('input:focus, textarea:focus').length == 0) {
				// Prevent the key action
				key.preventDefault();
				if($("#sound-player").data('jPlayer').status.paused) {
					$("#sound-player").jPlayer('play');
				} else {
					$("#sound-player").jPlayer('pause');
				}
			}
		}
		if(key.keyCode == 39) {
			if($('input:focus, textarea:focus').length == 0) {
				// Prevent the key action
				key.preventDefault();
				$('#next-button').click();
			}
		}
		if(key.keyCode == 37) {
			if($('input:focus, textarea:focus').length == 0) {
				// Prevent the key action
				key.preventDefault();
				$('#prev-button').click();
			}
		}
		if(key.keyCode == 77) {
			if($('input:focus, textarea:focus').length == 0) {
				// Prevent the key action
				key.preventDefault();
				if($('.jp-unmute').is(':hidden')) {
					$('.jp-mute').click();
				} else {
					$('.jp-unmute').click();
				}
			}
		}
		if(key.keyCode == 77) {
			if($('input:focus, textarea:focus').length == 0) {
				// Prevent the key action
				key.preventDefault();
				if($('.jp-unmute').is(':hidden')) {
					$('.jp-mute').click();
				} else {
					$('.jp-unmute').click();
				}
			}
		}
		if(key.keyCode == 82) {
			if($('input:focus, textarea:focus').length == 0) {
				// Prevent the key action
				key.preventDefault();
				if($('.jp-repeat-off').is(':hidden')) {
					$('.jp-repeat').click();
				} else {
					$('.jp-repeat-off').click();
				}
			}
		}
	});
	
	// Enable infinite scrolling when on desktop
	if(/Mobi/.test(navigator.userAgent) == false) {
		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() == $(document).height()) {
				$('#infinite-load').click();
			}
		});
	}
	
	// Set the player volume
	if(localStorage.getItem("volume") === null) {
		localStorage.setItem("volume", player_volume);
	} else {
		player_volume = localStorage.getItem("volume");
	}

	reload();
});
function liveLoad(pageurl, type, parameters) {
	// page url = request url
	// type = 1: POST; 0: GET;
	// parameters: serialized params
	startLoadingBar();
	
	if(type == 1) {
		var type = "POST";
	} else {
		var type = "GET";
	}
	
	// Replace the path of the url from index to the path with raw content
	var custom = pageurl;
	var custom = custom.replace('index', 'page');
	
	// Request the page
	$.ajax({url: custom, type: type, data: parameters, success: function(data) {
		// Show the content
		$('#content').html(data);
		// Stop the loading bar
		stopLoadingBar();
		// Set the new title tag
		document.title = $('#page-title').html();
		// Scroll the document at the top of the page
		$(document).scrollTop(0);
		// Reload functions
		reload();
	}});
	
	// Store the url to the last page accessed
	if(pageurl != window.location) {
		window.history.pushState({path:pageurl},'',pageurl);	
	}
	return false;
}
function sendForm() {
	$('form#general').submit();
}
function hideModal() {
	$('#share, #playlist, #delete, #connect').fadeOut();
	$('.modal-background').fadeOut();
	$('.tab-share,.tab-embed,.tab-delete,.tab-login,.tab-register').fadeOut();
	$('#autoplay').prop('checked', false);
}
function hideSearch() {
	$(".search-container").hide();
	$(".search-content").remove();
}
function reload() {
	jQuery(".timeago").timeago();
	autosize();
	prevnext();
	// Reset menu, search
	dropdownMenu(1);
	manageResults(0);
	hideModal();
	
	$('#share, #playlist, #delete, #connect').fadeOut();
	$('.modal-background').fadeOut();
	
	// Add active class on Explore, Stream buttons
	$('#explore-button').attr('class', 'menu-button');
	$('#stream-button').attr('class', 'menu-button');
	if(getUrlParameter('a') == 'explore') {
		$('#explore-button').addClass('menu-button-active');
	} else if(getUrlParameter('a') == 'stream') {
		$('#stream-button').addClass('menu-button-active');
	}
	
	// Check the notification state
	if(typeof notificationState != 'undefined') {
		showNotification('close');
	}
	
	// Reset the search value
	if(window.location.search.indexOf('a=search') == -1 && window.location.search.indexOf('a=explore&filter=') == -1) {
		$("#search").val('');
	}
	
	// Update the dynamic boxes
	updateCssBoxes();
	
	// Reload the profile card event
	$('#profile-card').on("mouseleave", function() {
		$('#profile-card').hide();
	});
	
	// Reload the Auto-Select share-url input
	$("#share-url, #embed-url").on("click", function () {
		$(this).select();
	});
	
	// On modal background click, hide it
	$('.modal-background').on("click", function() {
		hideModal();
	});
	
	// Modal menu items
	$('.modal-menu-item').click(function() {
		$(this).addClass('modal-menu-item-active').siblings().removeClass('modal-menu-item-active');
		$('.tab-share,.tab-embed,.tab-playlist,.edit-general,.edit-metadata,.edit-permissions,.edit-reports,.edit-payments,.edit-delete,.tab-delete,.tab-login,.tab-register').hide();
		$('.'+$(this).attr('id')).show();
	});
	
	// Edit menu items
	$('.edit-menu-item').click(function() {
		$(this).addClass('edit-menu-item-active').siblings().removeClass('edit-menu-item-active');
		$('.edit-general,.edit-registration,.edit-limits,.edit-emails,.edit-metadata,.edit-permissions,.edit-payments,.edit-reports,.edit-delete,.stats-tracks,.stats-users,.stats-geographic').hide();
		$('.'+$(this).attr('id')).show();
	});
	
	// Embed Autoplay check
	$('#autoplay').on('click', function() {
		// Set the embed url value into a jquery selector in order to parse the src attr
		var embed = $($('#embed-url').val());
		
		// Set embed url input content
		var iframe = $('#embed-url').val();

		if($('#autoplay').is(':checked')) {
			$('#embed-url').val(iframe.replace(embed.attr('src'), embed.attr('src')+'&autoplay=true'));
		} else {
			$('#embed-url').val(iframe.replace('&autoplay=true', ''));
		}
	});
	
	if($('#selection-cc').is(':checked')) {
		$('#license-container').show();
	} else {
		$('#license-container').hide();
	}
	
	$('#selection-cc, #selection-ar').on('click', function() {
		if($('#selection-cc').is(':checked')) {
			$('#license-container').show();
		} else {
			$('#license-container').hide();
		}
	});
	
	if($('input[name=license-nc]').val() == 1) {
		$('#license-nc').addClass('license-box-active');
		$('.license-nc, license-nc-icon').show();
	} else {
		$('#license-nc').removeClass('license-box-active');
		$('.license-nc, #license-container .license-nc-icon').hide();
	}
	
	if($('input[name=license-nd-sa]').val() == 1) {
		$('#license-nd').addClass('license-box-active');
		$('.license-nd, .license-nd-icon').show();
		$('.license-sa, #license-container .license-sa-icon').hide();
	} else if($('input[name=license-nd-sa]').val() == 2) {
		$('#license-sa').addClass('license-box-active');
		$('.license-sa, .license-sa-icon').show();
		$('.license-nd, #license-container .license-nd-icon').hide();
	} else {
		$('#license-nd, #license-sa').removeClass('license-box-active');
		$('.license-nd, .license-sa, #license-container .license-nd-icon, #license-container .license-sa-icon').hide();
	}
	
	// If there's a comment #highlighted
	if(window.location.hash) {
		var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
		// If the hashtag is a comment 
		if(hash.indexOf("comment") > -1) {
			$('#'+hash).addClass('comment-active');
		}
	}
}
function updateCssBoxes() {
	// Set the +sign height and line-height
	 $('#online-plus .plus-button').height($('.sidebar-online-users-padding').height()-7);
	 $('#online-plus .plus-sign').css("line-height", $('.sidebar-online-users-padding').height()-9+'px');
	
	// Set the height of the social icons containers
	$('.social-icon').height($('.social-icon').width());
}
function getExtension(filename) {
    var ext = filename.split('.').pop().toLowerCase();
	
	// if the format is mp4, switch it to m4a since mp4 can be audio only
	if(ext == 'mp4') {
		ext = 'm4a';
	}
	return ext;
}
function formSubmit(id) {
	document.getElementById(id).submit();
}
$.fn.scrollIntoView = function(padding, duration, easing) {	
    $('html,body').animate({
        scrollTop: this.offset().top-padding
    }, duration, easing);
    return this;
};
function startLoadingBar() {
	// only add progress bar if added yet.
	$("#loading-bar").show();
	$("#loading-bar").width((50 + Math.random() * 30) + "%");
}
function stopLoadingBar() {
	//End loading animation
	$("#loading-bar").width("101%").delay(200).fadeOut(400, function() {
		$(this).width("0");
	});
}
function pauseSong() {
	$("#sound-player").jPlayer('pause');
}
function repeatSong(type) {
	// Type 0: No repeat
	// Type 1: Repeat
	if(type == 1) {
		$('#repeat-song').html('1');
	} else {
		$('#repeat-song').html('0');
	}
}
function nextSong(id) {
	// Get the next song element
	var nextSong = $('.current-song').closest('#track'+id).next().find('.track');
	
	// Get the next song element id
	var nextId = nextSong.attr('id');
	
	// If one is available, move to the next track
	if(nextId) {
		document.getElementById(nextId).click();
	}
}
function prevnext(type) {
	// Type 1: Previous Track
	// Type 2: Next Track
	// Type 3: Auto new tracks load when last track
	var currentId = $('.current-song').attr('id');
	
	var nextSong = $('.current-song').closest('#'+currentId).next().find('.track');
	var nextId = nextSong.attr('id');
	
	if(type == 3) {
		// If there's no next track available
		if(!nextId) {
			// If currently on the pages that have tracks with "Load More" buttons
			if(window.location.search.indexOf('a=stream') > -1 || window.location.search.indexOf('a=explore') > -1 || (window.location.search.indexOf('a=profile') > -1 && window.location.search.indexOf('r=subscriptions') == -1) || (window.location.search.indexOf('a=profile') > -1 && window.location.search.indexOf('r=subscribers') == -1) || (window.location.search.indexOf('a=profile') > -1 && window.location.search.indexOf('r=playlists') == -1) || (window.location.search.indexOf('a=search') > -1 && window.location.search.indexOf('&filter=tracks') > -1)) {
				$('#infinite-load').click();
			}
		}
		return false;
	}
	var prevSong = $('.current-song').closest('#'+currentId).prev().find('.track');
	var prevId = prevSong.attr('id');
	
	if(prevId) {
		$('#prev-button').removeClass('prev-button-disabled');
		$('#prev-button').attr('onclick', 'prevnext(1)');
		if(type == 1) {
			document.getElementById(prevId).click();
			return;
		}
	} else {
		$('#prev-button').addClass('prev-button-disabled');
		$('#prev-button').removeAttr('onclick');
	}
	
	if(nextId) {
		$('#next-button').removeClass('next-button-disabled');
		$('#next-button').attr('onclick', 'prevnext(2)');
		if(type == 2) {
			document.getElementById(nextId).click();
			return;
		}
	} else {
		$('#next-button').addClass('next-button-disabled');
		$('#next-button').removeAttr('onclick');
	}
}
$(function() {
	$("body").on("click", "a[rel='loadpage']", function(e) {
		// Get the link location that was clicked
		
		startLoadingBar();
		pageurl = $(this).attr('href');
		
		// Replace the path of the url from index to the path with raw content
		var custom = pageurl;
		var custom = custom.replace('index', 'page');
		
		// Request the page
		$.ajax({url:custom,success: function(data) {
			// Show the content
			$('#content').html(data);
			// Stop the loading bar
			stopLoadingBar();
			// Set the new title tag
			document.title = $('#page-title').html();
			// Scroll the document at the top of the page
			$(document).scrollTop(0);
			// Reload functions
			reload();
			// Update the Track Information
			updateTrackInfo(nowPlaying);
		}});
		
		// Store the url to the last page accessed
		if(pageurl != window.location){
			window.history.pushState({path:pageurl}, '', pageurl);	
		}
		return false;
	});
});

// Override the back button to get the ajax content via the back content */
$(window).bind('popstate', function(ev) {
	startLoadingBar();
	// Replace the path of the url from index to the path with raw content
	var custom = location.href;
	
	// Check whether the page contains index.php or not, if it doens't then add one (prevent breaking when loading website without index.php
	if(custom.indexOf("index.php") == -1) {
		var custom = location.href + '/index.php';
	}
	var custom = custom.replace('index', 'page');
	
	// Request the page
	$.ajax({url:custom,success: function(data){
		// Show the content
		$('#content').html(data);
		// Stop the loading bar
		stopLoadingBar();
		// Set the new title tag
		document.title = $('#page-title').html();
		// Scroll the document at the top of the page
		$(document).scrollTop(0);
		// Reload functions
		reload();
		// Update the Track Information
		updateTrackInfo(nowPlaying);
	}});
});