<?php
//======================================================================\\
// Author: Pricop Alexandru                                             \\
// Website: http://pricop.info                                          \\
// Email: pricop2008@yahoo.com                                          \\
// Language: English                                                    \\
//======================================================================\\

$LNG['user_success'] = 'User succesfully created';
$LNG['user_exists'] = 'This username already exists';
$LNG['email_exists'] = 'This e-mail is already in use';
$LNG['all_fields'] = 'All fields are required';
$LNG['user_alnum'] = 'The username must consists only from letters and numbers';
$LNG['user_too_short'] = 'The username must be between 3 and 32 characters';
$LNG['user_limit'] = 'Too many accounts created from this IP';
$LNG['invalid_email'] = 'Invalid e-mail';
$LNG['invalid_user_pw'] = 'Invalid username or password';
$LNG['invalid_captcha'] = 'Invalid captcha';
$LNG['log_out'] = 'Log Out';
$LNG['hello'] = 'Hello';
$LNG['connect'] = 'Connect';
$LNG['register'] = 'Register';
$LNG['login'] = 'Login';
$LNG['password'] = 'Password';
$LNG['username'] = 'Username';
$LNG['email'] = 'Email';
$LNG['captcha'] = 'Captcha';
$LNG['username_or_email'] = 'Username or email';
$LNG['welcome_desc'] = 'share your music, connect with artists, explore new content';
$LNG['join_now'] = 'Join now';
$LNG['learn_more'] = 'Learn More';
$LNG['creators'] = 'Creators';
$LNG['listeners'] = 'Listeners';
$LNG['audience'] = 'Audience';
$LNG['organize'] = 'Organize';
$LNG['featured'] = 'Featured';
$LNG['popular'] = 'Popular';
$LNG['latest'] = 'Latest';
$LNG['upload_desc'] = 'Upload your sounds, music, podcasts to the world';
$LNG['audience_desc'] = 'Connect with our community and increase your audience';
$LNG['statistics_desc'] = 'Get to know your audience with advanced statistics';
$LNG['explore_desc'] = 'Explore new music, discover new people and engage with artists';
$LNG['share_desc'] = 'Share your favorite music with your friends on social networks';
$LNG['organize_desc'] = 'Create playlists and organize your music the way you like';
$LNG['forgot_password'] = 'Forgot your password?';
$LNG['all_rights_reserved'] = 'All rights reserved';

// NOTIFICATION BOXES //
$LNG['settings_saved'] = 'Settings Saved';
$LNG['password_changed'] = 'Password Changed';
$LNG['nothing_changed'] = 'Nothing Changed';
$LNG['password_not_changed'] = 'Your password was not changed.';
$LNG['wrong_current_password'] = 'The current password you\'ve entered is incorrect.';
$LNG['image_saved'] = 'Image Saved';
$LNG['profile_picture_saved'] = 'Your profile image has been changed.';
$LNG['error'] = 'Error';
$LNG['no_file'] = 'You did not selected any files to be uploaded, or the selected file(s) are empty.';
$LNG['file_exceeded'] = 'The selected file size must not exceed <strong>%s</strong> MB.';
$LNG['file_format'] = 'The selected file format is not supported. Upload <strong>%s</strong> file format';
$LNG['image_removed'] = 'Image Removed';
$LNG['profile_picture_removed'] = 'Your profile picture has been removed.';
$LNG['profile_description'] = 'The profile description should be %s characters or less.';
$LNG['playlist_description'] = 'The playlist description should be %s characters or less.';
$LNG['playlist_name_empty'] = 'The playlist name cannot be empty.';
$LNG['changes_saved'] = 'Changes successfully saved.';
$LNG['valid_email'] = 'Please enter a valid email.';
$LNG['valid_url'] = 'Please enter a valid URL format.';
$LNG['valid_country'] = 'Please enter a valid country';
$LNG['background_changed'] = 'The background has been successfully changed.';
$LNG['background_not_changed'] = 'The background could not be changed.';
$LNG['password_too_short'] = 'The password must contain at least <strong>6</strong> characters.';
$LNG['password_not_match'] = 'The password did not match.';
$LNG['username_not_found'] = 'We couldn\'t find the choosed username.';
$LNG['userkey_not_found'] = 'The username or the reset key are wrong, make sure you\'ve entered the correct information.';
$LNG['email_reset'] = 'An email containing password reset instructions has been sent. Please allow us up to 24 hours to deliver the message, also check your Spam box if you can\'t find in your Inbox.';
$LNG['user_deleted'] = 'User Deleted';
$LNG['user_has_been_deleted'] = 'User <strong>%s</strong> has been deleted.';
$LNG['user_not_deleted'] = 'The selected user (ID: %s) could not be deleted.';
$LNG['user_not_exist'] = 'The selected user does not exist.';
$LNG['payment_not_exist'] = 'The selected Payment ID does not exist.';
$LNG['report_not_exist'] = 'The selected Report ID does not exist.';
$LNG['theme_changed'] = 'Theme changed';
$LNG['notif_saved'] = 'Notifications changed';
$LNG['notif_success_saved'] = 'Notifications has been successfully updated.';
$LNG['password_reset'] = 'You have successfully reset your password. You can now log-in using the new password.';

// MAIL CONTENT //
$LNG['welcome_mail'] = 'Welcome to %s';
$LNG['email_footer_unsub'] = '<br /><br /><span style="color: #aaa;">This email was sent automatically, if you don\'t want to receive these type of emails from <strong>%s</strong> in the future, please <a href="%s">Unsubscribe</a>.</span>';
$LNG['email_footer_gen'] = '<br /><br /><span style="color: #aaa;">Copyright &copy; '.date('Y').' <a href="%s">%s</a>. All rights reserved.';
$LNG['email_hello'] = 'Hello <strong>%s</strong>,<br /><br />';
$LNG['user_created'] = 'Thank you for joining <strong>%s</strong><br /><br />Your username: <strong>%s</strong><br />Your Password: <strong>%s</strong><br /><br />You can log-in at: <a href="%s" target="_blank">%s</a>'.$LNG['email_footer_gen'];
$LNG['recover_mail'] = 'Password Recovery';
$LNG['recover_content'] = 'A password recover was requested, if you didn\'t make this action please ignore this email. <br /><br />Your Username: <strong>%s</strong><br />Your Reset Key: <strong>%s</strong><br /><br />You can reset your password by accessing the following link: <a href="%s" target="_blank">%s</a>'.$LNG['email_footer_gen'];
$LNG['ttl_comment_email'] = '%s commented on your track';
$LNG['comment_email'] = $LNG['email_hello'].'<strong><a href="%s">%s</a></strong> has commented on your <strong><a href="%s">track.</a></strong>'.$LNG['email_footer_unsub'];
$LNG['ttl_like_email'] = '%s liked your track';
$LNG['like_email'] = $LNG['email_hello'].'<strong><a href="%s">%s</a></strong> liked your <strong><a href="%s">track.</a></strong>'.$LNG['email_footer_unsub'];
$LNG['ttl_new_friend_email'] = '%s added you as friend';
$LNG['new_friend_email'] = $LNG['email_hello'].'<strong><a href="%s">%s</a></strong> added you as friend.'.$LNG['email_footer_unsub'];
$LNG['ttl_copyright_notification'] = 'Copyright Claim - %s';
$LNG['copyright_mail_0'] = $LNG['email_hello'].'Your track <a href="%s">%s</a> has been suspended due to a copyright claim by <a href="%s">%s</a>. If you think this was an error, please contact us. Case ID: %s'.$LNG['email_footer_gen'];
$LNG['copyright_mail_1'] = $LNG['email_hello'].'The infringing track <a href="%s">%s</a> has been suspended. Thank you. Case ID: %s'.$LNG['email_footer_gen'];
$LNG['ttl_suspended_account_mail'] = 'Your account has been suspended';
$LNG['suspended_account_mail'] = $LNG['email_hello'].'Your account has been suspended. If you think this was an error, please contact us.'.$LNG['email_footer_gen'];

