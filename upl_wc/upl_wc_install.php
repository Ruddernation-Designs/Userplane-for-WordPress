<?php

class upl_wc_install {
	
	public function install() {
		require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_database.php');
		upl_database::create_table("upl_wc_config", "(
	  		id int(10) unsigned NOT NULL auto_increment,
			code varchar(62) NOT NULL,
			val varchar(1024) NOT NULL,
			pos int(10) unsigned NOT NULL,
			settype varchar(45) NOT NULL,
	  		block varchar(45) NOT NULL,
  			PRIMARY KEY  USING BTREE (id)
		);");
		upl_database::create_table("upl_wc_rooms", "(
			rid int(10) unsigned NOT NULL auto_increment,
  			name varchar(45) NOT NULL,
  			description varchar(512) NOT NULL,
  			creator_id int(10) unsigned NOT NULL,
  			PRIMARY KEY  (rid)
		);");
		upl_database::create_table("upl_wc_admin_rooms", "(
			aid int(10) unsigned NOT NULL auto_increment,
  			uid int(10) unsigned NOT NULL,
  			rid int(10) unsigned NOT NULL,
  			PRIMARY KEY  (aid)
		);");
		upl_database::create_table("upl_wc_restricted_rooms", "(
			id int(10) unsigned NOT NULL auto_increment,
  			uid int(10) unsigned NOT NULL,
  			rid int(10) unsigned NOT NULL,
  			allow int(1) unsigned NOT NULL,
  			PRIMARY KEY  (id)
		);");
		upl_database::create_table("upl_wc_users_privileges", "(
		  	pid int(10) unsigned NOT NULL auto_increment,
  			uid int(10) unsigned NOT NULL,
  			privilege int(10) unsigned NOT NULL,
  			PRIMARY KEY  (pid)
		);");
		upl_database::create_table("upl_wc_banned_users", "(
			bid int(10) unsigned NOT NULL auto_increment,
  			uid int(10) unsigned NOT NULL,
  			end int(10) unsigned NOT NULL,
  			start int(10) unsigned NOT NULL,
  			PRIMARY KEY (bid)
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

		upl_wc_install::add_config("('wc_chat_permitwhisper','1',1,'boolean','uss')");
//        upl_wc_install::add_config("('wc_chat_speaker','0',2,'boolean','uss')");
//        upl_wc_install::add_config("('wc_chat_notextentry','0',3,'boolean','uss')");
        upl_wc_install::add_config("('wc_chat_buddyviewableonly','0',4,'boolean','uss')");
//        upl_wc_install::add_config("('wc_chat_search','1',5,'boolean','uss')");
        upl_wc_install::add_config("('wc_chat_miniprofile','1',6,'boolean','uss')");
        upl_wc_install::add_config("('wc_chat_onlineusers','1',7,'boolean','uss')");
        upl_wc_install::add_config("('wc_chat_buddylist','1',8,'boolean','uss')");
        upl_wc_install::add_config("('wc_chat_permitcopy','1',9,'boolean','uss')");

        upl_wc_install::add_config("('wc_strflashcomserver','flashcom.yourcompany.userplane.com',1,'text','upl')");
        upl_wc_install::add_config("('wc_strdomainid','yourdomain.com',2,'text','upl')");
        upl_wc_install::add_config("('wc_banner_zone_id','',3,'text','upl')");
        upl_wc_install::add_config("('wc_text_zone_id','',4,'text','upl')");
        upl_wc_install::add_config("('wc_mini_zone_id','',5,'text','upl')");

        upl_wc_install::add_config("('wc_maxxmlretries','5',1,'text','sys')");
        upl_wc_install::add_config("('wc_sendconnectionlistinterval','-1',2,'text','sys')");
        upl_wc_install::add_config("('wc_sendarchive','0',3,'boolean','sys')");
        upl_wc_install::add_config("('wc_helplink','',4,'text','sys')");
        upl_wc_install::add_config("('wc_watermark','http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg',5,'text','sys')");
        upl_wc_install::add_config("('wc_conferencecallenabled','0',6,'boolean','sys')");
        upl_wc_install::add_config("('wc_conferencecalltext','Call the party line: ',7,'text','sys')");
        upl_wc_install::add_config("('wc_getannouncementsinterval','-1',8,'text','sys')");
        upl_wc_install::add_config("('wc_announcements','',9,'textarea','sys')");

        upl_wc_install::add_config("('wc_lobby','',1,'select','rms')");
        upl_wc_install::add_config("('wc_maxroomusers','20',2,'text','rms')");
        upl_wc_install::add_config("('wc_userroomcreate','1',3,'boolean','rms')");

        upl_wc_install::add_config("('wc_allowmoderatedrooms','0',1,'boolean','mds')");
        upl_wc_install::add_config("('wc_forbiddenwordslist','crap,shit',2,'text','mds')");
        upl_wc_install::add_config("('wc_floodcontrolresettime','5',3,'text','mds')");
        upl_wc_install::add_config("('wc_floodcontrolinterval','5',4,'text','mds')");
        upl_wc_install::add_config("('wc_floodcontrolmaxmessages','10',5,'text','mds')");
        upl_wc_install::add_config("('wc_characterlimit','200',6,'text','mds')");

        upl_wc_install::add_config("('wc_showjoinleavemessages','1',1,'boolean','msg')");
        upl_wc_install::add_config("('wc_maxhistorymessages','20',2,'text','msg')");
        upl_wc_install::add_config("('wc_initialinputlines','1',3,'text','msg')");

        upl_wc_install::add_config("('wc_maxdockitems','0',1,'text','gui')");
        upl_wc_install::add_config("('wc_viewprofile','1',2,'boolean','gui')");
        upl_wc_install::add_config("('wc_instantcommunicator','1',3,'boolean','gui')");
        upl_wc_install::add_config("('wc_addfriend','1',4,'boolean','gui')");
        upl_wc_install::add_config("('wc_block','1',5,'boolean','gui')");
        upl_wc_install::add_config("('wc_leftpaneminimized','0',6,'boolean','gui')");
        upl_wc_install::add_config("('wc_dockminimized','0',7,'boolean','gui')");
        upl_wc_install::add_config("('wc_help','0',8,'boolean','gui')");

        upl_wc_install::add_config("('wc_titlebarcolor','',1,'text','clr')");
        upl_wc_install::add_config("('wc_scrolltrackcolor','',2,'text','clr')");
        upl_wc_install::add_config("('wc_outerbackgroundcolor','',3,'text','clr')");
        upl_wc_install::add_config("('wc_innerbackgroundcolor','',4,'text','clr')");
        upl_wc_install::add_config("('wc_uifontcolor','',5,'text','clr')");
        upl_wc_install::add_config("('wc_buttoncolor','',6,'text','clr')");

        upl_wc_install::add_config("('wc_banoptionsmessage','How long would you like to ban this user?',1,'text','ban')");
        upl_wc_install::add_config("('wc_banoptions1','One Hour',2,'text','ban')");
        upl_wc_install::add_config("('wc_banoptions2','One Day',3,'text','ban')");
        upl_wc_install::add_config("('wc_banoptions3','One Week',4,'text','ban')");
        upl_wc_install::add_config("('wc_banoptions4','One Month',5,'text','ban')");
        upl_wc_install::add_config("('wc_banoptions5','Forever',6,'text','ban')");
        upl_wc_install::add_config("('wc_bannotification','<b>[[NAME]] was banned</b>',7,'text','ban')");

        upl_wc_install::add_config("('wc_sessiontimeout','-1',1,'text','tim')");
        upl_wc_install::add_config("('wc_sessiontimeoutmessage','Your session has expired.',2,'text','tim')");
        upl_wc_install::add_config("('wc_inactivitytimeout','10',3,'text','tim')");
        upl_wc_install::add_config("('wc_inactivitytimeoutmessage','You were timed out due to inactivity.',4,'text','tim')");
        upl_wc_install::add_config("('wc_roomemptytimeout','600',5,'text','tim')");

        upl_wc_install::add_config("('wc_avenabled','0',1,'boolean','avs')");
//        upl_wc_install::add_config("('wc_chat_audiosend','1',2,'boolean','avs')");
//        upl_wc_install::add_config("('wc_chat_videosend','1',3,'boolean','avs')");
//        upl_wc_install::add_config("('wc_chat_audioreceive','1',4,'boolean','avs')");
//        upl_wc_install::add_config("('wc_chat_videoreceive','1',5,'boolean','avs')");
        upl_wc_install::add_config("('wc_chat_audiokbps','10',6,'select','avs')");
        upl_wc_install::add_config("('wc_chat_videokbps','100',7,'text','avs')");
        upl_wc_install::add_config("('wc_chat_videofps','15',8,'text','avs')");
        upl_wc_install::add_config("('wc_chat_videosize','0',9,'select','avs')");
        upl_wc_install::add_config("('wc_chat_videodisplaysize','1',10,'text','avs')");

		upl_wc_install::add_config("('wc_useanonymousscreennames','0',1,'boolean','mini')");
		upl_wc_install::add_config("('wc_showusercount','1',2,'boolean','mini')");
		upl_wc_install::add_config("('wc_showwatcherusercount','1',3,'boolean','mini')");
//		upl_wc_install::add_config("('wc_allowtextinput','0',4,'boolean','mini')");
		upl_wc_install::add_config("('wc_allowroomuserlist','0',5,'boolean','mini')");
		upl_wc_install::add_config("('wc_useTimestamps','0',6,'boolean','mini')");
		upl_wc_install::add_config("('wc_branding','Userplane Webchat',7,'text','mini')");
		upl_wc_install::add_config("('wc_brandingOpacity','0.50',8,'text','mini')");
		upl_wc_install::add_config("('wc_chatButtonLabel','Enter Chat',9,'text','mini')");
		upl_wc_install::add_config("('wc_sendMessageButtonLabel','Post Message',10,'text','mini')");
		upl_wc_install::add_config("('wc_showMinichatFooter','1',11,'boolean','mini')");
		upl_wc_install::add_config("('wc_minichatBuddyPicURL','',12,'text','mini')");
		upl_wc_install::add_config("('wc_showMinichatBuddyPic','0',13,'boolean','mini')");
		upl_wc_install::add_config("('wc_showMinichatDescription','1',14,'boolean','mini')");
		upl_wc_install::add_config("('wc_showMinichatRoomName','1',15,'boolean','mini')");
		upl_wc_install::add_config("('wc_minichatBuddyPicMaxWidth','160',16,'text','mini')");
		upl_wc_install::add_config("('wc_minichatBuddyPicMaxHeight','60',17,'text','mini')");
		upl_wc_install::add_config("('wc_minichatBackgroundColor','FFA500',18,'text','mini')");
		upl_wc_install::add_config("('wc_minichatForegroundColor','FFFFFF',19,'text','mini')");
		upl_wc_install::add_config("('wc_minichatConversationBackgroundColor','FFFFFF',20,'text','mini')");
		upl_wc_install::add_config("('wc_minichatConversationBorderColor','00D2FF',21,'text','mini')");	
		upl_wc_install::add_config("('wc_historyNotificationMessage','********** The messages above were sent before you arrived',22,'text','mini')");
		upl_wc_install::add_config("('wc_whisperHowToMessage','********** To send a private message, type: <nameOfUser> your message here',23,'text','mini')");
		upl_wc_install::add_config("('wc_userJoinNotificationMessage','********** at TIMESTAMP SCREEN_NAME joined the room',24,'text','mini')");
		upl_wc_install::add_config("('wc_userLeaveNotificationMessage','********** at TIMESTAMP SCREEN_NAME left the room',25,'text','mini')");
		upl_wc_install::add_config("('wc_userNameChangeNotificationMessage','********** SCREEN_NAME has changed their name to NEW_SCREEN_NAME',26,'text','mini')");
		upl_wc_install::add_config("('wc_userMessageSentMessage','SCREEN_NAME: MESSAGE',27,'text','mini')");
		upl_wc_install::add_config("('wc_textAdvertisementMessage','Check out our sponsored link:',28,'text','mini')");
		upl_wc_install::add_config("('wc_userNotAuthorizedErrorMessage','You could not be authorized.\n\nPlease re-login to the\nwebsite and try again.',29,'textarea','mini')");
		upl_wc_install::add_config("('wc_serverLicenseErrorMessage','The license for this\nUserplane app is no longer valid.\n\nYou should have your webmaster contact\nUserplane Support (support@userplane.com)\nto resolve this issue.',30,'textarea','mini')");
		upl_wc_install::add_config("('wc_userBanNoticeErrorMessage','You\'ve been banned from this\napplication by a site administrator.\n\nYou\'ll need to get in touch with them\nfor more information.',31,'textarea','mini')");
		upl_wc_install::add_config("('wc_clientVersionErrorMessage','Your web browser is running an old\nversion of this application.\n\nYou should empty your browser\'s cache\nand log back in.',32,'textarea','mini')");
		upl_wc_install::add_config("('wc_serverMaxUsersErrorMessage','The chat has reached the max\nallowed number of users.\nPlease try again later.',33,'textarea','mini')");
		upl_wc_install::add_config("('wc_serverNoAdminErrorMessage','This chat requires that an Admin is\nlogged in at all times.\nCurrently none are connected.\nPlease try again later.',34,'textarea','mini')");
		upl_wc_install::add_config("('wc_invalidDomainErrorMessage','This chat is currently offline',35,'text','mini')");
		upl_wc_install::add_config("('wc_whisperSentMessage','You whispered to SCREEN_NAME',36,'text','mini')");
		upl_wc_install::add_config("('wc_whisperNotSentMessage','Your whisper wasn\'t sent. Please check the name and try again',37,'text','mini')");
		upl_wc_install::add_config("('wc_whisperReceivedMessage','SCREEN_NAME whispers',38,'text','mini')");
		upl_wc_install::add_config("('wc_whisperPersonalMessage','You whispered to yourself',39,'text','mini')");
		upl_wc_install::add_config("('wc_floodControlSlowDownMessage','********** Please slow down. You must wait a few seconds',40,'text','mini')");
		upl_wc_install::add_config("('wc_floodControlResumeMessage','********** You may now resume sending',41,'text','mini')");
		upl_wc_install::add_config("('wc_userCountLabel','chatting',44,'text','mini')");
		upl_wc_install::add_config("('wc_watcherCountLabel','observing',45,'text','mini')");
		upl_wc_install::add_config("('wc_copyrightText','╘2007 Userplane',46,'text','mini')");
	}
	
	private function add_config($sql) {
		global $wpdb;
		$wpdb->query("INSERT INTO " . $wpdb->prefix . 'upl_wc_config' . " (`code`,`val`,`pos`,`settype`,`block`) VALUES " . $sql);
	}
	
	public function uninstall() {
	   	require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_database.php');
		upl_database::drop_table("upl_wc_config");
		upl_database::drop_table("upl_wc_rooms");
		upl_database::drop_table("upl_wc_admin_rooms");
		upl_database::drop_table("upl_wc_restricted_rooms");
		upl_database::drop_table("upl_wc_users_privileges");
		upl_database::drop_table("upl_wc_banned_users");
		if(!upl_database::is_table_exists("upl_wm_config")) {
			upl_database::drop_table("upl_wc_blocked_users");
			upl_database::drop_table("upl_wc_buddy_users");
		}
	}
}

?>