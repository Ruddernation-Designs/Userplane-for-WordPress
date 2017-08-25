<?php
/*
Plugin Name: Userplane Chat Suite Common
Plugin URI: http://userplane.com/
Description: User profile and avatars for Userplane Chat and Instant Message plug-ins.
Version: 1.0.0
Author: userplane.com
Author URI: http://userplane.com/
*/
register_activation_hook(__FILE__, 'activate_upl_common');
add_action('deactivate_upl_common/upl_common.php', 'deactivate_upl_common');
add_action('init', 'init_upl_common');

require_once('upl_common_profile.php');
upl_common_profile::init_hooks();

function init_upl_common() {
	add_action('admin_menu', 'upl_common_front_page');
	upl_common_widgets_init();
}

function upl_common_widget_chatsuite($args) {
	if( is_user_logged_in() ) {
		extract($args);
		$title = __('Chat Suite');
?>
		<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
			<ul>
			<?php do_action('upl_widget'); ?>
			</ul>
		<?php echo $after_widget; ?>
<?php
	}
}

function upl_common_widgets_init() {
	$dims90 = array('height' => 90, 'width' => 300);
	$class['classname'] = 'widget_chatsuite';
	wp_register_sidebar_widget('chatsuite', __('Chat Suite'), 'upl_common_widget_chatsuite', $class);
}

function upl_common_front_page() {
	if ( function_exists('add_menu_page') ) {
		add_menu_page(__('Chat Suite'), __('Chat Suite'), 'read', __FILE__, 'upl_common_show_front_page');
	}
}

function upl_common_show_front_page() {
	do_action('upl_webchat');
	do_action('upl_webmessenger');
	do_action('upl_webrecorder');
}

function activate_upl_common() {
	require_once 'upl_database.php';
	upl_database::create_table("upl_wc_users", "(
		user_id mediumint(8) NOT NULL,
		sex int(11) NOT NULL DEFAULT '0',
		birth_day int(10) unsigned DEFAULT NULL,
		birth_month int(10) unsigned DEFAULT NULL,
		birth_year int(10) unsigned DEFAULT NULL,
  		last_room varchar(64) DEFAULT NULL,
  		location varchar(256) DEFAULT NULL,
  		avatar_name varchar(256) DEFAULT NULL,
		PRIMARY KEY  (user_id)
	);");
}

function deactivate_upl_common() {
	require_once 'upl_database.php';
	upl_database::drop_table("upl_wc_users");
}

?>