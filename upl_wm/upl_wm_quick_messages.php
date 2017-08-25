<?php

class upl_wm_quick_messages {
	
	public function show_list() {
		echo '<div class="wrap">';
		echo '<h2>' . __('Quick Messages management') . '</h2>';
		global $wpdb;
		$rooms = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wm_quickmess order by title");
?>
		<table class="widefat"><tbody>
		<tr class="thead">
			<th><?php _e('ID') ?></th>
			<th><?php _e('Title') ?></th>
			<th><?php _e('Body') ?></th>
			<th colspan="2" style="text-align: center"><?php _e('Actions') ?></th>
		</tr>	
<?php
		foreach ($rooms as $room) {
			$style = ( ' class="alternate"' == $style ) ? '' : ' class="alternate"';
?>
			<tr class="alternate">
				<td><?php echo ($room->qid); ?></td>
				<td><?php echo ($room->title); ?></td>
				<td><?php echo ($room->body); ?></td>
				<td>
<?php
				$edit_link = add_query_arg('action', "edit&qid=$room->qid" );
				echo "<a href='$edit_link' class='edit'>".__( 'Edit' )."</a>";
?>
				</td>
				<td>
<?php
				$edit_link = add_query_arg('action', "delete&qid=$room->qid" );
				echo "<a href='$edit_link' class='edit'>".__( 'Delete' )."</a>";
?>
				</td>
			</tr>	
<?php
		}
		echo '</tbody></table>';
		echo '</div>';
	}
	
	public function show_message($message, $type = 'updated fade', $link = false) {
		if ($link) {
			echo '<div id="message" class="' . $type . '"><p><strong>' . __($message) . '</strong></p><p><a href="admin.php?page=upl_wm_quick">' . __('&laquo; Back to Quick Messages List') . '</a></p></div>';
		} else {
			echo '<div id="message" class="' . $type . '"><p><strong>' . __($message) . '</strong></p></div>';
		}
	}
	
	public function show_edit_message() {
		$qid = key_exists('qid', $_GET) ? $_GET['qid'] : '-1';
		global $wpdb;
		$qmessage = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "upl_wm_quickmess where qid = '" . $wpdb->escape($qid) . "'");
		if ($qmessage == null) {
			upl_wm_quick_messages::show_message('No message found', 'error', true);
			return;
		}
		$message = "Edit Quick Message";
		upl_wm_quick_messages::show_edit_form($message, $qmessage);
	}
	
	public function show_edit_form($message, $qmessage = null) {
		$qid = ($qmessage != null) ? $qmessage->qid : '';
		$title = ($qmessage != null) ? $qmessage->title : '';
		$body = ($qmessage != null) ? $qmessage->body : '';
		echo '<div class="wrap">';
		echo '<h2>' . __($message) . '</h2>';
		echo '<form method="post" action="">';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
		echo '<input name="message_qid" type="hidden" id="message_qid" value="'. $qid . '" />';
		echo '<table class="optiontable">';
		echo '<tr valign="top">';
		echo '<th scope="row">' . __('Quick message title') . ':</th>';
		echo '<td>';
		echo '<input name="message_title" type="text" id="message_title" value="'. $title . '" size="40" />';
		echo '</td>';
		echo '</tr>';
		echo '<tr valign="top">';
		echo '<th scope="row">' . __('Quick message body') . ':</th>';
		echo '<td>';
		echo '<input name="message_body" type="text" id="message_body" value="'. $body . '" size="40" />';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Save &raquo;') .'" /></p>';
		echo '</form>';
		echo '</div>';		
	}
	
	public function save_message($title, $body, $qid = '') {
		global $wpdb;
		$title = $wpdb->escape($title);
		$body = $wpdb->escape($body);
		if ($qid == '' || $qid == '-1') {
			$sql = 'insert into ' . $wpdb->prefix . 'upl_wm_quickmess (title, body) values ("' . $title . '", "' . $body . '")';
			$message = 'Quick message added.';
			$wpdb->query($sql);
			upl_wm_quick_messages::show_message($message);
		} else {
			$sql = 'update ' . $wpdb->prefix . 'upl_wm_quickmess set title = "' . $title . '", body = "' . $body . '" where qid = ' . $qid;
			$message = 'Quick message changed.';
			$wpdb->query($sql);
			upl_wm_quick_messages::show_message($message, "updated fade", true);
		}
	}
	
	public function check_message_by_title($title, $not_qid = '') {
		if ($title == '') {
			upl_wm_quick_messages::show_message('Title can not be empty.', "error", ($not_qid != ''));
			return true;
		}
		global $wpdb;
		$sql = "SELECT * FROM " . $wpdb->prefix . "upl_wm_quickmess where title = '" . $wpdb->escape($title) . "'";
		if ($not_qid != '') {
			$sql .= ' and qid <> "' . $wpdb->escape($not_qid) . '"';
		}
		$room = $wpdb->get_row($sql);
		if ($room == null) {
			return false;
		}
		upl_wm_quick_messages::show_message('The quick message with specified title already exists.', "error", ($not_rid != ''));
		return true;
	}
	
	public function delete_message() {
		$qid = key_exists('qid', $_GET) ? $_GET['qid'] : '-1';
		global $wpdb;
		$sql = "DELETE FROM " . $wpdb->prefix . "upl_wm_quickmess where qid = '" . $wpdb->escape($qid) . "'";
		$wpdb->query($sql);
		upl_wm_quick_messages::show_message('Quick message deleted.', "updated fade", true);
	}
	
	public function get_quick_messages() {
		global $wpdb;
		return $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wm_quickmess order by title");
	}
	
}

?>