// ADMIN PANEL //
$LNG['general_link'] = 'General';
$LNG['security_link'] = 'Security';
$LNG['manage_users'] = 'Manage Users';

$LNG['theme_install'] = 'To install a new theme, upload it on the <strong>themes</strong> folder.';
$LNG['theme_author_homepage'] = 'Visit the author homepage';
$LNG['theme_version'] = 'Version';
$LNG['theme_active'] = 'Active';
$LNG['theme_activate'] = 'Activate';
$LNG['by'] = 'By';

// STREAM //
$LNG['welcome_stream_ttl'] = 'Welcome to your Stream';
$LNG['welcome_stream'] = 'All tracks from your friends will appear on this page, start by making new friends.';
$LNG['leave_comment'] = 'Leave a comment...';
$LNG['post'] = 'Post';
$LNG['view_more_comments'] = 'View more comments';
$LNG['this_track_private'] = 'This track is private';
$LNG['this_track_public'] = 'This track is public';
$LNG['this_playlist_private'] = 'This playlist is private';
$LNG['this_playlist_public'] = 'This playlist is public';
$LNG['delete_this_comment'] = 'Delete this comment';
$LNG['delete_this_message'] = 'Delete this message';
$LNG['report_this_track'] = 'Report this track';
$LNG['report_this_comment'] = 'Report this comment';
$LNG['load_more'] = 'Load More';
$LNG['view_more'] = 'View More';
$LNG['comment_wrong'] = 'Something went wrong, please refresh the page and try again.';
$LNG['comment_too_long'] = 'Sorry, but the maximum characters allowed per comment is <strong>%s</strong>.';
$LNG['comment_error'] = 'Sorry, we couldn\'t post the comment, please refresh the page and try again.';
$LNG['track_hidden_1'] = 'Sorry, but this track is private, only the author of the track can see it.';
$LNG['track_hidden_2'] = 'Sorry, but this author\'s profile settings only allows his followers to view this track.';
$LNG['track_hidden_1_ttl'] = $LNG['track_hidden_2_ttl'] = 'Private Track';
$LNG['track_suspended_1'] = 'Sorry, but this track has been disabled due to a copyright infringement claim. If you think this was an error, please contact us.';
$LNG['track_suspended_1_ttl'] = 'Disabled track';
$LNG['playlist_hidden'] = 'Sorry, but this playlist is private, only the author of the playlist can see it.';
$LNG['playlist_hidden_ttl'] = 'Private Playlist';
$LNG['comment'] = 'Comment';
$LNG['share'] = 'Share';
$LNG['autoplay'] = 'Autoplay';
$LNG['add_to'] = 'Add to';
$LNG['buy'] = 'Buy';
$LNG['download'] = 'Download';
$LNG['new_playlist'] = 'Create new playlist';
$LNG['cancel'] = 'Cancel';
$LNG['close'] = 'Close';

// REPORT //
$LNG['1_not_exists'] = 'The reported track does not exist.';
$LNG['0_not_exists'] = 'The reported comment does not exist.';
$LNG['1_already_reported'] = 'This track has already been reported and it will be reviewed in the shortest time, thank you.';
$LNG['0_already_reported'] = 'This comment has already been reported and it will be reviewed in the shortest time, thank you.';
$LNG['1_is_safe'] = 'This track is marked as <strong>safe</strong> by an administrator, thank you for your feedback.';
$LNG['0_is_safe'] = 'This comment is marked as <strong>safe</strong> by an administrator, thank you for your feedback.';
$LNG['1_report_added'] = 'The track has been reported, thank you for your feedback.';
$LNG['0_report_added'] = 'The comment has been reported, thank you for your feedback.';
$LNG['1_report_error'] = 'Sorry but something went wrong while reporting this track, please refresh the page and try again.';
$LNG['0_report_error'] = 'Sorry but something went wrong while reporting this comment, please refresh the page and try again.';
$LNG['1_is_deleted'] = 'The track has been removed, thank you for your feedback.';
$LNG['0_is_deleted'] = 'The comment has been removed, thank you for your feedback.';
$LNG['deleted_track'] = 'The track has been deleted.';
$LNG['deleted_comment'] = 'The comment has been deleted.';
$LNG['suspended_track'] = 'The track has been suspended.';
$LNG['restored_track'] = 'The track has been restored.';
$LNG['safe_report'] = 'The report has been marked as safe.';
$LNG['rci'] = 'Report copyright infringement';
$LNG['report_track'] = 'Report track';
$LNG['signature'] = 'Signature';
$LNG['sub_signature'] = 'Typing your full name in this box acts as your electronic signature';
$LNG['report_description'] = 'Please identify, in as much detail as possible, the copyright work(s) that you believe are being infringed';
$LNG['report1'] = 'I have a good faith belief that use of the copyrighted work described above is not authorized by the copyright owner, its agent or the law';
$LNG['report2'] = 'I confirm that the information in this notification is accurate';
$LNG['report3'] = 'I confirm that I am the copyright owner or am authorised to act on behalf of the owner of an exclusive right that is allegedly infringed. Where I am making notice pursuant to the United States Digital Millennium Copyright Act U.S.C. 17 &sect;512(c), I make this statement under penalty of perjury';
$LNG['rep_resc_error'] = 'The description should be less than %s characters';
$LNG['abusive_comment'] = 'Abusive Comment';
$LNG['copyright_infringement'] = 'Copyright Infringement';
$LNG['claimant'] = 'Claimant';
$LNG['infringing_material'] = 'Infringing Material';
$LNG['reported_by'] = 'Reported by';
$LNG['delete_track'] = 'Delete Track';
$LNG['delete_comment'] = 'Delete Comment';
$LNG['delete_report'] = 'Delete Report';
$LNG['suspend_track'] = 'Suspend Track';
$LNG['restore_track'] = 'Restore Track';
$LNG['view_comment'] = 'View Comment';

