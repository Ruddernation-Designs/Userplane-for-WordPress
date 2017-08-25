<?php
/*
Plugin Name: Userplane Instant Message
Plugin URI: http://userplane.com/
Description: Userplane Instant Message application.
Version: 1.0.0
Author: userplane.com
Author URI: http://userplane.com/
*/

register_activation_hook(__FILE__, 'activate_upl_wm');
add_action('deactivate_upl_wm/upl_wm.php', 'deactivate_upl_wm');
add_action('init', 'init_upl_wm');
add_action('upl_webmessenger', 'upl_wm_front_end');
add_action('admin_footer', 'admin_footer_upl_wm');
add_action('wp_head', 'admin_footer_upl_wm');
add_action('upl_widget', 'wp_meta_upl_wm');

function init_upl_wm() {
	add_action('admin_menu', 'upl_wm_config_page');
}

function upl_wm_config_page() {
	if ( function_exists('add_submenu_page') ) {
		add_submenu_page('upl_common/upl_common.php', __('Instant Message configuration'), __('Instant Message configuration'), 'manage_options', 'upl_wm_conf', 'upl_wm_conf');
		add_submenu_page('upl_common/upl_common.php', __('Quick Messages'), __('Quick Messages'), 'manage_options', 'upl_wm_quick', 'upl_wm_quick');
	}
}

function upl_wm_check_admin() {
	if ( !current_user_can('manage_options') ) {
		wp_die(__('Cheatin&#8217; uh?'));
	}
}

function upl_wm_conf() {
	upl_wm_check_admin();
	require_once 'upl_wm_config.php';
	if ( isset($_POST['submit']) ) {
		upl_wm_config::save_config();
	}
	upl_wm_config::show_config_page();
}

function upl_wm_quick() {
	upl_wm_check_admin();
	require_once 'upl_wm_quick_messages.php';
	
	if (key_exists('action', $_GET) && $_GET['action'] == 'edit') {
		if ( isset($_POST['submit']) ) {
			$qid = key_exists('message_qid', $_POST) ? $_POST['message_qid'] : '-1';
			$title = key_exists('message_title', $_POST) ? $_POST['message_title'] : '';
			$body = key_exists('message_body', $_POST) ? $_POST['message_body'] : '';
			if ( !upl_wm_quick_messages::check_message_by_title($title, $qid) ) {
				upl_wm_quick_messages::save_message($title, $body, $qid);
			}
		}
		upl_wm_quick_messages::show_edit_message();
		return;
	}
	if ( isset($_POST['submit']) ) {
		$title = key_exists('message_title', $_POST) ? $_POST['message_title'] : '';
		$body = key_exists('message_body', $_POST) ? $_POST['message_body'] : '';
		if ( !upl_wm_quick_messages::check_message_by_title($title) ) {
			upl_wm_quick_messages::save_message($title, $body);
		}
	}
	if (key_exists('action', $_GET) && $_GET['action'] == 'delete') {
		upl_wm_quick_messages::delete_message();
		return;
	}	
	
	upl_wm_quick_messages::show_list();
	upl_wm_quick_messages::show_edit_form('Add new Quick Message');
}

function upl_wm_launch_wm_script() {
?>
	<script language='javascript' type='text/javascript'>
	<!--
			function wm_makecontent() {
				myWindow = window.open('<?php echo(get_option('siteurl')); ?>/wp-content/plugins/upl_wm/ul_ads.php?', 'ULWindow', 'width=200,height=750,toolbar=0,directories=0,menubar=0,status=0,location=0,scrollbars=0,resizable=1');
			}
	--> 
	</script>
<?php
}

function upl_wm_front_end() {
?>
	<div class="wrap">
	<h2><?php _e('Buddy List'); ?></h2>
	<?php upl_wm_launch_wm_script(); ?>
	<a href='javascript:wm_makecontent()'>Launch Buddy List</a>
	</div>
<?php
		global $wpdb;
		global $user_ID;;
		$users = $wpdb->get_results("SELECT ID, display_name FROM " . $wpdb->users . " where ID <> " . $user_ID);
		if(count($users) != 0) {
?>		
			<div class="wrap">
			<h2><?php _e('Instant message'); ?></h2>
			<script language='javascript' type='text/javascript'>
			<!--
				function instant_message() {
					var userID = <?php echo($user_ID); ?>;
					var cb = document.getElementById('instant_message_users');
					destinationUserID = cb.value;
					var popupWindowTest = window.open( "<?php echo(get_option('siteurl')); ?>/wp-content/plugins/upl_wm/wm_ads.php?strDestinationUserID=" + destinationUserID, "WMWindow_" + userID + "_" + destinationUserID, "width=468,height=595,toolbar=0,directories=0,menubar=0,status=0,location=0,scrollbars=0,resizable=1" );
				}
			--> 
			</script>
			<select name="instant_message_users" id="instant_message_users" value="">
<?php
			foreach ($users as $user) {
				echo '<option value="' . __($user->ID) . '">' . __($user->display_name) . '</option>';
			}
?>		
			</select>
			<a href='javascript:instant_message()'>Instant message</a>
			</div>
<?php
		}
}

function admin_footer_upl_wm() {
	require_once 'upl_wm_presense.php';
	upl_wm_presense::add_presence();
}

function wp_meta_upl_wm() {
	if ( is_user_logged_in() ) {
		upl_wm_launch_wm_script();
		$link = '<li><a href="javascript:wm_makecontent()">' . __('IM List') . '</a></li>';
		echo apply_filters('buddylist', $link);
	}
}

function activate_upl_wm() {
	require_once 'upl_wm_install.php';
	upl_wm_install::install();
}

function deactivate_upl_wm() {
	require_once 'upl_wm_install.php';
	upl_wm_install::uninstall();
}

?>