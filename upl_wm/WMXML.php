<?php

	header( "Content-Type: text/xml; charset=utf-8" );
	
	echo( "<?xml version='1.0' encoding='utf-8'?>" );
	echo( "<!-- COPYRIGHT Userplane 2006 (http://www.userplane.com) -->" );
	echo( "<!-- WM version 1.8.13 -->" );
	echo( "<icappserverxml>" );

	$strDomainID = isset($_GET['domainID']) ? $_GET['domainID'] : null;
	$strFunction = isset($_GET['function']) ? $_GET['function'] : (isset($_GET['action']) ? $_GET['action'] : null);
	$strCallID = isset($_GET['callID']) ? $_GET['callID'] : null;

	function get_wm_configuration($name, $default) {
		global $configuration;
		$name = 'wm_' . $name;
		if (key_exists($name, $configuration)) {
			return $configuration[$name];
		}
		$name = strtolower($name);
		if (key_exists($name, $configuration)) {
			return $configuration[$name];
		} else {
			echo '!!!!!!!!!!!!!!!!!!!';
			return $default;
		}
	}
	
	if( $strFunction != null && $strDomainID != null ) {
		$strSessionGUID = isset($_GET['sessionGUID']) ? $_GET['sessionGUID'] : null;
		$strKey = isset($_GET['key']) ? $_GET['key'] : null;
		$strUserID = isset($_GET['memberID']) ? $_GET['memberID'] : null;
		$strTargetUserID = isset($_GET['targetMemberID']) ? $_GET['targetMemberID'] : null;
		
		if( $strFunction == "getDomainPreferences" ) {
			require_once '../upl_common/upl_common_init_engine.php';
			require_once 'upl_wm_config.php';
			global $configuration;
			$configuration = upl_wm_config::get_wm_configuration();

			// get the value from your database
			echo( "<allowCalls>setBlockedStatus,sendConnectionList,startConversation,addFriend</allowCalls>" );
			echo( "<characterlimit>" . get_wm_configuration('characterlimit', 200) . "</characterlimit>" );
			echo( "<forbiddenwordslist>" . get_wm_configuration('forbiddenwordslist', "ass,bitch") . "</forbiddenwordslist>" );
		echo( "<smileys>" );
			echo( "<smiley>" );
						echo( "<name>Love</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Love</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/heart.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[love]]></code>" );
									echo( "<code><![CDATA[heart]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Love</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Cock</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/cock.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[cock]]></code>" );
									echo( "<code><![CDATA[penis]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Cock</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>HB</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/hb.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[hb]]></code>" );
									echo( "<code><![CDATA[HB]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>HB</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Canada</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/canada.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[Canada]]></code>" );
									echo( "<code><![CDATA[canadian]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Canada</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>WB</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/wb.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[wb]]></code>" );
									echo( "<code><![CDATA[WB]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>WB</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>WTF</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/wtf.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[wtf]]></code>" );
									echo( "<code><![CDATA[WTF]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>WTF</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Lightning</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/lightning.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[lightning]]></code>" );
									echo( "<code><![CDATA[Lightning]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Lightning</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					echo( "<smiley>" );
							echo( "<name>Boobs</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/boobs.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[boobs]]></code>" );
									echo( "<code><![CDATA[tits]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Boobs</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Chav</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/chav.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[chav]]></code>" );
									echo( "<code><![CDATA[noob]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Chav</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>FuckYou</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/finger.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[fucku]]></code>" );
									echo( "<code><![CDATA[fu]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>FuckYou</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>KissMyAss</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/kissass.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[kissmyass]]></code>" );
									echo( "<code><![CDATA[kma]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>KissMyAss</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Mooning</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/mooning.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[moon]]></code>" );
									echo( "<code><![CDATA[moons]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Mooning</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>URGay</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/urgay.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[gay]]></code>" );
									echo( "<code><![CDATA[puff]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>URGay</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>YouSuck</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/yousuck.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[yousuck]]></code>" );
									echo( "<code><![CDATA[suck]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>YouSuck</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Thong</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/thong.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[thong]]></code>" );
									echo( "<code><![CDATA[ass]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Thong</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						
						echo( "<smiley>" );
							echo( "<name>Hotdog</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/hotdog.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[hotdog]]></code>" );
									echo( "<code><![CDATA[poisoned]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Hotdog</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Devil</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/sexy.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[devil]]></code>" );
									echo( "<code><![CDATA[sexy]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Devil</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
						echo( "<smiley>" );
							echo( "<name>kiss</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/lips.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[kiss]]></code>" );
									echo( "<code><![CDATA[:*]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>kiss</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>UK</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/british.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[UK]]></code>" );
									echo( "<code><![CDATA[uk]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>UK</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>alien</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/alien.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[alien]]></code>" );
									echo( "<code><![CDATA[ET]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>alien</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>burger</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/burger.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[burger]]></code>" );
									echo( "<code><![CDATA[burger]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>burger</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>Music</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/jukebox.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[music]]></code>" );
									echo( "<code><![CDATA[radio]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Music</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>No Smoking</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/no-smoking.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[no-smoking]]></code>" );
									echo( "<code><![CDATA[no-smoking]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>No Smoking</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>Stop</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/stop.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[stop]]></code>" );
									echo( "<code><![CDATA[Stop]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Stop</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
					
					echo( "<smiley>" );
							echo( "<name>USA</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/usa.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[USA]]></code>" );
									echo( "<code><![CDATA[usa]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>USA</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Rose</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/rose.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[rose]]></code>" );
									echo( "<code><![CDATA[Rose]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Rose</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Sunny</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/sunny.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[sunny]]></code>" );
									echo( "<code><![CDATA[sun]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Sunny</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>@</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/@.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[@]]></code>" );
									echo( "<code><![CDATA[@]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>@</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
					
						
						echo( "<smiley>" );
							echo( "<name>Beer</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/beer.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[beer]]></code>" );
									echo( "<code><![CDATA[cans]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Beer</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
					
						echo( "<smiley>" );
							echo( "<name>Biohazard</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/biohazard.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[biohazard]]></code>" );
									echo( "<code><![CDATA[bio]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Biohazard</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Disabled</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/disabled.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[disabled]]></code>" );
									echo( "<code><![CDATA[sick]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Disabled</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						
						echo( "<smiley>" );
							echo( "<name>Radioactive</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/radioactive.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[radioactive]]></code>" );
									echo( "<code><![CDATA[smelly]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Radioactive</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Rain</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/rain.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[rain]]></code>" );
									echo( "<code><![CDATA[raining]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Rain</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Snow</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/snow.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[snow]]></code>" );
									echo( "<code><![CDATA[snowing]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Snow</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						
						
						echo( "<smiley>" );
							echo( "<name>BRB</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/brb.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[brb]]></code>" );
									echo( "<code><![CDATA[BRB]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>BRB</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						
						echo( "<smiley>" );
							echo( "<name>Coffee</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/coffee.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[coffee]]></code>" );
									echo( "<code><![CDATA[brew]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Coffee</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>England</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/england.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[england]]></code>" );
									echo( "<code><![CDATA[England]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>England</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Eye</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/eye.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[i]]></code>" );
									echo( "<code><![CDATA[eye]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Eye</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Geek</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/geek.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[geek]]></code>" );
									echo( "<code><![CDATA[nerd]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Geek</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Gun</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/gun.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[gun]]></code>" );
									echo( "<code><![CDATA[shoot]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Gun</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						
						
						echo( "<smiley>" );
							echo( "<name>Monster</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/monster.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[monster]]></code>" );
									echo( "<code><![CDATA[scary]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Monster</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Phone</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/phone.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[phone]]></code>" );
									echo( "<code><![CDATA[fone]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Phone</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Pizza</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/pizza.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[pizza]]></code>" );
									echo( "<code><![CDATA[Pizza]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Pizza</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>?</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/questionmark.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[?]]></code>" );
									echo( "<code><![CDATA[what]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>?</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Sleep</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/sleep.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[sleep]]></code>" );
									echo( "<code><![CDATA[tired]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Sleep</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Bite</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/teeth.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[bite]]></code>" );
									echo( "<code><![CDATA[bites]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Bite</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>WTF</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/wtf.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[wtf]]></code>" );
									echo( "<code><![CDATA[WTF]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>WTF</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
						
						echo( "<smiley>" );
							echo( "<name>Lies</name>" );
							echo( "<image>http://www.YourDomain.com/wp-content/plugins/upl_wc/smileys/lies.jpg</image>" );
							echo( "<codes>" );
				                	echo( "<code><![CDATA[lies]]></code>" );
									echo( "<code><![CDATA[liar]]></code>" );
							echo( "</codes>" );
					echo( "</smiley>" );
					echo( "<smiley>" );
						echo( "<name>Lies</name>" );
	//				echo( "<image>DELETE</image>" );
						echo( "</smiley>" );
			echo( "</smileys>" );
			echo( "<maxvideobandwidth>" . get_wm_configuration('maxvideobandwidth', 20000) . "</maxvideobandwidth>" );
			echo( "<domainlogolarge>" . get_wm_configuration('domainlogolarge','http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg') . "</domainlogolarge>" );
			echo "<line1>Sex</line1>";
			echo "<line2>Location</line2>";
			echo "<line3>Birthday</line3>";
			echo "<line4></line4>";
			echo( "<avEnabled>" . (get_wm_configuration("avenabled", 1) == 0 ? "false" : "true") . "</avEnabled>" );
			echo( "<clickableUserName>" . (get_wm_configuration("clickableUserName", 1) == 0 ? "false" : "true") . "</clickableUserName>" );
			echo( "<clickableTextUserName>" . (get_wm_configuration("clickableTextUserName", 0) == 0 ? "false" : "true") . "</clickableTextUserName>" );
			echo( "<gameButton>" . (get_wm_configuration("gameButton", 1) == 0 ? "false" : "true") . "</gameButton>" );
			echo( "<buddyListButton>" . (get_wm_configuration("buddyListButton", 0) == 0 ? "false" : "true") . "</buddyListButton>" );
			echo( "<preferencesButton>" . (get_wm_configuration("preferencesButton", 0) == 0 ? "false" : "true") . "</preferencesButton>" );
			echo( "<smileyButton>" . (get_wm_configuration("smileyButton", 1) == 0 ? "false" : "true") . "</smileyButton>" );
			echo( "<blockButton>" . (get_wm_configuration("blockButton", 1) == 0 ? "false" : "true") . "</blockButton>" );
			echo( "<addBuddyEnabled>" . (get_wm_configuration("addBuddyEnabled", 1) == 0 ? "false" : "true") . "</addBuddyEnabled>" );
			echo( "<connectionTimeout>" . get_wm_configuration('connectionTimeout', 60) . "</connectionTimeout>" );
			echo( "<sendConnectionListInterval>" . get_wm_configuration('sendConnectionListInterval', 0) . "</sendConnectionListInterval>" );
			echo( "<sendArchive>" . (get_wm_configuration("sendArchive", 0) == 0 ? "false" : "true") . "</sendArchive>" );
			echo( "<sendTextToImages>" . (get_wm_configuration("sendTextToImages", 0) == 0 ? "false" : "true") . "</sendTextToImages>" );
			echo( "<buttonBarColor>" . get_wm_configuration('buttonBarColor', '') . "</buttonBarColor>" );
			echo( "<hideDropShadows>" . (get_wm_configuration("hideDropShadows", 0) == 0 ? "false" : "true") . "</hideDropShadows>" );
			echo( "<hideHelp>" . (get_wm_configuration("hideHelp", 0) == 0 ? "false" : "true") . "</hideHelp>" );
			echo( "<showLocalUserIcon>false</showLocalUserIcon>" );
			echo( "<conferenceCallEnabled>" . (get_wm_configuration("conferenceCallEnabled", 0) == 0 ? "false" : "true") . "</conferenceCallEnabled>" );
			echo( "<maxxmlretries>" . get_wm_configuration('maxxmlretries', 5) . "</maxxmlretries>" );
			echo( "<buttonIcons>" );
				echo( "<action>" . get_wm_configuration('buttonIconsAction', '') . "</action>" );
				echo( "<add>" . get_wm_configuration('buttonIconsAdd', '') . "</add>" );
				echo( "<block>" . get_wm_configuration('buttonIconsBlock', '') . "</block>" );
				echo( "<bold>" . get_wm_configuration('buttonIconsBold', '') . "</bold>" );
				echo( "<buddyList>" . get_wm_configuration('buttonIconsBuddyList', '') . "</buddyList>" );
				echo( "<italic>" . get_wm_configuration('buttonIconsItalic', '') . "</italic>" );
				echo( "<preferences>" . get_wm_configuration('buttonIconsPreferences', '') . "</preferences>" );
				echo( "<print>" . get_wm_configuration('buttonIconsPrint', '') . "</print>" );
				echo( "<smiley>" . get_wm_configuration('buttonIconsSmiley', '') . "</smiley>" );
				echo( "<soundOn>" . get_wm_configuration('buttonIconsSoundOn', '') . "</soundOn>" );
				echo( "<soundOff>" . get_wm_configuration('buttonIconsSoundOff', '') . "</soundOff>" );
				echo( "<underline>" . get_wm_configuration('buttonIconsUnderline', '') . "</underline>" );
			echo( "</buttonIcons>" );
			echo( "<systemMessages>" );
				echo( "<waiting>" . (get_wm_configuration("systemMessagesWaiting", 0) == 0 ? "false" : "true") . "</waiting>" );
				echo( "<open>" . (get_wm_configuration("systemMessagesOpen", 0) == 0 ? "false" : "true") . "</open>" );
				echo( "<closed>" . (get_wm_configuration("systemMessagesClosed", 0) == 0 ? "false" : "true") . "</closed>" );
				echo( "<blocked>" . (get_wm_configuration("systemMessagesBlocked", 0) == 0 ? "false" : "true") . "</blocked>" );
				echo( "<away>" . (get_wm_configuration("systemMessagesAway", 0) == 0 ? "false" : "true") . "</away>" );
				echo( "<nonDeliveryMessage timeout='" . get_wm_configuration('nonDeliveryMessageTimeout', 30) . "' sendOnClose='" . (get_wm_configuration("nonDeliveryMessageSendOnClose", 1) == 0 ? "false" : "true") . "' sendOnTimeout='" . (get_wm_configuration("nonDeliveryMessageSendOnTimeout", 0) == 0 ? "false" : "true") . "' promptUser='" . (get_wm_configuration("nonDeliveryMessagePromptUser", 0) == 0 ? "false" : "true") . "'>" . get_wm_configuration('nonDeliveryMessage', "If [[DISPLAYNAME]] doesn't receive this message, they will be emailed when you close this window") . "</nonDeliveryMessage>" );
				echo( "<nonDeliveryConfirm>" . get_wm_configuration('nonDeliveryConfirm', '') . "</nonDeliveryConfirm>" );
				echo( "<conferenceCallInvitation>" . get_wm_configuration('conferenceCallInvitation', 'Join me in a private anonymous phone call: [[NUMBER]]') . "</conferenceCallInvitation>" );
				echo( "<conferenceCallReminder>" . get_wm_configuration('conferenceCallReminder', 'Join a private anonymous phone call: [[NUMBER]]') . "</conferenceCallReminder>" );
				echo( "<conferenceCallRetrievingNumber>" . get_wm_configuration('conferenceCallRetrievingNumber', 'Creating a private anonymous phone number...') . "</conferenceCallRetrievingNumber>" );				
			echo( "</systemMessages>" );
			require_once 'upl_wm_quick_messages.php';
			$quickMessageList = upl_wm_quick_messages::get_quick_messages();
			echo( "<quickMessageList>" );
			foreach ($quickMessageList as $quickMessage) {
				echo( "<message>" );
					echo( "<title>" . $quickMessage->title . "</title>" );
					echo( "<body>" . $quickMessage->body . "</body>" );			
				echo( "</message>" );
			} 
			echo( "</quickMessageList>" );
		}
		else if( $strFunction == "getMemberID" ) {
			if( $strSessionGUID != null && $strSessionGUID != "" ) {
				require_once '../upl_common/upl_common_init_engine.php';
				require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
				$uid = upl_common_user::get_user_by_session_id($strSessionGUID);
				if($uid == null || $uid == '') {
					$uid = 'INVALID';
				}
				echo( "<memberid>$uid</memberid>" );
			}
		}
		else if( $strFunction == "startIC" ) {
			if( $strUserID != null && $strUserID != "" && $strTargetUserID != null && $strTargetUserID != "" ) {
				require_once '../upl_common/upl_common_init_engine.php';
				require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
				require_once 'upl_wm_config.php';
				global $configuration;
				$configuration = upl_wm_config::get_wm_configuration();
				$member = upl_common_user::get_user_with_user_id($strUserID);
				if($member == null) {
					echo( "<member>INVALID</member>" );
				} else {
					echo( "<member>" );
						echo( "<displayname>" . $member->display_name . "</displayname>" );
						echo( upl_common_user::get_user_chat_icon($member->ID, "imagepath"));
						echo( "<avEnabled>" . (get_wm_configuration("avenabled", 1) == 0 ? "false" : "true") . "</avEnabled>" );
						echo( "<audioSend>true</audioSend>" );
						echo( "<videoSend>true</videoSend>" );
						echo( "<audioReceive>true</audioReceive>" );
						echo( "<videoReceive>true</videoReceive>" );
						echo( "<kissSmackEnabled>". (get_wm_configuration('kissSmackEnabled', 1) == 0 ? 'false' : 'true') . "</kissSmackEnabled>" );					
						echo( "<showerrors>". (get_wm_configuration('showerrors', 1) == 0 ? 'false' : 'true') . "</showerrors>" );
						echo( "<sound>". (get_wm_configuration('sound', 1) == 0 ? 'false' : 'true') . "</sound>" );
						echo( "<focus>". (get_wm_configuration('focus', 1) == 0 ? 'false' : 'true') . "</focus>" );
						echo( "<autoOpenAV>". (get_wm_configuration('autoOpenAV', 0) == 0 ? 'false' : 'true') . "</autoOpenAV>" );
						echo( "<autoStartAudio>". (get_wm_configuration('autoStartAudio', 0) == 0 ? 'false' : 'true') . "</autoStartAudio>" );
						echo( "<autoStartVideo>". (get_wm_configuration('autoStartVideo', 0) == 0 ? 'false' : 'true') . "</autoStartVideo>" );
						echo( "<backgroundColor>" . get_wm_configuration('backgroundColor', '') . "</backgroundColor>" );
						echo( "<fontColor>" . get_wm_configuration('fontColor', '') . "</fontColor>" );
						echo( "<quickMessageList ignoreNoTextEntry='false'>" );
						require_once 'upl_wm_quick_messages.php';
						$quickMessageList = upl_wm_quick_messages::get_quick_messages();
						foreach ($quickMessageList as $quickMessage) {
							echo( "<message>" );
								echo( "<title>" . $quickMessage->title . "</title>" );
								echo( "<body>" . $quickMessage->body . "</body>" );			
							echo( "</message>" );
						} 
						echo( "</quickMessageList>" );
						echo( "<noTextEntry>". (get_wm_configuration('noTextEntry', 0) == 0 ? 'false' : 'true') . "</noTextEntry>" );
						echo( "<sessionTimeout>" . get_wm_configuration('sessionTimeout', -1) . "</sessionTimeout>" );
						echo( "<sessionTimeoutMessage>" . get_wm_configuration('sessionTimeoutMessage', 'Your session has timed out.') . "</sessionTimeoutMessage>" );
					echo( "</member>" );
				}
				$targetMember = upl_common_user::get_user_with_user_id($strTargetUserID);
				if($targetMember == null) {
					echo( "<targetMember>INVALID</targetMember>" );
				} else {				
					echo( "<targetMember>" );
					$sexs = array('', 'male', 'female');
						echo( "<displayname>" . $targetMember->display_name . "</displayname>" );
						echo "<line1>". ($targetMember->sex == '' ? '' : $sexs[$targetMember->sex])."</line1>";
						echo "<line2>".$targetMember->location."</line2>";
						echo "<line3>" . upl_common_user::get_birthday($targetMember) . "</line3>";
						echo "<line4/>";
						
						echo( upl_common_user::get_user_chat_icon($targetMember->ID, "imagepath") );
						echo( "<avEnabled>" . (get_wm_configuration("avenabled", 1) == 0 ? "false" : "true") . "</avEnabled>" );
						echo( "<blocked>" . (upl_common_user::is_user_blocked($strUserID, $strTargetUserID) ? 'true' : 'false') . "</blocked>" );
						echo( "<backgroundColor>" . get_wm_configuration('backgroundColor', '') . "</backgroundColor>" );
						echo( "<fontColor>" . get_wm_configuration('fontColor', '') . "</fontColor>" );
					echo( "</targetMember>" );
				}
			}
		}
		else if( $strFunction == "addFriend" ) {
			if( $strUserID != null && $strUserID != "" && $strTargetUserID != null && $strTargetUserID != "" ) {
				require_once '../upl_common/upl_common_init_engine.php';
				require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
				upl_common_user::add_buddy($strUserID, $strTargetUserID);
			}
		}
		else if( $strFunction == "sendConnectionList" ) {
			$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;
			if( $strXmlData != null ) {
				/*
				EXAMPLE:
			
				<?xml version='1.0' encoding='iso-8859-1'?>
					<connectionList>
					<server>flashcom.yourserver.userplane.com</server>
					<c><f type="m">21</f><t>1</t></c>
					<c><f type="m">1</f><t>8</t></c>
					<c><f type="s">a6d5fe44</f><t>1</t></c>
					<c><f type="m">1</f><t>21</t></c>
				</connectionList>
				*/
			
				// update your database and no need to return anything
			}
		}
		else if( $strFunction == "setBlockedStatus" ) {
			if( $strUserID != null && $strUserID != "" && $strTargetUserID != null && $strTargetUserID != "" ) {
				$bBlocked = isset($_GET['trueFalse']) ? $_GET['trueFalse'] : null;
				$bBlocked = $bBlocked == "true" || $bBlocked == "1";
				require_once '../upl_common/upl_common_init_engine.php';
				require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
				if( $bBlocked )	{
					upl_common_user::add_blocked($strUserID, $strTargetUserID);
				}
				else {
					upl_common_user::remove_blocked($strUserID, $strTargetUserID);
				}
			}
		}
		else if( $strFunction == "startConversation" ) {
			if( $strUserID != null && $strUserID != "" && $strTargetUserID != null && $strTargetUserID != "" ) {
				// check to see if there is already a request to open a window in the db
				{
					// if not, insert a request to have a window opened up on the target user's machine
				}
			}
		}
		else if( $strFunction == "notifyConnectionClosed" )	{
			if( $strUserID != null && $strUserID != "" && $strTargetUserID != null && $strTargetUserID != "" ) {
				// since the orginating user is closing their window, don't open a window on the target user anymore
				
				
				// in addition, you can also use the strXmlData variable to get any messages that were never delivered to the targetUser.
				$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;	
			}
		}
		else if( $strFunction == "sendPendingMessages" ) {
			if( $strUserID != null && $strUserID != "" && $strTargetUserID != null && $strTargetUserID != "" ) {				
				// you can use the strXmlData variable to get any messages that were never delivered to the targetUser.
				$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;	
			}
		}
		else if( $strFunction == "sendArchive" ) {
			$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;
		}			
	}
	
	echo( "</icappserverxml>" );
?>