// SIDEBAR //
$LNG['filter_notifications'] = 'Filter Notifications';
$LNG['archive'] = 'Archives';
$LNG['statistics'] = 'Statistics';
$LNG['all_notifications'] = 'All notifications';
$LNG['all_time'] = 'All time';
$LNG['subscriptions'] = 'Following';
$LNG['subscribers'] = 'Followers';
$LNG['welcome'] = 'Welcome';
$LNG['sidebar_people'] = 'People';
$LNG['sidebar_tracks'] = 'Tracks';
$LNG['sidebar_playlists'] = 'Playlists';
$LNG['online_friends'] = 'Online Friends';
$LNG['sidebar_likes'] = 'Likes';
$LNG['sidebar_comments'] = 'Comments';
$LNG['sidebar_friendships'] = 'Friendships';
$LNG['sidebar_chats'] = 'Chats';
$LNG['sidebar_suggestions'] = 'Friends Suggestions';
$LNG['sidebar_trending'] = 'Trending Tags';
$LNG['sidebar_friends_activity'] = 'Friends Activity';
$LNG['edit_track'] = 'Edit Track';
$LNG['edit_playlist'] = 'Edit Playlist';
$LNG['go_back'] = 'Go Back';

// MESSAGES / CHAT //
$LNG['lonely_here'] = 'It\'s lonely here, how about making some friends?';
$LNG['write_message'] = 'Write a message...';
$LNG['chat_too_long'] = 'Sorry, but the maximum characters allowed per chat message is <strong>%s</strong>.';
$LNG['blocked_by'] = 'The message could not be sent. <strong>%s</strong> blocked you.';
$LNG['blocked_user'] = 'The message could not be sent. You\'ve blocked <strong>%s</strong>.';
$LNG['chat_self'] = 'Sorry but we cannot deliver chat messages to yourself.';
$LNG['chat_no_user'] = 'You must select a user to chat with.';
$LNG['view_more_conversations'] = 'View more conversations';
$LNG['block'] = 'Block';
$LNG['unblock'] = 'Unblock';
$LNG['conversation'] = 'Conversation';
$LNG['start_conversation'] = 'You can start a conversation by choosing a person from your friends list.';
$LNG['send_message'] = 'Send Message';

// UPLOAD / EDIT //
$LNG['upload_track'] = 'Upload Track';
$LNG['upload_image'] = 'Upload Image';
$LNG['track_selected'] = 'Track selected';
$LNG['image_selected'] = 'Image Selected';

$LNG['0_upload_err'] = 'Your account has exceeded the total upload size allowed. The <strong>%s</strong> track was not uploaded';
$LNG['1_upload_err'] = 'No track selected';
$LNG['2_upload_err'] = 'The <strong>%s</strong> track is too big. Allowed maxium file size is %s';
$LNG['3_upload_err'] = 'The <strong>%s</strong> track does not have a valid format. Upload an %s audio file type';
$LNG['4_upload_err'] = 'The selected cover art is too big. Allowed maxium file size is %s';
$LNG['5_upload_err'] = 'The selected cover art does not have a valid format. Upload a %s file type';
$LNG['6_upload_err'] = 'The description should be less than %s characters';
$LNG['7_upload_err'] = 'The Buy link does not contain a valid URL';
$LNG['8_upload_err'] = 'You can only add up to %s tags';
$LNG['9_upload_err'] = 'You need to add at least %s tag';
$LNG['10_upload_err'] = 'The track title cannot be empty';
$LNG['11_upload_err'] = 'The track title should be less than %s characters';
$LNG['12_upload_err'] = 'The name of a tag should be less than %s characters';
$LNG['track_updated'] = 'Track has been successfully updated';
$LNG['view_track'] = 'View Track';
$LNG['congratulations'] = 'Congratulations';
$LNG['track_uploaded'] = 'Your track <strong><a href="%s" rel="loadpage">%s</a></strong> has been successfully uploaded';
$LNG['or'] = 'or';

$LNG['license'] = 'License';
$LNG['licensed_under'] = 'Licensed under';
$LNG['metadata'] = 'Metadata';
$LNG['permissions'] = 'Permissions';
$LNG['buy_link'] = 'Buy link';
$LNG['release_date'] = 'Release date';
$LNG['tags'] = 'Tags';
$LNG['edit_tags'] = 'separated by comma, including genres';
$LNG['visibility'] = 'Visibility';
$LNG['allow_downloads'] = 'Allow downloads';
$LNG['record_label'] = 'Record label';
$LNG['all_rights'] = 'All rights reserved';
$LNG['creative_commons'] = 'Creative Commons';
$LNG['license_at'] = 'Attribution';
$LNG['license_nc'] = 'Noncommercial';
$LNG['license_nd'] = 'No derivative works';
$LNG['license_sa'] = 'Share Alike';
$LNG['license_at_desc'] = 'You let others copy, distribute, display, and perform your copyrighted work - and derivative works based upon it - but only if they give credit the way you request.';
$LNG['license_nc_desc'] = 'You let others copy, distribute, display, and perform your work - and derivative works based upon it - but for noncommercial purposes only.';
$LNG['license_nd_desc'] = 'You let others copy, distribute, display, and perform only verbatim copies of your work, not derivative works based upon it.';
$LNG['license_sa_desc'] = 'You allow others to distribute derivative works only under a license identical to the license that governs your work.';

// USER PANEL //
$LNG['user_menu_general'] = 'General';
$LNG['user_menu_security'] = 'Password';
$LNG['user_menu_avatar'] = 'Profile';
$LNG['user_menu_notifications'] = 'Notifications';
$LNG['user_menu_social'] = 'Social';
$LNG['user_menu_plan'] = 'Account Plan';
$LNG['user_menu_blocked'] = $LNG['user_ttl_blocked'] = 'Blocked Users';

$LNG['user_ttl_general'] = 'General Settings';
$LNG['user_ttl_security'] = 'Password Settings';
$LNG['user_ttl_avatar'] = 'Profile Settings';
$LNG['user_ttl_notifications'] = 'Notifications Settings';
$LNG['user_ttl_social'] = 'Social Networks Profiles';
$LNG['user_ttl_plan'] = 'Account Plan';

$LNG['user_desc_general'] = 'Change account, privacy, location settings.';
$LNG['user_desc_security'] = 'Change your password.';
$LNG['user_desc_avatar'] = 'Change your account picture.';
$LNG['user_desc_cover'] = 'Change your cover picture.';
$LNG['user_desc_notifications'] = 'Change notifications settings.';
$LNG['blocked_desc'] = 'Blocked persons can no longer contact you trough messages.';

$LNG['ttl_background'] = 'Backgrounds';
$LNG['sub_background'] = 'Pick a background for your profile';

$LNG['ttl_first_name'] = 'First Name';
$LNG['sub_first_name'] = 'Enter your first name';

