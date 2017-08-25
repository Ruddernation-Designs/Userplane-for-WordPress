<?php
/*
Plugin Name: Userplane Chat
Plugin URI: http://userplane.com/
Description: Userplane Chat application.
Version: 1.0.0
Author: userplane.com
Author URI: http://userplane.com/
*/

register_activation_hook(__FILE__, 'activate_upl_wc');
add_action('deactivate_upl_wc/upl_wc.php', 'deactivate_upl_wc');
add_action('init', 'init_upl_wc');
add_action('upl_webchat', 'upl_wc_front_end');
add_action('upl_widget', 'wp_meta_upl_wc');
//add_action('activity_box_end', 'activity_box_end_upl_wc');
//add_action('admin_footer', 'admin_footer_upl_wc');
//add_action('admin_menu', 'upl_wc_userplane_page');
//add_action('widgets_init', 'upl_common_widgets_init');

function init_upl_wc() {
	add_action('admin_menu', 'upl_wc_config_page');
	upl_minichat_widgets_init();
}

function upl_minichat_widgets_init() {
	$dims90 = array('height' => 90, 'width' => 300);
	$class['classname'] = 'widget_uplminichat';
	wp_register_sidebar_widget('uplminichat', __('Minichat'), 'upl_minichat_widget', $class);
}

function upl_minichat_widget($args) {
	extract($args);
	$title = __('Live chat');
	echo $before_widget;
	echo $before_title . $title . $after_title;
	require_once 'upl_wc_minichat.php';
	upl_wc_minichat::show_minichat(!is_user_logged_in(), 'wp-content/plugins/upl_wc/');
	if( is_user_logged_in() ) {
		upl_wc_launch_wc_script();
		echo "<a href='javascript:wc_makecontent()'>Join Chat</a>";
		echo $after_widget;
	}
}

function upl_wc_config_page() {
	if ( function_exists('add_submenu_page') ) {
		add_submenu_page('upl_common/upl_common.php', __('Chat configuration'), __('Chat configuration'), 'manage_options', 'upl_wc_conf', 'upl_wc_conf');
		add_submenu_page('upl_common/upl_common.php', __('Chat Rooms'), __('Chat Rooms'), 'manage_options', 'upl_wc_rooms', 'upl_wc_rooms');
		add_submenu_page('upl_common/upl_common.php', __('Chat Admin Rooms'), __('Chat Admin Rooms'), 'manage_options', 'upl_wc_adminrooms', 'upl_wc_adminrooms');
		add_submenu_page('upl_common/upl_common.php', __('Chat Restricted Rooms'), __('Chat Restricted Rooms'), 'manage_options', 'upl_wc_restrooms', 'upl_wc_restrooms');
		add_submenu_page('upl_common/upl_common.php', __('Chat Users Permissions'), __('Chat Users Permissions'), 'manage_options', 'upl_wc_users', 'upl_wc_users');
	}
}

function upl_wc_check_admin() {
	if ( !current_user_can('manage_options') ) {
		wp_die(__('Cheatin&#8217; uh?'));
	}
}

function upl_wc_conf() {
	upl_wc_check_admin();
	require_once 'upl_wc_config.php';
	if ( isset($_POST['submit']) ) {
		upl_wc_config::save_config();
	}
	upl_wc_config::show_config_page();
}

function upl_wc_rooms() {
	upl_wc_check_admin();
	require_once 'upl_wc_rooms.php';
	if (key_exists('action', $_GET) && $_GET['action'] == 'edit') {
		if ( isset($_POST['submit']) ) {
			$rid = key_exists('room_rid', $_POST) ? $_POST['room_rid'] : '-1';
			$name = key_exists('room_name', $_POST) ? $_POST['room_name'] : '';
			$description = key_exists('room_description', $_POST) ? $_POST['room_description'] : '';
			if ( !upl_wc_rooms::check_room_by_name($name, $rid) ) {
				upl_wc_rooms::save_room($name, $description, $rid);
			}
		}
		upl_wc_rooms::show_edit_room();
		return;
	}
	if ( isset($_POST['submit']) ) {
		$name = key_exists('room_name', $_POST) ? $_POST['room_name'] : '';
		$description = key_exists('room_description', $_POST) ? $_POST['room_description'] : '';
		if ( !upl_wc_rooms::check_room_by_name($name) ) {
			upl_wc_rooms::save_room($name, $description);
		}
	}
	if (key_exists('action', $_GET) && $_GET['action'] == 'delete') {
		upl_wc_rooms::delete_room();
		return;
	}
	upl_wc_rooms::show_list();
	upl_wc_rooms::show_edit_room_form('Add new room');
}

