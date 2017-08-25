<?php

require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_config.php');

class upl_wr_config {
	
	public function show_config_page() {
		require_once 'upl_wr_phrases.php';
		global $wpdb;
		$fields = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "upl_wr_config order by block, pos, code");
		upl_common_config::show_config_table($fields, 'wr');
	}
	
	public function save_config() {
		global $wpdb;
		foreach ($_POST['config_params'] as $code => $value) {
			$sql_update = "UPDATE " . $wpdb->prefix . "upl_wr_config
				SET val = '" . $value . "' WHERE code = '" . $code . "'";
			$wpdb->query($sql_update);
		}
		upl_common_config::config_saved();
	}

	public function get_wr_configuration() {
		global $wpdb;
		$result = $wpdb->get_results("SELECT code, val FROM " . $wpdb->prefix . "upl_wr_config");
		$config = array();
		foreach ($result as $res) {
			$config[$res->code] = $res->val;
		}
		return $config;
	}
	
}

?>