$LNG['ttl_last_name'] = 'Last Name';
$LNG['sub_last_name'] = 'Enter your last name';

$LNG['ttl_email'] = 'Email';
$LNG['sub_email'] = 'E-mail will not be displayed';

$LNG['ttl_country'] = 'Country';
$LNG['sub_country'] = 'Country you live in';

$LNG['ttl_city'] = 'City';
$LNG['sub_city'] = 'City you live in';

$LNG['ttl_website'] = 'Website';
$LNG['sub_website'] = 'If you have a blog, personal page, enter it';

$LNG['ttl_profile'] = 'Profile';
$LNG['sub_profile'] = 'Profile Privacy';

$LNG['ttl_offline'] = 'Chat Status';
$LNG['sub_offline'] = 'The visibility status for the Chat';

$LNG['ttl_facebook'] = 'Facebook';
$LNG['sub_facebook'] = 'Your Facebook profile ID.';

$LNG['ttl_twitter'] = 'Twitter';
$LNG['sub_twitter'] = 'Your Twitter profile ID.';

$LNG['ttl_google'] = 'Google+';
$LNG['sub_google'] = 'Your Google+ profile ID.';

$LNG['ttl_youtube'] = 'YouTube';
$LNG['sub_youtube'] = 'Your YouTube profile ID.';

$LNG['ttl_soundcloud'] = 'SoundCloud';
$LNG['sub_soundcloud'] = 'Your SoundCloud profile ID.';

$LNG['ttl_myspace'] = 'MySpace';
$LNG['sub_myspace'] = 'Your MySpace profile ID.';

$LNG['ttl_tumblr'] = 'Tumblr';
$LNG['sub_tumblr'] = 'Your Tumblr profile ID.';

$LNG['ttl_vimeo'] = 'Vimeo';
$LNG['sub_vimeo'] = 'Your Vimeo profile ID.';

$LNG['ttl_lastfm'] = 'Last.fm';
$LNG['sub_lastfm'] = 'Your Last.fm profile ID.';

$LNG['ttl_description'] = 'Description';
$LNG['sub_description'] = 'Profile description (160 characters or less)';

$LNG['ttl_upload_avatar'] = 'Upload the selected profile image';
$LNG['ttl_delete_avatar'] = 'Delete your current profile image';

$LNG['opt_public'] = 'Public';
$LNG['opt_private'] = 'Private';
$LNG['opt_semi_private'] = 'Only subscribed allowed';

$LNG['opt_offline_off'] = 'Online (when available)';
$LNG['opt_offline_on'] = 'Always Offline';

$LNG['ttl_new_password'] = 'New Password';
$LNG['sub_new_password'] = 'Enter a new password (at least 6 characters)';
$LNG['ttl_repeat_password'] = 'Repeat Password';
$LNG['sub_repeat_password'] = 'Repeat your new password';
$LNG['ttl_current_password'] = 'Current Password';
$LNG['sub_current_password'] = 'Enter your current password';
$LNG['save_changes'] = 'Save Changes';
$LNG['ttl_upload_photo'] = 'Upload Photo';
$LNG['ttl_upload_cover'] = 'Upload Cover';
$LNG['ttl_delete_photo'] = 'Delete Photo';

$LNG['ttl_notificationl'] = 'Likes Notifications';
$LNG['sub_notificationl'] = 'Display alert and notifications for <strong>Likes</strong>';

$LNG['ttl_notificationc'] = 'Comments Notifications';
$LNG['sub_notificationc'] = 'Display alert and notifications for <strong>Comments</strong>';

$LNG['ttl_notificationd'] = 'Chat Notifications';
$LNG['sub_notificationd'] = 'Display alert and notifications for <strong>Chats</strong>';

$LNG['ttl_notificationf'] = 'Friends Notifications';
$LNG['sub_notificationf'] = 'Display alert and notifications for <strong>Friends Additions</strong>';

$LNG['ttl_email_comment'] = 'Emails on Comments';
$LNG['sub_email_comment'] = 'Receive e-mails when someone comments on your tracks';

$LNG['ttl_email_like'] = 'Emails on Likes';
$LNG['sub_email_like'] = 'Receive e-mails when someone likes your tracks';

$LNG['ttl_email_new_friend'] = 'Emails on New Friends';
$LNG['sub_email_new_friend'] = 'Receive e-mails when someone adds you as friend';

$LNG['user_ttl_sidebar'] = 'Settings';

// ADMIN PANEL //
$LNG['admin_login'] = 'Admin Login';
$LNG['admin_user_name'] = 'Username';
$LNG['desc_admin_user'] = 'Type in your Admin Username';
$LNG['admin_pass'] = 'Password';
$LNG['desc_admin_pass'] = 'Type in your Admin Password';
$LNG['admin_menu_logout'] = 'Log Out';
$LNG['admin_ttl_sidebar'] = 'Menu';
$LNG['admin_menu_dashboard']			= $LNG['admin_ttl_dashboard']		= 'Dashboard';
$LNG['admin_menu_site_settings'] 		= $LNG['admin_ttl_site_settings']	= 'Site Settings';
$LNG['admin_menu_security']				= $LNG['admin_ttl_security']		= 'Password';
$LNG['admin_menu_drivefile']			= $LNG['admin_ttl_drivefile']		= 'Drive Files';
$LNG['admin_menu_manage_users'] 		= $LNG['admin_ttl_users']			= 'Manage Users';
$LNG['admin_menu_stats'] 				= $LNG['admin_ttl_stats'] 			= 'Statistics';
$LNG['admin_menu_users_settings'] 		= $LNG['admin_ttl_users_settings']	= 'Users Settings';
$LNG['admin_menu_social'] 				= $LNG['admin_ttl_social']			= 'Social Login';
$LNG['admin_menu_pro'] 					= $LNG['admin_ttl_pro']				= 'Pro Accounts';
$LNG['admin_menu_themes'] 				= $LNG['admin_ttl_themes']			= 'Themes';
$LNG['admin_menu_manage_payments']		= $LNG['admin_ttl_payments']		= 'Manage Payments';
$LNG['admin_menu_manage_reports']		= $LNG['admin_ttl_reports']			= 'Manage Reports';
$LNG['admin_menu_manage_ads'] 			= $LNG['admin_ttl_ads']				= 'Manage Ads';
$LNG['admin_menu_manage_categories']	= $LNG['admin_ttl_categories']		= 'Manage Categories';

$LNG['admin_ttl_title'] = 'Title';
$LNG['admin_sub_title'] = 'The site\'s title';

$LNG['admin_ttl_captcha'] = 'Captcha';
$LNG['admin_sub_captcha'] = 'Enable captcha at registration';

$LNG['admin_ttl_timestamp'] = 'Timestamp';
$LNG['admin_sub_timestamp'] = 'The Tracks, Comments and Chat timestamps type';

