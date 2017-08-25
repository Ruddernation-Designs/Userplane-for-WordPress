<?php
/*
Plugin Name: Userplane Video Recorder
Plugin URI: http://userplane.com/
Description: Userplane Video Recorder application.
Version: 1.0.0
Author: userplane.com
Author URI: http://userplane.com/
*/

register_activation_hook(__FILE__, 'activate_upl_wr');
add_action('deactivate_upl_wr/upl_wr.php', 'deactivate_upl_wr');
add_action('upl_widget', 'wp_meta_upl_wr');
add_action('init', 'init_upl_wr');
add_action('dbx_post_advanced', 'upl_wr_simple_edit_form');
add_action('edit_post', 'upl_wr_save_post');
add_action('save_post', 'upl_wr_save_post');
add_action('publish_post', 'upl_wr_save_post');

function upl_wr_simple_edit_form() {
	require_once 'upl_wr_post.php';
	upl_wr_post::post_gui();
}

function upl_wr_save_post($id) {
	require_once 'upl_wr_post.php';
	upl_wr_post::save_post_record($id);
}

function init_upl_wr() {
	add_action('admin_menu', 'upl_wr_config_page');
}

function upl_wr_config_page() {
	if ( function_exists('add_submenu_page') ) {
		add_submenu_page('upl_common/upl_common.php', __('WebRecorder configuration'), __('WebRecorder configuration'), 'manage_options', 'upl_wr_conf', 'upl_wr_conf');
		add_submenu_page('upl_common/upl_common.php', __('My Videos'), __('My Videos'), 'read', 'upl_wr_my', 'upl_wr_my');
		add_submenu_page('upl_common/upl_common.php', __('All Videos'), __('All Videos'), 'read', 'upl_wr_records', 'upl_wr_records');
		add_submenu_page('upl_common/upl_common.php', __('New Videos Management'), __('New Videos'), 'manage_options', 'upl_wr_new', 'upl_wr_new');
	}
}

function upl_wr_check_admin() {
	if ( !current_user_can('manage_options') ) {
		wp_die(__('Cheatin&#8217; uh?'));
	}
}

function upl_wr_conf() {
	upl_wr_check_admin();
	require_once 'upl_wr_config.php';
	if ( isset($_POST['submit']) ) {
		upl_wr_config::save_config();
	}
	upl_wr_config::show_config_page();
}

function upl_wr_records_actions() {
	if (isset($_GET['action'])) {
		require_once 'upl_wr_records.php';
		$action = $_GET['action'];
		$rid = key_exists('rid', $_GET) ? $_GET['rid'] : -1;
		if ($action == 'delete' || $action == 'restore') {
			upl_wr_records::change_state($rid);
			return true;
		}
		if ($action == 'rase') {
			upl_wr_check_admin();
			upl_wr_records::rase($rid);
			return true;
		}
		if ($action == 'view') {
			upl_wr_records::view($rid);
			return true;
		}
		if ($action == 'edit') {
			upl_wr_records::edit($rid);
			return true;
		}
	}
	return false;
}

function upl_wr_records() {
	if (!upl_wr_records_actions() ) {
		require_once 'upl_wr_records.php';
		if ( !current_user_can('manage_options') ) {
			upl_wr_records::show_approved_records();
		} else {
			upl_wr_records::show_all_records();
		}
	}
}

function upl_wr_new() {
	upl_wr_check_admin();
	$_GET['state'] = 1;
	upl_wr_records();
}

function upl_wr_my() {
	require_once 'upl_wr_records.php';
	if( isset($_POST['submit'])) {
		$name = key_exists('video_name', $_POST) ? $_POST['video_name'] : '';
		upl_wr_records::add($name);
		return;
	}
	if (!upl_wr_records_actions() ) {
		upl_wr_records::show_my_records();
		upl_wr_records::show_new_video_form();
	}
}

function wp_meta_upl_wr() {
	if ( is_user_logged_in() ) {
		$link = '<li><a href="' . get_option('siteurl') . '/wp-admin/admin.php?page=upl_wr_my">' . __('Webrecorder') . '</a></li>';
		echo apply_filters('joinchat', $link);
	}
}

function activate_upl_wr() {
	require_once 'upl_wr_install.php';
	upl_wr_install::install();
}

function deactivate_upl_wr() {
	require_once 'upl_wr_install.php';
	upl_wr_install::uninstall();
}

?>