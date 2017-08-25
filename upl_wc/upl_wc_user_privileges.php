<?php

class upl_wc_user_privileges {

	private function get_priveleges() {
//		return array(1 => "Userplane Chat access", 2 => "Useplane Chat Administrator", 3 => "Invisible in Userplane Chat");
		return array(2 => "Useplane Chat Administrator", 3 => "Invisible in Userplane Chat");
	}
	
	public function have_user_privilege($uid, $privilege) {
		if ($privilege == 1) {
			return true;
		}
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$privilege = $wpdb->escape($privilege);
		$result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_users_privileges WHERE uid = '$uid' and privilege = $privilege");		
		foreach ($result as $res) {
			return true;
		}
		return false;
	}
	
	public function show_users() {
		global $wpdb;
		$rooms = upl_wc_user_privileges::get_priveleges();
		echo '<div class="wrap">';
		echo '<h2>' . __('Users permissions') . '</h2>';
		echo '<script type="text/javascript" src="../wp-content/plugins/upl_wc/checkboxes.js" ></script>';
		echo '<form method="post" id="user_priv_form" action="">';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
		echo '<table class="widefat"><tbody>';
		upl_wc_user_privileges::show_header($rooms);
		$users = $wpdb->get_results("SELECT display_name, ID FROM " . $wpdb->users . " ORDER BY display_name");
		foreach ($users as $user) {
			$admin_rooms = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_users_privileges WHERE uid = '$user->ID'");
			upl_wc_user_privileges::show_user_row($user, $rooms, $admin_rooms);
		}
		echo '</table>';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
		echo '</form>';
		echo '</div>';		
	}

	private function show_header($rooms) {
		$count = count($rooms) + 1;
		$widht = 100 / $count;
?>
		<tr class="thead">
			<th width="<?php echo($widht); ?>%"><?php _e('User') ?></th>
<?php
		foreach ($rooms as $id => $name) {
			$regex = '^privilege\[\d*\]\[' . $id . '\]$';
			echo "<th width='$widht%'><input name='checkall$id' type='checkbox' OnClick='wcSelectAll(/$regex/i, this.checked, document.forms[\"user_priv_form\"])'  />&nbsp;" . __($name) . "</th>";
		}
?>
		</tr>	
<?php
	}
	
	private function show_user_row($user, $rooms, $admin_rooms) {
		$count = count($rooms) + 1;
		$widht = 100 / $count;
?>
		<tr class="alternate">
			<td width="<?php echo($widht); ?>%"><?php _e($user->display_name) ?></td>
<?php
		foreach ($rooms as $id => $room) {
			$name = "privilege[" . $user->ID . "][" . $id . "]";
			$checked = '';
			foreach ($admin_rooms as $admin) {
				if ($admin->privilege == $id) {
					$checked = "checked";
					break;
				}
			}
			echo "<td width='$widht%'><input type='checkbox' $checked name='$name' id='$name' /></td>";
		}
?>
		</tr>	
<?php		
	}
	
	public function save_users() {
		if ( !( isset($_POST) ) ) {
			return;
		}
		global $wpdb;
		$rooms = upl_wc_user_privileges::get_priveleges();
		$users = $wpdb->get_results("SELECT display_name, ID FROM " . $wpdb->users . " ORDER BY display_name");
	
		foreach ($users as $user) {
			foreach ($rooms as $pid => $privilege) {
				if (key_exists('privilege', $_POST) && key_exists($user->ID, $_POST["privilege"]) && key_exists($pid, $_POST["privilege"][$user->ID])) {
					$admin_room = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "upl_wc_users_privileges WHERE uid = '$user->ID' and privilege = '$pid'");
					if ($admin_room == null) {
						$wpdb->query("INSERT INTO " . $wpdb->prefix . "upl_wc_users_privileges (uid, privilege) VALUES ('$user->ID', '$pid')");
					}
				} else {
					$wpdb->query("DELETE FROM " . $wpdb->prefix . "upl_wc_users_privileges WHERE uid = '$user->ID' and privilege = '$pid'");
				}
			}
		}
		echo '<div id="message" class="updated fade"><p><strong>' . __('Permissions saved.') . '</strong></p></div>';
	}	
}

?>