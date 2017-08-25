<?php

	require_once '../userplane/common.php';

	function getConfigTable() {
		return App::getT('upl_web_messenger_config');
	}

	function get_wm_configuration($name, $default) {
		return get_module_configuration("wm_$name", $default);
	}

	function get_quickMessageList() {
		return getRows(App::getT('upl_web_messenger_quickmessages'), "");
	}
	
?>
