<?php

class upl_wr_install {
	
	public function install() {
		require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_database.php');
		upl_database::create_table("upl_wr_config", "(
	  		id int(10) unsigned NOT NULL auto_increment,
			code varchar(62) NOT NULL,
			val varchar(1024) NOT NULL,
			pos int(10) unsigned NOT NULL,
			settype varchar(45) NOT NULL,
	  		block varchar(45) NOT NULL,
  			PRIMARY KEY (id)
		);");
		upl_database::create_table("upl_wr_records", "(
			rid int(11) NOT NULL auto_increment,
  			name varchar(64) NOT NULL,
  			uid int(11) NOT NULL,
  			state int(11) NOT NULL,
  			PRIMARY KEY (rid)
		);");
		upl_wr_install::add_config("('wr_banner_zone_id', '', '3', 'text', 'wrupl')");
		upl_wr_install::add_config("('wr_strdomainid', 'yourdomain.com', '2', 'text', 'wrupl')");
		upl_wr_install::add_config("('wr_strflashcomserver', 'flashcom.yourcompany.userplane.com', '1', 'text', 'wrupl')");
		upl_wr_install::add_config("('wr_sendrecordinglistinterval', '1', '2', 'text', 'wrsys')");
		upl_wr_install::add_config("('wr_maxxmlretries', '5', '1', 'text', 'wrsys')");
		upl_wr_install::add_config("('wr_maxrecordseconds', '60', '3', 'text', 'wrsys')");
		upl_wr_install::add_config("('wr_autoApprove', '0', '4', 'boolean', 'wrsys')");
		upl_wr_install::add_config("('wr_novideoimage', '', '5', 'text', 'wrsys')");
		upl_wr_install::add_config("('wr_videonotenabledimage', '', '6', 'text', 'wrsys')");
		upl_wr_install::add_config("('wr_videoenabled', '1', '1', 'boolean', 'wravs')");
		upl_wr_install::add_config("('wr_chat_audiokbps', '0', '2', 'select', 'wravs')");
		upl_wr_install::add_config("('wr_chat_videokbps', '100', '3', 'text', 'wravs')");
		upl_wr_install::add_config("('wr_chat_videofps', '10', '4', 'text', 'wravs')");
		upl_wr_install::add_config("('wr_chat_videosize', '0', '5', 'select', 'wravs')");
		upl_wr_install::add_config("('wr_adminsips', '', '1', 'textarea', 'wrsys')");	
	}
	
	private function add_config($sql) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . 'upl_wr_config' . " (`code`,`val`,`pos`,`settype`,`block`) VALUES " . $sql);
	}
	
	public function uninstall() {
	   	require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_database.php');
		upl_database::drop_table("upl_wr_config");
		upl_database::drop_table("upl_wr_records");
	}
}

?>