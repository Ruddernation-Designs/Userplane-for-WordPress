<?php

require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_config.php');

class upl_wc_config {
	
	public function show_config_page() {
		require_once 'upl_wc_phrases.php';
		global $wpdb;
		$fields = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wc_config order by block, pos, code");
		upl_common_config::show_config_table($fields, 'wc');
	}
	
	public function save_config() {
		global $wpdb;
		foreach ($_POST['config_params'] as $code => $value) {
			$sql_update = "UPDATE " . $wpdb->prefix . "upl_wc_config
				SET val = '" . $value . "' WHERE code = '" . $code . "'";
			$wpdb->query($sql_update);
		}
		upl_common_config::config_saved();
	}

	public function get_chat_configuration() {
		global $wpdb;
		$result = $wpdb->get_results("SELECT code, val FROM " . $wpdb->prefix . "upl_wc_config");
		$config = array();
		foreach ($result as $res) {
			$config[$res->code] = $res->val;
		}
		return $config;
	}
	
	public function get_lobby() {
		global $wpdb;
		$result = $wpdb->get_results("SELECT code, val FROM " . $wpdb->prefix . "upl_wc_config where code = 'wc_lobby'");
		$lobby_room = array('name' => 'Lobby', 'description' => 'Waiting room');
		foreach ($result as $lobby) {
			require_once 'upl_wc_rooms.php';
			$rooms = upl_wc_rooms::get_chat_rooms();
			foreach ($rooms as $room) {
				if($room->name == $lobby->val) {
					$lobby_room['name'] = $room->name;
					$lobby_room['description'] = $room->description;
					return $lobby_room;
				}
			}
			return $lobby_room;
		}
		return $lobby_room;
	}
	
}

?>