$LNG['admin_ttl_tracks_perpage'] = 'Tracks';
$LNG['admin_sub_tracks_perpage'] = 'The number of tracks per page';

$LNG['admin_ttl_com_perpage'] = 'Comments';
$LNG['admin_sub_com_perpage'] = 'The number of comments per page';

$LNG['admin_ttl_chat_perpage'] = 'Chat';
$LNG['admin_sub_chat_perpage'] = 'The number of chat conversations per page';

$LNG['admin_ttl_volume'] = 'Volume';
$LNG['admin_sub_volume'] = 'Set the default volume';

$LNG['admin_ttl_nperpage'] = 'Notifications';
$LNG['admin_sub_nperpage'] = 'The number of notifications to be shown (Notifications Page)';

$LNG['admin_ttl_message_limit'] = 'Message Limit';
$LNG['admin_sub_message_limit'] = 'The number of characters allowed on comments and chat messages';

$LNG['admin_ttl_email_reg'] = 'Email on Registration';
$LNG['admin_sub_email_reg'] = 'Email users at registration';

$LNG['admin_ttl_notificationsn'] = 'Events Notifications';
$LNG['admin_sub_notificationsn'] = 'The update interval to check for new events notifications (in seconds)';

$LNG['admin_ttl_chatrefresh'] = 'Chat Refresh';
$LNG['admin_sub_chatrefresh'] = 'The time how often the chat window updates with new messages (in seconds)';

$LNG['admin_ttl_timeonline'] = 'Online Users';
$LNG['admin_sub_timeonline'] = 'The amount of time to be considered online since the last user\'s activity (in seconds)';

$LNG['admin_ttl_image_profile'] = 'Profile Image Size';
$LNG['admin_sub_image_profile'] = 'Image size allowed to upload (profile cover and avatar) (in MB)';

$LNG['admin_ttl_image_format'] = 'Profile Image Format';
$LNG['admin_sub_image_format'] = 'Image format allowed for upload (profile cover and avatar), use only gif,png,jpg,jpeg other formats are not supported';

$LNG['admin_ttl_cover_size'] = 'Track Cover Size';
$LNG['admin_sub_cover_size'] = 'Image size allowed to upload for track covers (in MB)';

$LNG['admin_ttl_cover_format'] = 'Track Cover Format';
$LNG['admin_sub_cover_format'] = 'Image format allowed for upload for track covers, use only gif,png,jpg,jpeg other formats are not supported';

$LNG['admin_ttl_track_size'] = 'Track Size';
$LNG['admin_sub_track_size'] = 'Track size allowed to upload (in MB)';

$LNG['admin_ttl_track_format'] = 'Track Format';
$LNG['admin_sub_track_format'] = 'Track format allowed for upload, use only mp3,m4a,mp4 other formats are not supported';

$LNG['admin_ttl_total_upload_size'] = 'Total Upload';
$LNG['admin_sub_total_upload_size'] = 'Total track upload size allowed to upload by an user (in MB)';

$LNG['admin_ttl_pro_track_size'] = 'Pro Track Size';
$LNG['admin_sub_pro_track_size'] = 'Track size allowed to upload by pro users (in MB)';

$LNG['admin_ttl_pro_total_size'] = 'Pro Total Upload';
$LNG['admin_sub_pro_total_size'] = 'Total track upload size allowed to upload by pro users (in MB)';

$LNG['admin_ttl_fbapp'] = 'Facebook Login';
$LNG['admin_sub_fbapp'] = 'Allow users to log-in using Facebook';

$LNG['admin_ttl_fbappid'] = 'App ID';
$LNG['admin_sub_fbappid'] = 'Facebook App ID';

$LNG['admin_ttl_fbappsecret'] = 'App Secret'; 
$LNG['admin_sub_fbappsecret'] = 'Facebook App Secret';

$LNG['smtp_emails'] = 'SMTP Mails';
$LNG['smtp_sub_emails'] = 'Enable sending emails trough SMTP';

$LNG['smtp_host'] = 'SMTP Host';
$LNG['smtp_sub_host'] = 'The SMTP Host';

$LNG['smtp_port'] = 'SMTP Port';
$LNG['smtp_sub_port'] = 'The SMTP Port';

$LNG['smtp_auth'] = 'SMTP Authentication';
$LNG['smtp_sub_auth'] = 'Enable SMTP Authentication';

$LNG['smtp_username'] = 'SMTP Username';
$LNG['smtp_sub_username'] = 'The SMTP Username';

$LNG['smtp_password'] = 'SMTP Password';
$LNG['smtp_sub_password'] = 'The SMTP Password';

$LNG['standard_accounts'] = 'Standard Accounts';
$LNG['admin_ttl_ppapp'] = 'Pro Accounts';
$LNG['admin_sub_ppapp'] = 'Enable Pro Accounts with PayPal';

$LNG['admin_ttl_ppuser'] = 'PayPal Username';
$LNG['admin_sub_ppuser'] = 'PayPal API Username';

$LNG['admin_ttl_pppass'] = 'PayPal Password'; 
$LNG['admin_sub_pppass'] = 'PayPal API Password';

$LNG['admin_ttl_ppsign'] = 'PayPal Signature';
$LNG['admin_sub_ppsign'] = 'PayPal API Signature';

$LNG['admin_ttl_ppsand'] = 'PayPal Sandbox';
$LNG['admin_sub_ppsand'] = 'PayPal sandbox for development mode';

$LNG['admin_ttl_pro_plan_month'] = 'Month Plan';
$LNG['admin_sub_pro_plan_month'] = 'Value of the monthly plan (e.g: 3.00 for 3 USD)';

$LNG['admin_ttl_pro_plan_year'] = 'Year Plan';
$LNG['admin_sub_pro_plan_year'] = 'Value of the pro plan (e.g: 29.00 for 29 USD)';

$LNG['admin_ttl_currency'] = 'Currency';
$LNG['admin_sub_currency'] = 'Currency type for the plans';

$LNG['admin_ttl_ad1'] = 'Ad Unit 1';
$LNG['admin_sub_ad1'] = 'Advertisement Unit 1 (Bottom [Welcome Page])';

$LNG['admin_ttl_ad2'] = 'Ad Unit 2';
$LNG['admin_sub_ad2'] = 'Advertisement Unit 2 (Sidebar [Explore Page])';

$LNG['admin_ttl_ad3'] = 'Ad Unit 3';
$LNG['admin_sub_ad3'] = 'Advertisement Unit 3 (Sidebar [Stream Page])';

$LNG['admin_ttl_ad4'] = 'Ad Unit 4';
$LNG['admin_sub_ad4'] = 'Advertisement Unit 4 (Sidebar [Profile Page])';

$LNG['admin_ttl_ad5'] = 'Ad Unit 5';
$LNG['admin_sub_ad5'] = 'Advertisement Unit 5 (Sidebar [Track & Playlis Page])';

