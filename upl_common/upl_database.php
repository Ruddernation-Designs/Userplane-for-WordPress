<?php

class upl_database {

	public function create_table($name, $sql) {
		global $wpdb;
		$table_name = $wpdb->prefix . $name;
		if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
	      	require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	      	$sql = "CREATE TABLE " . $table_name . " " . $sql;
    	  	dbDelta($sql);
		}
	}
	
	public function is_table_exists($name) {
		global $wpdb;
		$table_name = $wpdb->prefix . $name;
		return ($wpdb->get_var("show tables like '$table_name'") == $table_name);
	}
	
	public function drop_table($name) {
		global $wpdb;
		$table_name = $wpdb->prefix . $name;
		$wpdb->query("DROP TABLE " . $table_name);
	}
	
}

?>