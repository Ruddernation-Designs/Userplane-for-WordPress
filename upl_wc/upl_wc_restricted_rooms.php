<?php

class upl_wc_restricted_rooms {
	
	public function get_restricted_rooms($uid, $allow) {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$allow = $wpdb->escape($allow);
		return $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_restricted_rooms a inner join " . $wpdb->prefix . "upl_wc_rooms r on r.rid = a.rid WHERE a.uid = '$uid' and a.allow = $allow");
	}
	
	private function show_enabled_rooms_for_user($uid) {
		global $wpdb;
		$sql = "SELECT rid, name FROM " . $wpdb->prefix . "upl_wc_rooms r where r.rid not in (select rid from " . $wpdb->prefix . "upl_wc_restricted_rooms where uid = $uid)";
		$rooms = $wpdb->get_results($sql);
		if(count($rooms) == 0) {
			return;
		}
		
		echo '<form id = "room_for_' . $uid . '" method="post" action=""><p>';
		echo '<select name="room_name_for_' . $uid . '" id="room_name_for_' . $uid . '" value="">';
		foreach ($rooms as $room) {
			echo '<option value="' . __($room->rid) . '">' . __($room->name) . '</option>';
		}
		echo '</select>';
		echo '<input type="submit" class="button" name="submit_allow[' . $uid . ']" value="' . __('Allow') . '"/><input type="submit" class="button" name="submit_disallow[' . $uid . ']" value="' . __('Disallow') . '" />';
		echo '</p></form>';
	}
	
	public function show_list() {
		echo '<div class="wrap">';
		echo '<h2>' . __('Restricted Chat rooms') . '</h2>';
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT display_name as username, u.id as uid, rr.id as id, r.rid as rid, r.name as roomname, rr.allow as allow, r.description as  description FROM " . $wpdb->prefix . "upl_wc_restricted_rooms rr inner join " . $wpdb->prefix . "upl_wc_rooms r ON rr.rid = r.rid inner join " . $wpdb->users . " u ON u.id = rr.uid order by username, roomname");
		
		$last_user = '';
		foreach ($rooms as $room) {
			if($last_user != $room->username) {
				if($last_user != '') {
?>					
		</tbody></table>
<?php					
				}
				$last_user = $room->username;
?>
		<table class="widefat"><tbody>
		<tr>
			<th><h3><?php _e($room->username); ?></h3></th>
			<td colspan="3"><?php upl_wc_restricted_rooms::show_enabled_rooms_for_user($room->uid); ?></td>
		</tr>
		<tr class="thead">
			<th><?php _e('Room name') ?></th>
			<th><?php _e('Room description') ?></th>
			<th><?php _e('Allow restricted') ?></th>
			<th style="text-align: center"><?php _e('Actions') ?></th>
		</tr>	
<?php		}
			$edit_link = add_query_arg('action', "delete&id=$room->id" );
			$allow = ( $room->allow == 1 ) ? 'Yes' : 'No';
?>
			<tr class="alternate">
				<td><?php _e($room->roomname); ?></td>
				<td><?php _e($room->description); ?></td>
				<td><?php _e($allow); ?></td>
				<td><a href='<?php _e($edit_link); ?>' class='edit'><?php _e( 'Delete' ); ?></a></td>
			</tr>	
<?php
		}
?>					
		</tbody></table></div>
<?php					
	}
	
	public function show_edit_room_form($message, $room = null) {
?>
		<div class="wrap">
		<h2> <?php _e($message); ?></h2>
		<form method="post" action="">
		<p class="submit"><input type="submit" name="submit" value="<?php _e('Add &raquo;'); ?>" /></p>
		<table class="optiontable">
		<tr valign="top">
		<th scope="row"><?php _e('Room name'); ?>:</th>
		<td>
		<select name="room_name" id="room_name" value="">
<?php
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT rid, name FROM " . $wpdb->prefix . "upl_wc_rooms order by name");
		foreach ($rooms as $room) {
			echo '<option value="' . __($room->rid) . '">' . __($room->name) . '</option>';
		}
?>		
		</select>
		</td>
		</tr>
		<tr valign="top">
		<th scope="row"><?php _e('User name'); ?>:</th>
		<td>
		<select name="user_name" id="user_name" value="">
<?php
		$rooms = $wpdb->get_results("SELECT ID, display_name FROM " . $wpdb->users . " order by display_name");
		foreach ($rooms as $room) {
			echo '<option value="' . __($room->ID) . '">' . __($room->display_name) . '</option>';
		}
?>		
		</select>
		</td>
		</tr>
		<tr valign="top">
		<th scope="row"><?php _e('Allow resctricted'); ?>:</th>
		<td>
		<input type="checkbox" name="allow" id="allow" value="1"/>
		</td>
		</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" value="<?php _e('Add &raquo;'); ?>" /></p>
		</form>
		</div>
<?php		
	}

	public function add($rid, $uid, $allow) {
		global $wpdb;
		$rid = $wpdb->escape($rid);
		$uid = $wpdb->escape($uid);
		$allow = $wpdb->escape($allow);
		$sql = "SELECT * FROM " . $wpdb->prefix . "upl_wc_restricted_rooms where uid = '$uid' and rid = '$rid'";
		$room = $wpdb->get_row($sql);
		$sql_insert = "insert into " .$wpdb->prefix . "upl_wc_restricted_rooms (uid, rid, allow) values ('$uid', '$rid', '$allow')";
		$message = 'Restricted room added.';
		if ($room != null) {
			$sql_insert = "update " .$wpdb->prefix . "upl_wc_restricted_rooms set allow = '$allow' where uid = '$uid' and rid = '$rid'";
			$message = 'Restricted room changed.';
		}
		$wpdb->query($sql_insert);
		echo '<div id="message" class="updated fade"><p><strong>' . __($message) . '</strong></p></div>';
		return true;
	}
	
	public function delete() {
		$id = key_exists('id', $_GET) ? $_GET['id'] : '-1';
		global $wpdb;
		$sql = "DELETE FROM " . $wpdb->prefix . "upl_wc_restricted_rooms where id = '" . $wpdb->escape($id) . "'";
		$wpdb->query($sql);
		echo '<div id="message" class="updated fade"><p><strong>' . __('Restricted room was deleted.') . '</strong></p><p><a href="admin.php?page=upl_wc_restrooms">' . __('&laquo; Back to Chat Restricted Rooms') . '</a></p></div>';
	}
	
}

?>