function upl_wc_adminrooms() {
	upl_wc_check_admin();
	require_once 'upl_wc_admin_rooms.php';
	if( isset($_POST['submit']) ) {
		upl_wc_admin_rooms::save_admin_rooms();
	}
	upl_wc_admin_rooms::show_admin_rooms();
}

function upl_wc_restrooms() {
	upl_wc_check_admin();
	require_once 'upl_wc_restricted_rooms.php';
	if ( isset($_POST['submit']) ) {
		$rid = key_exists('room_name', $_POST) ? $_POST['room_name'] : '';
		$uid = key_exists('user_name', $_POST) ? $_POST['user_name'] : '';
		$allow = key_exists('allow', $_POST) ? $_POST['allow'] : '0';
		upl_wc_restricted_rooms::add($rid, $uid, $allow);
	} else if ( isset($_POST['submit_allow']) ) {
		foreach ($_POST['submit_allow'] as $uid => $value) {
			$rid = key_exists('room_name_for_' . $uid, $_POST) ? $_POST['room_name_for_' . $uid] : '';
			upl_wc_restricted_rooms::add($rid, $uid, 1);
		}
	} else if ( isset($_POST['submit_disallow']) ) {
		foreach ($_POST['submit_disallow'] as $uid => $value) {
			$rid = key_exists('room_name_for_' . $uid, $_POST) ? $_POST['room_name_for_' . $uid] : '';
			upl_wc_restricted_rooms::add($rid, $uid, 0);
		}
	} else if (key_exists('action', $_GET) && $_GET['action'] == 'delete') {
		upl_wc_restricted_rooms::delete();
		return;
	}
	upl_wc_restricted_rooms::show_list();
	upl_wc_restricted_rooms::show_edit_room_form('Add Restricted room');
}

function upl_wc_users() {
	upl_wc_check_admin();
	require_once 'upl_wc_user_privileges.php';
	if( isset($_POST['submit']) ) {
		upl_wc_user_privileges::save_users();
	}
	upl_wc_user_privileges::show_users();
}

function activity_box_end_upl_wc() {
}

function upl_wc_front_end() {
	require_once 'upl_wc_minichat.php';
?>
	<div class="wrap">
	<h2><?php _e('Live Chat'); ?></h2>
	<?php upl_wc_minichat::show_minichat(false, './../wp-content/plugins/upl_wc/'); ?>
	<?php upl_wc_launch_wc_script(); ?>
	<a href='javascript:wc_makecontent()'>Join Chat</a>
	</div>
<?php	
}

function upl_wc_launch_wc_script() {
?>
	<script language='javascript' type='text/javascript'>
	<!--
			function wc_makecontent() {
				myWindow = window.open('<?php echo(get_option('siteurl')); ?>/wp-content/plugins/upl_wc/chat.php', 'Userplane_WebChat', 'width=800,height=500,toolbar=0,directories=0,menubar=0,status=0,location=0,scrollbars=0,resizable=1');
			}
	--> 
	</script>
<?php
}

function wp_meta_upl_wc() {
	if ( is_user_logged_in() ) {
		upl_wc_launch_wc_script();
		$link = '<li><a href="javascript:wc_makecontent()">' . __('Live Chat') . '</a></li>';
		echo apply_filters('joinchat', $link);
	}
}

function activate_upl_wc() {
	require_once 'upl_wc_install.php';
	upl_wc_install::install();
}

function deactivate_upl_wc() {
	require_once 'upl_wc_install.php';
	upl_wc_install::uninstall();
}

?>