$LNG['admin_ttl_ad6'] = 'Ad Unit 6';
$LNG['admin_sub_ad6'] = 'Advertisement Unit 6 (Sidebar [Search Page])';

$LNG['admin_ttl_edit_profile'] = 'Edit Profile';

$LNG['admin_ttl_delete_profile'] = 'Delete Profile';

$LNG['admin_ttl_mail'] = 'Email';
$LNG['admin_ttl_username'] = 'Username';
$LNG['admin_ttl_id'] = 'ID'; // As in user ID

$LNG['admin_ttl_notificationl'] = 'Likes Notifications';
$LNG['admin_sub_notificationl'] = 'Display alert and notifications for <strong>Likes</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationc'] = 'Comments Notifications';
$LNG['admin_sub_notificationc'] = 'Display alert and notifications for <strong>Comments</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationd'] = 'Chat Notifications';
$LNG['admin_sub_notificationd'] = 'Display alert and notifications for <strong>Chats</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_notificationf'] = 'Friends Notifications';
$LNG['admin_sub_notificationf'] = 'Display alert and notifications for <strong>Friends Additions</strong> (can be changed from user\'s settings)';

$LNG['admin_ttl_email_comment'] = 'Email on Comment';
$LNG['admin_sub_email_comment'] = 'Enable sending e-mails when someone comments to a track';

$LNG['admin_ttl_email_like'] = 'Email on Like';
$LNG['admin_sub_email_like'] = 'Enable sending e-mails when someone likes a track';

$LNG['admin_ttl_email_new_friend'] = 'Email on New Friend';
$LNG['admin_sub_email_new_friend'] = 'Enable sending e-mails when someone adds a friend';

$LNG['admin_ttl_wholiked'] = 'Who Liked';
$LNG['admin_sub_wholiked'] = 'Display avatars of the users that liked a track';

$LNG['admin_ttl_rperpage'] = 'Admin Panel';
$LNG['admin_sub_rperpage'] = 'Results per page for Admin Manage pages';

$LNG['admin_ttl_sperpage'] = 'Friends';
$LNG['admin_sub_sperpage'] = 'Number of friends per page to be displayed (profile page)';

$LNG['admin_ttl_aperip'] = 'Accounts';
$LNG['admin_sub_aperip'] = 'Number of accounts allowed to register per IP (0 for unlimited)';

$LNG['admin_ttl_ronline'] = 'Online Friends';
$LNG['admin_sub_ronline'] = 'Number of online friends to be displayed on the Feed/Subscriptions page (sidebar).';

$LNG['admin_ttl_nperwidget'] = 'Dropdown Notifications';
$LNG['admin_sub_nperwidget'] = 'Number of notifications to be shown per category (likes, comments, tracks)';

$LNG['admin_sub_tracking'] = 'The analytics tracking code';

$LNG['per_page'] = '/ page';
$LNG['per_ip'] = '/ IP';
$LNG['second'] = 'second';
$LNG['seconds'] = 'seconds';
$LNG['minute'] = 'minute';
$LNG['minutes'] = 'minutes';
$LNG['hour'] = 'hour';
$LNG['recommended'] = 'recommended';
$LNG['edit_user'] = 'Edit User';
$LNG['username_to_edit'] = 'Enter a username';
$LNG['username_to_edit_sub'] = 'Enter the username you want to edit';
$LNG['add_category'] = 'Add category';
$LNG['add_category_desc'] = 'These categories are shown on the Explore page';
$LNG['case_id'] = 'Case ID';
$LNG['enter_case_id'] = 'Enter the Case ID you want to view';
$LNG['valid_rcs'] = 'Valid reported copyright strikes';
$LNG['payment_id'] = 'Payment ID';
$LNG['enter_payment_id'] = 'Enter a Payment ID you want to view';

// STATS //
$LNG['user_registration'] = 'User Registration';
$LNG['users_today'] = 'Today';
$LNG['users_this_month'] = 'This Month';
$LNG['users_last_30'] = 'Last 30 days';
$LNG['total_users'] = 'Total';
$LNG['plays_today'] = 'Plays Today';
$LNG['plays_yesterday'] = 'Plays Yesterday';
$LNG['plays_total'] = 'Plays Total';
$LNG['total_plays'] = 'Total Plays';
$LNG['plays_this_month'] = 'Plays This Month';
$LNG['tracks_uploaded'] = 'Tracks Uploaded';
$LNG['used_space'] = 'Used Space';
$LNG['free_space'] = 'Free Space';
$LNG['filter_stats'] = 'Filter Statistics';
$LNG['stats_today'] = 'Today';
$LNG['stats_last7'] = 'Last 7 days';
$LNG['stats_last30'] = 'Last 30 days';
$LNG['stats_last356'] = 'Last 12 months';
$LNG['stats_total'] = 'Total';
$LNG['most_played'] = 'Most Played';
$LNG['most_liked'] = 'Most Liked';
$LNG['most_commented'] = 'Most Commented';
$LNG['who_played_most'] = 'Who played the most';
$LNG['who_downloaded_most'] = 'Who downloaded the most';
$LNG['top_countries'] = 'Top countries';
$LNG['top_cities'] = 'Top cities';
$LNG['stats_note'] = 'Note: The statistics are gathered from registered users.';
$LNG['users'] = 'Users';
$LNG['geographic'] = 'Geographic';

$LNG['plays'] = 'Plays';
$LNG['comments'] = 'Comments';
$LNG['downloads'] = 'Downloads';
$LNG['tracks_and_comments'] = 'Tracks & Comments';
$LNG['reports_title'] = 'Reports (Tracks %26 Comments)';
$LNG['total_tracks'] = 'Total Tracks';
$LNG['public_tracks'] = 'Public Tracks';
$LNG['private_tracks'] = 'Private Tracks';
$LNG['total_comments'] = 'Total Comments';
$LNG['stats_total'] = 'Total';
$LNG['stats_public'] = 'Public';
$LNG['stats_private'] = 'Private';
$LNG['reports'] = 'Reports';
$LNG['total_reports'] = 'Total Reports';
$LNG['pending_reports'] = 'Pending Reports';
$LNG['safe_reports'] = 'Safe Reports';
$LNG['deleted_reports'] = 'Deleted Reports';
$LNG['likes_today'] = 'Likes Today';
$LNG['likes_this_month'] = 'Likes This Month';
$LNG['likes_last_30'] = 'Last 30 days';
$LNG['likes_total'] = 'Total Likes';
$LNG['likes'] = 'Likes';
$LNG['downloads_today'] = 'Downloads Today';
$LNG['downloads_this_month'] = 'Downloads This Month';
$LNG['downloads_last_30'] = 'Last 30 days';
$LNG['downloads_total'] = 'Total Downloads';
$LNG['playlists'] = 'Playlists';
$LNG['playlist'] = 'Playlist';
$LNG['playlists_today'] = 'Playlists Today';
$LNG['playlists_this_month'] = 'Playlists This Month';
$LNG['playlists_total'] = 'Playlists Total';
$LNG['listened_x_times'] = 'Listened %s times';
$LNG['downloaded_x_times'] = 'Downloaded %s times';
$LNG['payments'] = 'Payments';
$LNG['total_payments'] = 'Total Payments';
$LNG['payments_today'] = 'Payments Today';
$LNG['payments_this_month'] = 'Payments This Month';
$LNG['payments_last_30'] = 'Last 30 Days';
$LNG['earnings'] = 'Earnings';
$LNG['earnings_today'] = 'Earnings today';
$LNG['earnings_this_month'] = 'Earnings this month';
$LNG['earnings_last_30'] = 'Last 30 days';
$LNG['total_earnings'] = 'Total earnings';

