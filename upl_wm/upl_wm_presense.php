<?php

class upl_wm_presense {
	
	public function add_presence() {
		require_once 'presence.php';
		require_once 'upl_wm_config.php';
		$config = upl_wm_config::get_wm_configuration();
		$pid = $config['wm_presents_id'];
		$pwd = $config['wm_password'];
		global $user_ID;
		$url = get_option('siteurl') . '/wp-content/plugins/upl_wm/wm_ads.php';
		if($pid != '' && $pwd != '' && $user_ID != null) {
			up_presence($pid, $pwd, $user_ID, $url);
		}
	}	
	
}

?>