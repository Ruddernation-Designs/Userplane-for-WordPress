<?php

class upl_wm_install {
	
	public function install() {
		require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_database.php');
		upl_database::create_table("upl_wm_config", "(
	  		id int(10) unsigned NOT NULL auto_increment,
			code varchar(62) NOT NULL,
			val varchar(1024) NOT NULL,
			pos int(10) unsigned NOT NULL,
			settype varchar(45) NOT NULL,
	  		block varchar(45) NOT NULL,
  			PRIMARY KEY  USING BTREE (id)
		);");
		upl_database::create_table("upl_wm_quickmess", "(
			qid int(11) NOT NULL auto_increment,
  			title varchar(64) NOT NULL,
  			body varchar(256) NOT NULL,
  			PRIMARY KEY (qid)
		);");
		upl_database::create_table("upl_wc_blocked_users", "(
			bid int(10) unsigned NOT NULL auto_increment,
  			uid int(10) unsigned NOT NULL,
  			blocked_uid int(10) unsigned NOT NULL,
  			PRIMARY KEY (bid)
		);");
		upl_database::create_table("upl_wc_buddy_users", "(
			bid int(10) unsigned NOT NULL auto_increment,
  			uid int(10) unsigned NOT NULL,
  			buddy_uid int(10) unsigned NOT NULL,
  			PRIMARY KEY (bid)
		);");

		upl_wm_install::add_config("('wm_strflashcomserver', 'flashcom.yourcompany.userplane.com', '1', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_strdomainid', 'yourdomain.com', '2', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_banner_zone_id', '', '3', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_password', '', '4', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_presents_id', '', '5', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_text_zone_id', '', '3', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_userlist_zone_id', '', '3', 'text', 'wmupl')");
		upl_wm_install::add_config("('wm_maxxmlretries', '5', '1', 'text', 'wmsys')");
		upl_wm_install::add_config("('wm_sendconnectionlistinterval', '-1', '2', 'text', 'wmsys')");
		upl_wm_install::add_config("('wm_sendarchive', '0', '3', 'boolean', 'wmsys')");
		upl_wm_install::add_config("('wm_conferencecallenabled', '0', '4', 'boolean', 'wmsys')");
		upl_wm_install::add_config("('wm_domainlogolarge', 'http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg', '5', 'text', 'wmsys')");
		upl_wm_install::add_config("('wm_sendTextToImages', '0', '6', 'boolean', 'wmsys')");
        upl_wm_install::add_config("('wm_helplink','',7,'text','wmsys')", $oSrvSec);;
		upl_wm_install::add_config("('wm_characterlimit', '200', '1', 'text', 'wmmds')");
		upl_wm_install::add_config("('wm_forbiddenwordslist', 'crap,shit', '2', 'text', 'wmmds')");
		upl_wm_install::add_config("('wm_clickableUserName', '1', '1', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_clickableTextUserName', '0', '2', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_gameButton', '1', '3', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_buddyListButton', '0', '4', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_preferencesButton', '0', '5', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_smileyButton', '1', '7', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_blockButton', '1', '8', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_addBuddyEnabled', '1', '9', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_kissSmackEnabled', '1', '10', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_showerrors', '1', '11', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_sound', '1', '12', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_focus', '1', '13', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_hideDropShadows', '0', '14', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_hideHelp', '0', '15', 'boolean', 'wmgui')");
//		upl_wm_install::add_config("('wm_showLocalUserIcon', '0', '16', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_buttonBarColor', '', '17', 'text', 'wmgui')");
		upl_wm_install::add_config("('wm_backgroundColor', '', '18', 'text', 'wmgui')");
		upl_wm_install::add_config("('wm_fontColor', '', '19', 'text', 'wmgui')");
		upl_wm_install::add_config("('wm_noTextEntry', '0', '20', 'boolean', 'wmgui')");
		upl_wm_install::add_config("('wm_systemMessagesWaiting', '0', '1', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_systemMessagesOpen', '0', '2', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_systemMessagesClosed', '0', '3', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_systemMessagesBlocked', '0', '4', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_systemMessagesAway', '0', '5', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_nonDeliveryMessageTimeout', '30', '6', 'text', 'wmsysmes')");
		upl_wm_install::add_config("('wm_nonDeliveryMessage', 'If [[DISPLAYNAME]] does not receive this message, they will be emailed when you close this window', '7', 'text', 'wmsysmes')");
		upl_wm_install::add_config("('wm_nonDeliveryMessageSendOnClose', '1', '8', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_nonDeliveryMessageSendOnTimeout', '0', '9', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_nonDeliveryMessagePromptUser', '0', '10', 'boolean', 'wmsysmes')");
		upl_wm_install::add_config("('wm_nonDeliveryConfirm', '', '11', 'text', 'wmsysmes')");
		upl_wm_install::add_config("('wm_conferenceCallInvitation', 'Join me in a private anonymous phone call: [[NUMBER]]', '12', 'text', 'wmsysmes')");
		upl_wm_install::add_config("('wm_conferenceCallReminder', 'Join a private anonymous phone call: [[NUMBER]]', '13', 'text', 'wmsysmes')");
		upl_wm_install::add_config("('wm_conferenceCallRetrievingNumber', 'Creating a private anonymous phone number...', '14', 'text', 'wmsysmes')");
		upl_wm_install::add_config("('wm_sessiontimeout', '-1', '1', 'text', 'wmtim')");
		upl_wm_install::add_config("('wm_sessiontimeoutmessage', 'Your session has expired.', '2', 'text', 'wmtim')");
		upl_wm_install::add_config("('wm_connectionTimeout', '60', '3', 'text', 'wmtim')");
		upl_wm_install::add_config("('wm_avenabled', '1', '1', 'boolean', 'wmavs')");
		upl_wm_install::add_config("('wm_maxvideobandwidth', '10000', '1', 'text', 'wmavs')");
//		upl_wm_install::add_config("('wm_audiosend', '1', '2', 'boolean', 'wmavs')");
//		upl_wm_install::add_config("('wm_videosend', '1', '3', 'boolean', 'wmavs')");
//		upl_wm_install::add_config("('wm_audioreceive', '1', '4', 'boolean', 'wmavs')");
//		upl_wm_install::add_config("('wm_videoreceive', '1', '5', 'boolean', 'wmavs')");
		upl_wm_install::add_config("('wm_autoOpenAV', '0', '6', 'boolean', 'wmavs')");
		upl_wm_install::add_config("('wm_autoStartAudio', '0', '7', 'boolean', 'wmavs')");
		upl_wm_install::add_config("('wm_autoStartVideo', '0', '8', 'boolean', 'wmavs')");
		upl_wm_install::add_config("('wm_buttonIconsAction', '', '1', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsAdd', '', '2', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsBlock', '', '3', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsBold', '', '4', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsBuddyList', '', '5', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsItalic', '', '6', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsPreferences', '', '7', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsPrint', '', '8', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsSmiley', '', '9', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsSoundOn', '', '10', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsSoundOff', '', '11', 'text', 'wmbutico')");
		upl_wm_install::add_config("('wm_buttonIconsUnderline', '', '12', 'text', 'wmbutico')");
	}
	
	private function add_config($sql) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . 'upl_wm_config' . " (`code`,`val`,`pos`,`settype`,`block`) VALUES " . $sql);
	}
	
	public function uninstall() {
	   	require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_database.php');
		upl_database::drop_table("upl_wm_config");
		upl_database::drop_table("upl_wm_quickmess");
		if(!upl_database::is_table_exists("upl_wc_config")) {
			upl_database::drop_table("upl_wc_blocked_users");
			upl_database::drop_table("upl_wc_buddy_users");
		}
	}
}

?>