// DASHBOARD
$LNG['admin_panel'] = 'Admin Panel';
$LNG['at_a_glance'] = 'At a glance';
$LNG['site_info'] = 'Site Info';
$LNG['site_version'] = '<a href="%s" target="_blank">%s</a> %s with theme <a href="%s" rel="loadpage">%s</a> enabled';
$LNG['online_users'] = 'Online Users';
$LNG['useful_links'] = 'Useful Links';
$LNG['get_themes'] = 'Get more Themes';
$LNG['get_languages'] = 'Get more Languages';

// PLAYER //
$LNG['mute'] = 'Mute';
$LNG['unmute'] = 'Unmute';
$LNG['repeat'] = 'Repeat';
$LNG['repeat_off'] = 'Repeat Off';
$LNG['play'] = 'Play';
$LNG['pause'] = 'Pause';
$LNG['prev_track'] = 'Previous track';
$LNG['next_track'] = 'Next track';
$LNG['volume'] = 'Volume';

// SHARE //
$LNG['share_facebook'] = 'Share on Facebook';
$LNG['share_twitter'] = 'Share on Twitter';
$LNG['share_gplus'] = 'Share on Google+';
$LNG['share_pinterest'] = 'Share on Pinterest';
$LNG['share_email'] = 'Share via email';
$LNG['share_sn'] = 'Share on Social Networks';
$LNG['share_url'] = 'Share URL';
$LNG['embed'] = 'Embed';
$LNG['embed_code'] = 'Embed Code';
$LNG['embed_error'] = 'Sorry, we couldn\'t find the requested track.';

// LIKES //
$LNG['already_liked'] = 'You\'ve already liked this track.';
$LNG['already_disliked'] = 'You\'ve already disliked this track.';
$LNG['like'] = 'Like';
$LNG['dislike'] = 'Liked';
$LNG['like_track_not_exist'] = 'This track doesn\'t exist or has been deleted.';
$LNG['liked_this'] = 'liked this';

// MISC //
$LNG['from'] = 'From';
$LNG['to'] = 'To';
$LNG['type'] = 'Type';
$LNG['status'] = 'Status';
$LNG['sponsored'] = 'Sponsored';
$LNG['new_like_notification'] = '<a href="%s" rel="loadpage">%s</a> liked your <a href="%s" rel="loadpage">track</a>';
$LNG['new_comment_notification'] = '<a href="%s" rel="loadpage">%s</a> commented on your <a href="%s" rel="loadpage">track</a>';
$LNG['new_friend_notification'] = '<a href="%s" rel="loadpage">%s</a> added you as friend';
$LNG['new_chat_notification'] = '<a href="%s" rel="loadpage">%s</a> sent you a <a href="%s" rel="loadpage">chat message</a>';
$LNG['new_like_fa'] = '<strong><a href="%s" rel="loadpage">%s</a></strong> liked a <strong><a href="%s" rel="loadpage">track</a></strong>';
$LNG['new_comment_fa'] = '<strong><a href="%s" rel="loadpage">%s</a></strong> commented on a <strong><a href="%s" rel="loadpage">track</a></strong>';
$LNG['new_track_fa'] = '<strong><a href="%s" rel="loadpage">%s</a></strong> uploaded a new <strong><a href="%s" rel="loadpage">track</a></strong>';
$LNG['change_password'] = 'Change Password';
$LNG['enter_new_password'] = 'Enter your new password';
$LNG['enter_reset_key'] = 'Enter the reset key';
$LNG['enter_username'] = 'Enter Username';
$LNG['remember_me'] = 'Remember me';
$LNG['reset_key'] = 'Reset Key';
$LNG['new_password'] = 'New Password';
$LNG['password_recovery'] = 'Password Recovery';
$LNG['recover']	= 'Recover';
$LNG['delete'] = 'Delete';
$LNG['suspend'] = 'Suspend';
$LNG['restore'] = 'Restore';
$LNG['enable'] = 'Enable';
$LNG['general'] = 'General';
$LNG['filesync'] = 'Synced';
$LNG['filenotsync'] = 'Not Synced';
$LNG['drivefile_titlereport'] = 'Drive Files Status';
$LNG['registration'] = 'Registration';
$LNG['limits'] = 'Limits';
$LNG['emails'] = 'Emails';
$LNG['recover_sub_username'] = 'Type in the username you want to recover the password';
$LNG['delete_track_desc'] = 'Are you sure you want to delete this track?';
$LNG['delete_playlist_desc'] = 'Are you sure you want to delete this playlist?';
$LNG['delete_account'] = 'Deleting an account will delete all informations from the server and the action cannot be reverted.';
$LNG['suspend_account'] = 'Suspending an account will restrict the access to the account and hide its content. It can be fully restored.';
$LNG['restore_account'] = 'Restoring account will restore access to the account and its content.';
$LNG['account_suspended'] = 'This account is currently suspended.';
$LNG['view'] = 'View';
$LNG['uploading'] = 'Uploading';
$LNG['processing'] = 'Processing...';
$LNG['tracking_code'] = 'Tracking Code';

// PROFILE //
$LNG['profile_not_exist'] = 'Sorry, but this profile does not exist.';
$LNG['profile_semi_private'] = 'Sorry, but this profile is private, only the friends of this user can view the profile.';
$LNG['profile_private'] = 'Sorry, but this profile is completely private.';
$LNG['profile_suspended'] = 'Sorry, but this profile has been suspended.';
$LNG['profile_not_exist_ttl'] = 'Profile does not exist';
$LNG['profile_semi_private_ttl'] = 'Profile is private';
$LNG['profile_private_ttl'] = 'Profile is private';
$LNG['profile_suspended_ttl'] = 'Suspended Profile';
$LNG['add_friend'] = 'Follow';
$LNG['remove_friend'] = 'Unfollow';
$LNG['profile_about'] = 'About';
$LNG['profile_location'] = 'Location';
$LNG['profile_website'] = 'Homepage';
$LNG['profile_view_site'] = 'View website';
$LNG['profile_view_profile'] = 'View Profile';
$LNG['profile_view_social'] = 'View %s profile';
$LNG['pro_user'] = 'Pro User';
$LNG['edit_profile_cover'] = 'Change Profile Images';
$LNG['view_all_notifications'] = 'View More Notifications';
$LNG['view_chat_notifications'] = 'View More Messages';
$LNG['close_notifications'] = 'Close Notifications';
$LNG['notifications_settings'] = 'Notifications Settings';
$LNG['no_notifications'] = 'No notifications';
$LNG['search_title'] = 'Search Results';
$LNG['view_all_results'] = 'View All Results';
$LNG['close_results'] = 'Close Results';
$LNG['no_results'] = 'No results available. Try another search.';
$LNG['no_results_ttl'] = 'Search Results';
$LNG['search_for_users'] = 'Search for users';
$LNG['search_in_friends'] = 'Search in friends';
$LNG['follows'] = 'Follows';
$LNG['followed_by'] = 'Followed by';
$LNG['people'] = 'people';
$LNG['join_date'] = 'Join Date';

