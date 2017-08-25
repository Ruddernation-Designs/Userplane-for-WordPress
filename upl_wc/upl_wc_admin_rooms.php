<?php

class upl_wc_admin_rooms {
	
	public function get_admin_rooms($uid) {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		return $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_admin_rooms a inner join " . $wpdb->prefix . "upl_wc_rooms r on r.rid = a.rid WHERE a.uid = '$uid'");
	}
	
	public function show_admin_rooms() {
		$filter = "%" . upl_wc_admin_rooms::current_filter() . "%";
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT rid, name FROM " . $wpdb->prefix . "upl_wc_rooms where name LIKE '" . $wpdb->escape($filter) . "' order by name");
		if (count($rooms) == 0) {
			upl_wc_admin_rooms::show_message('No rooms found.', 'error');
		}
		echo '<div class="wrap">';
		echo '<h2>' . __('Chat Admin rooms') . '</h2>';
		upl_wc_admin_rooms::show_filter();
		if (count($rooms) > 0) {
			echo '<form method="post" action="">';
			echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
			echo '<table class="widefat"><tbody>';
			upl_wc_admin_rooms::show_header($rooms);
			$users = $wpdb->get_results("SELECT display_name, ID FROM " . $wpdb->users . " ORDER BY display_name");
			foreach ($users as $user) {
				$admin_rooms = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_admin_rooms WHERE uid = '$user->ID'");
				upl_wc_admin_rooms::show_user_admin_rooms_row($user, $rooms, $admin_rooms);
			}
			echo '</table>';
			echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
			echo '</form>';
		}
		echo '</div>';
	}
	
	private function show_user_admin_rooms_row($user, $rooms, $admin_rooms) {
		$count = count($rooms) + 1;
		$widht = 100 / $count;
?>
		<tr class="alternate">
			<td width="<?php echo($widht); ?>%"><?php _e($user->display_name) ?></td>
<?php
		foreach ($rooms as $room) {
			$name = "admin_room[" . $user->ID . "][" . $room->rid . "]";
			$checked = '';
			foreach ($admin_rooms as $admin) {
				if ($admin->rid == $room->rid) {
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
	
	private function show_header($rooms) {
		$count = count($rooms) + 1;
		$widht = 100 / $count;
?>
		<tr class="thead">
			<th width="<?php echo($widht); ?>%"><?php _e('User') ?></th>
<?php
		foreach ($rooms as $room) {
			echo "<th width='$widht%'>" . __($room->name) . "</th>";
		}
?>
		</tr>	
<?php
	}
	
	public function show_message($message, $type = 'updated fade') {
		echo '<div id="message" class="' . $type . '"><p><strong>' . __($message) . '</strong></p></div>';
	}

	public function save_admin_rooms() {
		if ( !( isset($_POST) ) ) {
			return;
		}
		$filter = "%" . upl_wc_admin_rooms::current_filter() . "%";
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT rid, name FROM " . $wpdb->prefix . "upl_wc_rooms where name LIKE '" . $wpdb->escape($filter) . "' order by name");
		$users = $wpdb->get_results("SELECT display_name, ID FROM " . $wpdb->users . " ORDER BY display_name");
	
		foreach ($users as $user) {
			foreach ($rooms as $room) {
				if (key_exists('admin_room', $_POST) && key_exists($user->ID, $_POST["admin_room"]) && key_exists($room->rid, $_POST["admin_room"][$user->ID])) {
					$admin_room = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "upl_wc_admin_rooms WHERE uid = '$user->ID' and rid = '$room->rid'");
					if ($admin_room == null) {
						$wpdb->query("INSERT INTO " . $wpdb->prefix . "upl_wc_admin_rooms (uid, rid) VALUES ('$user->ID', '$room->rid')");
					}
				} else {
					$wpdb->query("DELETE FROM " . $wpdb->prefix . "upl_wc_admin_rooms WHERE uid = '$user->ID' and rid = '$room->rid'");
				}
			}
		}
		upl_wc_admin_rooms::show_message('Admin rooms saved.');
	}
	
	private function current_filter() {
		return key_exists('filter' ,$_GET) ? $_GET['filter'] : '';
	}
	
	private function show_filter() {
		$filter_room_name = upl_wc_admin_rooms::current_filter();
?>
		<form method="get" action="">
		<p>
			<input type="hidden" name="page" id="page" value="upl_wc_adminrooms" />
			<input name="filter" id="filter" value="<?php echo $filter_room_name; ?>" type="text" /> 
			<input type="submit" class="button" value="<?php echo(__('Filter rooms »')); ?>" />
		</p>
		</form>
<?php		
	}
	
}

?>