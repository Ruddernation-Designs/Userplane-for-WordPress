<?php

class upl_wc_rooms {
	
	public function show_list() {
		echo '<div class="wrap">';
		echo '<h2>' . __('Chat rooms') . '</h2>';
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_rooms order by name");
?>
		<table class="widefat"><tbody>
		<tr class="thead">
			<th><?php _e('ID') ?></th>
			<th><?php _e('Name') ?></th>
			<th><?php _e('Description') ?></th>
			<th colspan="2" style="text-align: center"><?php _e('Actions') ?></th>
		</tr>	
<?php
		foreach ($rooms as $room) {
			$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
?>
			<tr class="alternate">
				<td><?php echo ($room->rid); ?></td>
				<td><?php echo ($room->name); ?></td>
				<td><?php echo ($room->description); ?></td>
				<td>
<?php
				$edit_link = add_query_arg('action', "edit&rid=$room->rid" );
				echo "<a href='$edit_link' class='edit'>".__( 'Edit' )."</a>";
?>
				</td>
				<td>
<?php
				$edit_link = add_query_arg('action', "delete&rid=$room->rid" );
				echo "<a href='$edit_link' class='edit'>".__( 'Delete' )."</a>";
?>
				</td>
			</tr>	
<?php
		}
		echo '</tbody></table>';
		echo '</div>';
	}
	
	public function get_list_rooms_options($selected) {
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_rooms order by name");
		$result = '';
		foreach ($rooms as $room) {
			$result .= '<option value="' . __($room->name) . '" ' . ($room->name == $selected ? 'selected' : '') . ' >' . __($room->name) . '</option>';
		}
		return $result;
	}
	
	public function show_message($message, $type = 'updated fade', $link = false) {
		if ($link) {
			echo '<div id="message" class="' . $type . '"><p><strong>' . __($message) . '</strong></p><p><a href="admin.php?page=upl_wc_rooms">' . __('&laquo; Back to Chat Rooms') . '</a></p></div>';
		} else {
			echo '<div id="message" class="' . $type . '"><p><strong>' . __($message) . '</strong></p></div>';
		}
	}
	
	public function show_edit_room() {
		$rid = key_exists('rid', $_GET) ? $_GET['rid'] : '-1';
		global $wpdb;
		$room = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "upl_wc_rooms where rid = '" . $wpdb->escape($rid) . "'");
		if ($room == null) {
			upl_wc_rooms::show_message('No room found', 'error', true);
			return;
		}
		$message = "Edit Chat room";
		upl_wc_rooms::show_edit_room_form($message, $room);
	}
	
	public function show_edit_room_form($message, $room = null) {
		$rid = ($room != null) ? $room->rid : '';
		$name = ($room != null) ? $room->name : '';
		$description = ($room != null) ? $room->description : '';
		echo '<div class="wrap">';
		echo '<h2>' . __($message) . '</h2>';
		echo '<form method="post" action="">';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
		echo '<input name="room_rid" type="hidden" id="room_rid" value="'. $rid . '" />';
		echo '<table class="optiontable">';
		echo '<tr valign="top">';
		echo '<th scope="row">' . __('Room name') . ':</th>';
		echo '<td>';
		echo '<input name="room_name" type="text" id="room_name" value="'. $name . '" size="40" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row">' . __('Room description') . ':</th>';
		echo '<td>';
		echo '<input name="room_description" type="text" id="room_description" value="'. $description . '" size="40" />';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
		echo '</form>';
		echo '</div>';		
	}
	
	public function save_room($name, $description, $rid = '') {
		global $user_ID;
		$uid = $user_ID;
		global $wpdb;
		$name = $wpdb->escape($name);
		$description = $wpdb->escape($description);
		if ($rid == '' || $rid == '-1') {
			$sql = 'insert into ' . $wpdb->prefix . 'upl_wc_rooms (name, description, creator_id) values ("' . $name . '", "' . $description . '", "' . $uid . '")';
			$message = 'Room added.';
			$wpdb->query($sql);
			upl_wc_rooms::show_message($message);
		} else {
			$sql = 'update ' . $wpdb->prefix . 'upl_wc_rooms set name = "' . $name . '", description = "' . $description . '" where rid = ' . $rid;
			$message = 'Room changed.';
			$wpdb->query($sql);
			upl_wc_rooms::show_message($message, "updated fade", true);
		}
	}
	
	public function check_room_by_name($name, $not_rid = '') {
		if ($name == '') {
			upl_wc_rooms::show_message('Room name can not be empty.', "error", ($not_rid != ''));
			return true;
		}
		global $wpdb;
		$sql = "SELECT * FROM " . $wpdb->prefix . "upl_wc_rooms where name = '" . $wpdb->escape($name) . "'";
		if ($not_rid != '') {
			$sql .= ' and rid <> "' . $wpdb->escape($not_rid) . '"';
		}
		$room = $wpdb->get_row($sql);
		if ($room == null) {
			return false;
		}
		upl_wc_rooms::show_message('The room with specified name already exists.', "error", ($not_rid != ''));
		return true;
	}
	
	public function delete_room() {
		$rid = key_exists('rid', $_GET) ? $_GET['rid'] : '-1';
		global $wpdb;
		$sql = "DELETE FROM " . $wpdb->prefix . "upl_wc_rooms where rid = '" . $wpdb->escape($rid) . "'";
		$wpdb->query($sql);
		upl_wc_rooms::show_message('Room deleted.', "updated fade", true);
	}
	
	public function get_chat_rooms() {
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_rooms order by name");
	}
	
}

?>