// PHP MODULES
$LNG['openssl_error'] = 'You must enable <strong>OpenSSL</strong> extension on the server';
$LNG['curl_error'] = 'Is recommended that <strong>cURL</strong> extension is enabled on the server';

// PRO MESSAGES
$LNG['go_pro_0'] = 'Get more in-depth statistics like where your audience is located at, or who played your tracks.';
$LNG['go_pro_1'] = 'Get more in-depth statistics about your audience.';
$LNG['go_pro_2'] = 'Get more total storage space and upload longer tracks.';
$LNG['go_pro_ttl_1'] = 'Know more';
$LNG['go_pro_ttl_2'] = 'Get more';
$LNG['go_pro_3'] = 'Get more in-depth statistics like where your audience is located at, or who played your tracks, more storage space and upload longer tracks.';
$LNG['go_pro_4'] = 'Get more upload space for your tracks, stay in touch with your audience, view advanced statistics, and more...';
$LNG['current_plan'] = 'Your current plan is';
$LNG['plan_0'] = 'Standard';
$LNG['plan_1'] = 'Pro';
$LNG['view_pricing'] = 'View Pricing';
$LNG['total_space'] = 'Total Space';
$LNG['total_space_desc'] = 'The total space allowed to upload.';
$LNG['track_size'] = 'Track Size';
$LNG['track_size_desc'] = 'The size allowed to upload per track.';
$LNG['basic_stats'] = 'Basic Stats';
$LNG['basic_stats_desc'] = 'Count plays, likes & comments.';
$LNG['extended_stats'] = 'Extended Stats';
$LNG['extended_stats_desc'] = 'Know who\'s playing your tracks and in which country your tracks are the most played.';
$LNG['pro_badge'] = 'Pro Badge';
$LNG['pro_badge_desc'] = 'Pro badge which will appear on your account.';
$LNG['pro_month'] = 'Monthly Pro Plan - %s'; 
$LNG['pro_year'] = 'Yearly Pro Plan - %s';
$LNG['go_pro_desc'] = 'More upload size, more stats, more features';
$LNG['go_pro_congrats'] = 'Your account has been upgraded to Pro Plan';
$LNG['payment_error_0'] = 'The request has failed';
$LNG['payment_error_1'] = 'Your payment was canceled';
$LNG['pro_plan'] = 'Pro Plan';
$LNG['pro_plan_desc'] = 'The Pro account type';
$LNG['valid'] = 'Valid';
$LNG['valid_desc'] = 'Your account status validity.';
$LNG['expire_on'] = 'Expire on';
$LNG['monthly'] = 'Monthly';
$LNG['yearly'] = 'Yearly';
$LNG['days_left'] = 'days left';
$LNG['account_status'] = 'Your current account status';
$LNG['transactions_history'] = 'Transactions history';
$LNG['history'] = 'History';
$LNG['payments'] = 'Payments';
$LNG['completed'] = 'Completed';
$LNG['refunded'] = 'Refunded';
$LNG['reversed'] = 'Reversed';
$LNG['pending'] = 'Pending';
$LNG['suspended'] = 'Suspended';
$LNG['failed'] = 'Failed';
$LNG['denied'] = 'Denied';
$LNG['promote'] = 'Promote';
$LNG['promoted'] = 'The account has been promoted to the Pro Status.';
$LNG['promote_info'] = 'Promote this account to the Pro Status';

// MANAGE PAYMENTS //
$LNG['amount'] = 'Amount';
$LNG['date'] = 'Date';
$LNG['plan'] = 'Plan';
$LNG['transaction_id'] = 'Transaction ID';
$LNG['transaction_details'] = 'Transaction Details';

// GENERAL //
$LNG['title_profile'] = 'Profile';
$LNG['title_messages'] = 'Messages';
$LNG['title_settings'] = 'Settings';
$LNG['explore'] = 'Explore';
$LNG['search'] = 'Search';
$LNG['title_notifications'] = 'Notifications';
$LNG['title_admin']	= 'Admin';
$LNG['on'] = 'On';
$LNG['off'] = 'Off';
$LNG['no'] = 'No';
$LNG['yes'] = 'Yes';
$LNG['none'] = 'None';
$LNG['add'] = 'Add';
$LNG['save'] = 'Save';
$LNG['send'] = 'Send';
$LNG['all'] = 'All';
$LNG['categories'] = 'Categories';
$LNG['stream'] = 'Stream';
$LNG['track'] = 'Track';
$LNG['tracks'] = 'Tracks';
$LNG['pages'] = 'Pages';
$LNG['report'] = 'Report';
$LNG['stats'] = 'Stats';
$LNG['author'] = 'Author';
$LNG['latest_music'] = 'Latest Music';
$LNG['popular_music'] = 'Popular Music';
$LNG['liked_music'] = 'Liked Music';
$LNG['go_pro'] = 'Go Pro';
$LNG['edit'] = 'Edit';
$LNG['upload'] = 'Upload';
$LNG['features'] = 'Features';
$LNG['search_for_people'] = 'Search...';
$LNG['privacy_policy'] = 'Privacy Policy';
$LNG['terms_of_use'] = 'Terms of Use';
$LNG['about'] = 'About';
$LNG['disclaimer'] = 'Disclaimer';
$LNG['contact'] = 'Contact';
$LNG['api_documentation'] = 'API Documentation';
$LNG['developers'] = 'Developers';
$LNG['language'] = 'Language';

// MONTHS
$LNG['month'] = 'Month';
$LNG['year'] = 'Year';
$LNG['day'] = 'Day';
$LNG['month_1'] = 'January';
$LNG['month_2'] = 'February';
$LNG['month_3'] = 'March';
$LNG['month_4'] = 'April';
$LNG['month_5'] = 'May';
$LNG['month_6'] = 'June';
$LNG['month_7'] = 'July';
$LNG['month_8'] = 'August';
$LNG['month_9'] = 'September';
$LNG['month_10'] = 'October';
$LNG['month_11'] = 'November';
$LNG['month_12'] = 'December';
?>