<?php
	header( "Content-Type: text/xml; charset=utf-8" );

	echo( "<?xml version='1.0' encoding='utf-8'?>" );
	echo( "<!-- COPYRIGHT Userplane 2004 (http://www.userplane.com) -->" );
	echo( "<!-- CS version 1.9.4 -->" );
	echo( "<communicationsuite>" );

	echo( "<time>" . date("F d, Y h:i:s A") . "</time>" );

	$strDomainID = isset($_GET['domainID']) ? $_GET['domainID'] : null;
	$strFunction = isset($_GET['function']) ? $_GET['function'] : (isset($_GET['action']) ? $_GET['action'] : null);
	$strCallID = isset($_GET['callID']) ? $_GET['callID'] : null;

	function get_chat_configuration($name, $default) {
		global $configuration;
		$name = strtolower($name);
		$name = 'wc_' . $name;
		if(key_exists($name, $configuration)) {
			return $configuration[$name];
		} else {
			return $default;
		}
	}
	
	if( $strFunction != null && $strDomainID != null )
	{
		$strSessionGUID = isset($_GET['sessionGUID']) ? $_GET['sessionGUID'] : null;
		$strKey = isset($_GET['key']) ? $_GET['key'] : null;
		$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
		$strRoomName = isset($_GET['roomName']) ? $_GET['roomName'] : null;
		$strBlockedUserID = isset($_GET['blockedUserID']) ? $_GET['blockedUserID'] : null;
		$strFriendUserID = isset($_GET['friendUserID']) ? $_GET['friendUserID'] : null;
		$bConnected = isset($_GET['connected']) ? $_GET['connected'] : null;
		$bConnected = $bConnected == "true" || $bConnected == "1";
		$bAdmin = isset($_GET['admin']) ? $_GET['admin'] : null;
		$bAdmin = $bAdmin == "true" || $bAdmin == "1";
		$bExists = isset($_GET['exists']) ? $_GET['exists'] : null;
		$bExists = $bExists == "true" || $bExists == "1";
		$bInRoom = isset($_GET['inRoom']) ? $_GET['inRoom'] : null;
		$bInRoom = $bInRoom == "true" || $bInRoom == "1";
		$bBlocked = isset($_GET['blocked']) ? $_GET['blocked'] : null;
		$bBlocked = $bBlocked == "true" || $bBlocked == "1";
		$bBanned = isset($_GET['banned']) ? $_GET['banned'] : null;
		$bBanned = $bBanned == "true" || $bBanned == "1";
		$bFriend = isset($_GET['friend']) ? $_GET['friend'] : null;
		$bFriend = $bFriend == "true" || $bFriend == "1";


		switch( $strFunction )
		{
			case "getDomainPreferences":

				require_once '../upl_common/upl_common_init_engine.php';
				require_once 'upl_wc_config.php';
				global $configuration;
				$configuration = upl_wc_config::get_chat_configuration();

				$bStartup = isset($_GET['startup']) ? $_GET['startup'] : null;
				$bStartup = $bStartup == "true" || $bStartup == "1";

				echo( "<domain>" );
					echo( "<maxxmlretries>" . get_chat_configuration("maxxmlretries", 5) . "</maxxmlretries>" );
					echo( "<avenabled>" . (get_chat_configuration("avenabled", 0) == 0 ? "false" : "true") . "</avenabled>" );
					echo( "<forbiddenwordslist>" . get_chat_configuration("forbiddenwordslist", "crap,shit") . "</forbiddenwordslist>" );
					echo( "<allowCalls>setBannedStatus,setBlockedStatus,setFriendStatus,onRoomStatusChange,onUserRoomChange,onUserConnectionChange,getAnnouncements</allowCalls>" );
					echo( "<textColors>000000,3D3D3D,7F7F7F,C4C4C4,EE0000,EE3B3B,EEB4B4,FF2400,D43D1A,EE4000,
					FF6103,5C3317,97694F,FFB90F,FFCC11,FFFF00,3B5323,008B00,458B00,66CD00,7CFC00,00FF00,00FF66,
					2E8B57,00C78C,0FDDAF,20B2AA,00FFFF,0099CC,00688B,104E8B,003EFF,0000FF,120A8F,9F79EE,6600FF,
					380474,2E0854,CC00FF,9932CC,EE00EE,FF00AA,551033,FF69B4,FF030D,551011,FF0000,FFFFFF,8B8989,
					FF5333,FF3300,CD7054,5E2612,EE4000,292421,6B4226,777733,CCCC00,C0FF3E,912CEE,5C246E,EE00EE,
					584E56,DC143C,D0A9AA,83F52C,BCED91,33FF33,00FF66,213D30,90FEFB,3299CC,003F87,3579DC,0147FA,
					191970,EE00EE,FF1493,F0F8FF,FAEBD7,00FFFF,7FFFD4,F0FFFF,F5F5DC,FFE4C4,000000,FFEBCD,0000FF,
					8A2BE2,A52A2A,DEB887,5F9EA0,7FFF00,D2691E,FF7F50,6495ED,FFF8DC,DC143C,00FFFF,00008B,008B8B,
					B8860B,A9A9A9,006400,BDB76B,8B008B,556B2F,FF8C00,9932CC,8B0000,E9967A,8FBC8F,483D8B,2F4F4F,
					00CED1,9400D3,FF1493,00BFFF,696969,1E90FF,B22222,FFFAF0,228B22,FF00FF,DCDCDC,F8F8FF,FFD700,
					DAA520,808080,008000,ADFF2F,F0FFF0,FF69B4,CD5C5C,4B0082,FFFFF0,F0E68C,E6E6FA,FFF0F5,7CFC00,
					FFFACD,ADD8E6,F08080,E0FFFF,FAFAD2,D3D3D3,90EE90,FFB6C1,FFA07A,20B2AA,87CEFA,778899,B0C4DE,
					FFFFE0,00FF00,32CD32,FAF0E6,FF00FF,800000,66CDAA,0000CD,BA55D3,9370D8,3CB371,7B68EE,00FA9A,
					48D1CC,C71585,191970,F5FFFA,FFE4E1,FFE4B5,FFDEAD,000080,FDF5E6,808000,6B8E23,FFA500,FF4500,
					DA70D6,EEE8AA,98FB98,AFEEEE,D87093,FFEFD5,FFDAB9,CD853F,FFC0CB,DDA0DD,B0E0E6,800080,FF0000,
					BC8F8F,4169E1,8B4513,FA8072,F4A460,2E8B57,FFF5EE,A0522D,C0C0C0,87CEEB,6A5ACD,708090,FFFAFA,
					00FF7F,4682B4,D2B48C,008080,D8BFD8,FF6347,40E0D0,EE82EE,F5DEB3,FFFFFF,F5F5F5,FFFF00,9ACD32,
					</textColors>" );
					
					echo( "<smileys>" );
					echo( "<smiley>" );
							echo( "<name>Love</name>" );
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/heart.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/cock.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/hb.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/canada.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/wb.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/wtf.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/lightning.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/boobs.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/chav.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/finger.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/kissass.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/mooning.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/urgay.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/yousuck.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/thong.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/hotdog.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/sexy.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/lips.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/british.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/alien.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/burger.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/jukebox.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/no-smoking.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/stop.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/usa.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/rose.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/sunny.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/@.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/beer.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/biohazard.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/disabled.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/radioactive.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/rain.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/snow.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/brb.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/coffee.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/england.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/eye.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/geek.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/gun.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/monster.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/phone.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/pizza.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/questionmark.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/sleep.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/teeth.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/wtf.jpg</image>" );
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
							echo( "<image>http://www.peeps-chat.com/wp-content/plugins/upl_wc/smileys/lies.jpg</image>" );
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
					echo( "<chat>" );
						echo( "<allowModeratedRooms>" . (get_chat_configuration("allowmoderatedrooms", 0) == 0 ? "false" : "true") . "</allowModeratedRooms>" );
						echo( "<floodControlResetTime>" . get_chat_configuration("floodcontrolresetTime", 5) . "</floodControlResetTime>" );
						echo( "<floodControlInterval>" . get_chat_configuration("floodControlInterval", 5) . "</floodControlInterval>" );
						echo( "<floodControlMaxMessages>" . get_chat_configuration("floodControlMaxMessages", 10) . "</floodControlMaxMessages>" );
						echo( "<labels>" );
							
							$lobby = upl_wc_config::get_lobby();
							if($lobby != null) {
								echo( "<lobby><name>" . $lobby['name'] . "</name><description>" . $lobby['description'] . "</description></lobby>" );
							}
						echo( "</labels>" );
						echo( "<maxroomusers>" . get_chat_configuration("maxroomusers", 20) . "</maxroomusers>" );
						echo( "<maxdockitems>" . get_chat_configuration("maxdockitems", 0) . "</maxdockitems>" );
						echo( "<characterlimit>" . get_chat_configuration("characterlimit", 200) . "</characterlimit>" );
						echo( "<userroomcreate>" . (get_chat_configuration("userroomcreate", 1) == 0 ? "false" : "true") . "</userroomcreate>" );
						echo( "<roomemptytimeout>" . get_chat_configuration("roomemptytimeout", 600) . "</roomemptytimeout>" );
						echo( "<maxhistorymessages>" . get_chat_configuration("maxhistorymessages", 20) . "</maxhistorymessages>" );
						echo( "<showJoinLeaveMessages>" . (get_chat_configuration("showJoinLeaveMessages", 1) == 0 ? "false" : "true") . "</showJoinLeaveMessages>" );
						echo( "<gui>" );
							echo( "<viewprofile>" . (get_chat_configuration("viewprofile", 1) == 0 ? "false" : "true") . "</viewprofile>" );
							
							echo( "<addfriend>" . (get_chat_configuration("addfriend", 1) == 0 ? "false" : "true") . "</addfriend>" );
							echo( "<block>" . (get_chat_configuration("block", 1) == 0 ? "false" : "true") . "</block>" );
							echo( "<titleBarColor>" . get_chat_configuration("titleBarColor", '') . "</titleBarColor>" );
							echo( "<scrollTrackColor>" . get_chat_configuration("scrollTrackColor", '') . "</scrollTrackColor>" );
							echo( "<outerBackgroundColor>" . get_chat_configuration("outerBackgroundColor", '') . "</outerBackgroundColor>" );
							echo( "<innerBackgroundColor>" . get_chat_configuration("innerBackgroundColor", '') . "</innerBackgroundColor>" );
							echo( "<uiFontColor>" . get_chat_configuration("uiFontColor", '') . "</uiFontColor>" );
							echo( "<buttonColor>" . get_chat_configuration("buttonColor", '') . "</buttonColor>" );
							echo( "<leftPaneMinimized>" . (get_chat_configuration("leftPaneMinimized", 0) == 0 ? "false" : "true") . "</leftPaneMinimized>" );
							echo( "<dockMinimized>" . (get_chat_configuration("dockMinimized", 0) == 0 ? "false" : "true") . "</dockMinimized>" );
							echo( "<images>" );
								echo( "<watermark>" . get_chat_configuration("watermark", 'http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg') . "</watermark>" );
							echo( "</images>" );
							echo( "<initialinputlines>" . get_chat_configuration("initialinputlines", '1') . "</initialinputlines>" );
							echo( "<help>" . (get_chat_configuration("help", 0) == 0 ? "false" : "true") . "</help>" );
						echo( "</gui>" );
						echo( "<roomlist>" );
							require_once 'upl_wc_rooms.php';
							$rooms = upl_wc_rooms::get_chat_rooms();
							foreach ($rooms as $room) {
								echo '<room><name>'. $room->name . "</name><description>". $room->description . "</description></room>";
							} 
						echo( "</roomlist>" );
						echo( "<getannouncementsinterval>" . get_chat_configuration("getannouncementsinterval", '-1') . "</getannouncementsinterval>" );
						echo( "<sendarchive>" . (get_chat_configuration("sendarchive", 0) == 0 ? "false" : "true") . "</sendarchive>" );
						echo( "<banOptions>" );
							echo( "<message>" . get_chat_configuration("banOptionsmessage", 'How long would you like to ban this user?') . "</message>" );
							echo( "<list>" );
								echo( "<option>" . get_chat_configuration("banOptions1", 'One Hour') . "</option>" );
								echo( "<option>" . get_chat_configuration("banOptions2", 'One Day') . "</option>" );
								echo( "<option>" . get_chat_configuration("banOptions3", 'One Week') . "</option>" );
								echo( "<option>" . get_chat_configuration("banOptions4", 'One Month') . "</option>" );
								echo( "<option>" . get_chat_configuration("banOptions5", 'Forever') . "</option>" );
							echo( "</list>" );
						echo( "</banOptions>" );
						echo( "<banNotification><![CDATA[" . get_chat_configuration("banNotification", '<b>[[NAME]] was banned</b>') . "]]></banNotification>" );
						echo( "<sendConnectionListInterval>" . get_chat_configuration("sendConnectionListInterval", '-1') . "</sendConnectionListInterval>" );
						echo( "<conferenceCallEnabled>" . get_chat_configuration("conferenceCallEnabled", '-1') . "</conferenceCallEnabled>" );
						echo( "<conferenceCallText>" . get_chat_configuration("conferenceCallText", 'Call the party line: ') . "</conferenceCallText>" );
					echo( "</chat>" );
				echo( "</domain>" );
				break;

			case "getUser":
				if( $strSessionGUID != null || $strUserID != null )
				{
					require_once '../upl_common/upl_common_init_engine.php';
					require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
					require_once 'upl_wc_users.php';
//					if (substr($strSessionGUID, 0, 9) == "minichat_" && $_GET['app'] == 'minichat') {
//						$strSessionGUID = substr($strSessionGUID, 9, strlen($strSessionGUID) - 9);
//					}
					if( $strUserID == null || strlen(trim($strUserID)) == 0 ) {
						$strUserID = upl_common_user::get_user_by_session_id($strSessionGUID);
					}
					$is_guest = (substr($strSessionGUID, 0, 6) == "Guest_" && $_GET['app'] == 'minichat');
					if ($is_guest) {
						echo( "<user>" );
							echo( "<userid>minichat_$strSessionGUID</userid>" );
							echo( "<admin>false</admin>" );
							echo( "<speaker>false</speaker>" );
							echo( "<displayname>$strSessionGUID</displayname>" );
						echo( "<minichat>" );
							echo( "<useAnonymousScreenNames>". (get_chat_configuration('useAnonymousScreenNames', 0) == 0 ? "false" : "true") . "</useAnonymousScreenNames>" );
							echo( "<showUserCount>". (get_chat_configuration('showUserCount', 1) == 0 ? "false" : "true") . "</showUserCount>" );
							echo( "<showWatcherUserCount>". (get_chat_configuration('showWatcherUserCount', 1) == 0 ? "false" : "true") . "</showWatcherUserCount>" );
							echo( "<allowTextInput>true</allowTextInput>" );
							echo( "<allowRoomUserlist>". (get_chat_configuration('allowRoomUserlist', 0) == 0 ? "false" : "true") . "</allowRoomUserlist>" );
						echo( "</minichat>" );
						echo( "</user>" );

					} else if( $strUserID != null || strlen(trim($strUserID)) > 0 )	{
						$userData = upl_common_user::get_user_with_user_id($strUserID);
						if($userData == null || is_user_banned($strUserID) || !user_chat_access($strUserID, 1)) {
							echo( "<user>" );
							echo( "<userid>INVALID</userid>" );
							echo( "</user>" );
						} else {
							require_once 'upl_wc_config.php';
							global $configuration;
							$configuration = upl_wc_config::get_chat_configuration();
							$app = isset($_GET['app']) ? $_GET['app'] : '';
							$is_minichat = ($app == 'minichat');

						echo( "<user>" );
							echo( "<userid>" . ($is_minichat ? ('minichat_' . $strUserID) : $strUserID) . "</userid>" );
							$is_admin = (user_chat_access($strUserID, 2)) ? "true" : "false";
							echo( "<admin>" . $is_admin . "</admin>" );
							echo( "<speaker>false</speaker>" );
							echo( "<displayname>" . $userData->display_name . "</displayname>" );
							echo( "<avsettings>" );
								echo( "<audioSend>true</audioSend>" );
								echo( "<videoSend>true</videoSend>" );
								echo( "<audioReceive>true</audioReceive>" );
								echo( "<videoReceive>true</videoReceive>" );
								echo( "<audiokbps>".  get_chat_configuration('chat_audiokbps', 10) . "</audiokbps>" ); 		// acceptable values: 10,16,22,44,88
								echo( "<videokbps>". get_chat_configuration('chat_videokbps', 100) . "</videokbps>" );		// recommended range: 10 - 200
								echo( "<videofps>". get_chat_configuration('chat_videofps', 15) . "</videofps>" );			// acceptable range: 1 - 30
								echo( "<videosize>".  (get_chat_configuration('chat_videosize', 1)) . "</videosize>" );			// acceptable values: 1, 2, 3
								echo( "<videoDisplaySize>". get_chat_configuration('chat_videoDisplaySize', 2) . "</videoDisplaySize>" );
							echo( "</avsettings>" );
							echo( "<buddylist>" );
								$buddies = get_buddies($strUserID);
								foreach($buddies as $buddy) {
									echo( "<user>" );
										echo( "<userid>". $buddy->ID . "</userid>" );
										echo( "<displayname>". $buddy->display_name . "</displayname>" );
										echo( "<images>" );
											echo(upl_common_user::get_user_chat_icon($buddy->ID, "icon"));
											echo(upl_common_user::get_user_chat_icon($buddy->ID, "thumbnail"));
											echo(upl_common_user::get_user_chat_icon($buddy->ID, "fullsize"));
										echo( "</images>" );
									echo( "</user>" );
								}
							echo( "</buddylist>" );
							echo( "<blocklist>" );
								$blocked = get_blocked($strUserID);
								foreach($blocked as $block) {
									echo( "<userid>" . $block->blocked_uid . "</userid>" );
								}
							echo( "</blocklist>" );
							echo( "<images>" );
								echo(upl_common_user::get_user_chat_icon($userData->ID, "icon"));
								echo(upl_common_user::get_user_chat_icon($userData->ID, "thumbnail"));
								echo(upl_common_user::get_user_chat_icon($userData->ID, "fullsize"));
							echo( "</images>" );
							echo( "<chat>" );
								echo( "<userdatavalues>" );
									$sexs = array('', 'male', 'female');
									echo "<line>" . $userData->location . "</line>";
									echo "<line>" . ($userData->sex == '' ? '' : $sexs[$userData->sex]) . "</line>";
									echo "<line>" . upl_common_user::get_birthday($userData) . "</line>";
								echo( "</userdatavalues>" );
								echo( "<gui>" );
									echo( "<viewprofile>". (get_chat_configuration('viewprofile', 1) == 0 ? "false" : "true") . "</viewprofile>" );
																		
								echo( "</gui>" );
								echo( "<notextentry>false</notextentry>" );
								echo( "<invisible>");
								echo( user_chat_access($strUserID, 3) ? "true" : "false");
								echo( "</invisible>" );
								echo( "<userroomcreate>". (get_chat_configuration('userroomcreate', 0) == 0 ? "false" : "true") . "</userroomcreate>" );

									echo( "<adminrooms>" );
									$rooms = get_admin_rooms($strUserID);
									foreach($rooms as $row) {
										echo( "<room createOnLogin='false'><name>". $row->name . "</name><description>". $row->description . "</description></room>" );
									}
									echo( "</adminrooms>" );

								$restrictedRooms = get_restricted_rooms($strUserID, 0);
								$open = false;
								if($restrictedRooms) {
									foreach($restrictedRooms as $restrictedRoom) {
										if(!$open) {
											echo( "<restrictedRooms allowRestricted='false'>" );
											$open = true;
										}
										echo( "<room createOnLogin='true' creatorID='" . $restrictedRoom->creator_id . "'><name>" . $restrictedRoom->name . "</name><description>" . $restrictedRoom->description . "</description></room>" );
									}
									if($open) {
										echo( "</restrictedRooms>" );
									}
								}
								$open = false;
								$restrictedRooms = get_restricted_rooms($strUserID, 1);
								if($restrictedRooms) {
									foreach($restrictedRooms as $restrictedRoom) {
										if(!$open) {
											echo( "<restrictedRooms allowRestricted='true'>" );
											$open = true;
										}
										echo( "<room createOnLogin='true' creatorID='" . $restrictedRoom->creator_id . "'><name>" . $restrictedRoom->name . "</name><description>" . $restrictedRoom->description . "</description></room>" );
									}
									if($open) {
										echo( "</restrictedRooms>" );
									}
								}

								if($userData != null && $userData->last_room != null) {
									echo( "<initialroom createOnLogin='false'>" . $userData->last_room . "</initialroom>" );
								}
								echo( "<maxdockitems>" . get_chat_configuration('maxdockitems', 1) . "</maxdockitems>" );
								echo( "<permitCopy>". (get_chat_configuration('chat_permitCopy', 1) == 0 ? "false" : "true") . "</permitCopy>" );
								echo( "<sessionTimeout>" . get_chat_configuration("sessionTimeout", -1) . "</sessionTimeout>" );
								echo( "<sessionTimeoutMessage>" . get_chat_configuration("sessionTimeoutMessage", 'Your session has expired.') . "</sessionTimeoutMessage>" );
								echo( "<selecteduser>$strUserID</selecteduser>" );
								echo( "<inactivityTimeout>" . get_chat_configuration("inactivityTimeout", 10) . "</inactivityTimeout>" );
								echo( "<inactivityTimeoutMessage>" . get_chat_configuration("inactivityTimeoutMessage", 'You were timed out due to inactivity.') . "</inactivityTimeoutMessage>" );
								echo( "<permitWhisper>". (get_chat_configuration('chat_permitWhisper', 1) == 0 ? "false" : "true") . "</permitWhisper>" );
							echo( "</chat>" );
							echo( "<userlist>" );
								echo( "<gui>" );
									$miniprofile = get_chat_configuration('chat_miniprofile', 1);
									$onlineusers = get_chat_configuration('chat_onlineusers', 1);
									$buddylist = get_chat_configuration('chat_buddylist', 1);
									$moduleList = $miniprofile ? "miniprofile" : "";
									$moduleList = $moduleList . ($onlineusers ? ($miniprofile ? ",onlineusers" : "onlineusers") : "");
									$moduleList = $moduleList . ($buddylist ? ($miniprofile || $onlineusers ? ",buddylist" : "buddylist") : "");
									echo( "<modulelist>$moduleList</modulelist>" );
									echo( "<viewprofile>". (get_chat_configuration('viewprofile', 1) == 0 ? "false" : "true") . "</viewprofile>" );
									echo( "<instantcommunicator>" . (get_chat_configuration("instantcommunicator", 1) == 0 ? "false" : "true") . "</instantcommunicator>" );
									echo( "<addfriend>". (get_chat_configuration('addfriend', 1) == 0 ? "false" : "true") . "</addfriend>" );
									echo( "<search>true</search>" );
								echo( "</gui>" );
								echo( "<buddyviewableonly>". (get_chat_configuration('chat_buddyviewableonly', 0) == 0 ? "false" : "true") . "</buddyviewableonly>" );
							echo( "</userlist>" );
							echo( "<minichat>" );
								echo( "<useAnonymousScreenNames>". (get_chat_configuration('useAnonymousScreenNames', 0) == 0 ? "false" : "true") . "</useAnonymousScreenNames>" );
								echo( "<showUserCount>". (get_chat_configuration('showUserCount', 1) == 0 ? "false" : "true") . "</showUserCount>" );
								echo( "<showWatcherUserCount>". (get_chat_configuration('showWatcherUserCount', 1) == 0 ? "false" : "true") . "</showWatcherUserCount>" );
								echo( "<allowTextInput>false</allowTextInput>" );
								echo( "<allowRoomUserlist>". (get_chat_configuration('allowRoomUserlist', 0) == 0 ? "false" : "true") . "</allowRoomUserlist>" );
							echo( "</minichat>" );
						echo( "</user>" );

						}
					}
					else
					{
						echo( "<user>" );
							echo( "<userid>INVALID</userid>" );
						echo( "</user>" );
					}
				}
				break;

			case "onRoomStatusChange":
				if( $strRoomName != null ) {
					require_once '../upl_common/upl_common_init_engine.php';
					require_once 'upl_wc_users.php';

					$owner = isset($_GET['ownerID']) ? $_GET['ownerID'] : null;
					if( $bExists && $owner ) {
						add_chat_room($strRoomName, "Chat room", $owner);
					}
					else {
						remove_chat_room($strRoomName);
					}
					// bAdmin is also available (see docs)
				}
				break;

			case "onUserConnectionChange":
				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( $strUserID != null ) {
					// $bConnected is whether they are currently connected
					if( $bConnected ) {
					}
					else {
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "onUserRoomChange":
				if( $strRoomName != null && $strUserID != null ) {
					require_once '../upl_common/upl_common_init_engine.php';
					require_once 'upl_wc_users.php';

					if( $bInRoom ) {
						set_user_last_room($strUserID, $strRoomName);
					}
					else {
//						set_user_last_room($strUserID, "");
					}
				}
				break;

			case "setBannedStatus":
				$strInfo = isset($_GET['info']) ? $_GET['info'] : null;
				if( $strUserID != null ) {
					require_once '../upl_common/upl_common_init_engine.php';
					require_once 'upl_wc_users.php';
					require_once 'upl_wc_config.php';
					$configuration = upl_wc_config::get_chat_configuration();

					if( $bBanned ) {
						//if( $strInfo != null && $strInfo != "" ) {
						ban_user($strUserID, time(), date_add($strInfo, 1, time()));
						//}
					}
					else {
						unban_user($strUserID);
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "setBlockedStatus":
				if( $strUserID != null && $strBlockedUserID != null ) {
					require_once '../upl_common/upl_common_init_engine.php';
					require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');

					$strUserID = str_replace('minichat_', '', $strUserID);
					if( $bBlocked )	{
						upl_common_user::add_blocked($strUserID, $strBlockedUserID);
					}
					else {
						upl_common_user::remove_blocked($strUserID, $strBlockedUserID);
					}
				}
				break;

			case "setFriendStatus":
				if( $strUserID != null && $strFriendUserID != null ) {
					require_once '../upl_common/upl_common_init_engine.php';
					require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');

					if( $bFriend ) {
						upl_common_user::add_buddy($strUserID, $strFriendUserID);
					}
					else {
						upl_common_user::remove_buddy($strUserID, $strFriendUserID);
					}
				}
				break;

			case "getAnnouncements":
				require_once '../upl_common/upl_common_init_engine.php';
				require_once 'upl_wc_config.php';
				$configuration = upl_wc_config::get_chat_configuration();
				$announcements = get_chat_configuration("announcements", '');
				$announcementList = split("\r\n", $announcements);
				echo( "<announcementList>" );
				while(list($i, $announcement) = each($announcementList)) {
					if($announcement != '') {
						echo( "<announcement><![CDATA[$announcement]]></announcement>" );
					}
				}
				echo( "</announcementList>" );
				break;

			case "sendArchive":
				// This function is not on by default, use sendArchive in getDomainPreferences to turn it on
				$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;
				/*
				//the incoming POST xmlData will look like this:
				<?xml version='1.0' encoding='iso-8859-1'?>
				<messageArchive>
					<room>
						<name><![CDATA[asfd]]></name>
						<messages>
							<entry type="announcement">
								<timestamp>1126551016075</timestamp>
								<displayName><![CDATA[]]></displayName>
							</entry>
							<entry type="leave">
								<timestamp>1126551110781</timestamp>
								<displayName><![CDATA[tom]]></displayName>
								<userID invisible="false">1</userID>
							</entry>
							<entry type="join">
								<timestamp>1126551112343</timestamp>
								<displayName><![CDATA[tom]]></displayName>
								<userID invisible="false">1</userID>
							</entry>
							<entry type="msg">
								<timestamp>1126551127685</timestamp>
								<displayName><![CDATA[tom]]></displayName>
								<userID invisible="false">1</userID>
								<content><![CDATA[this is my message]]></content>
							</entry>
						</messages>
					</room>
				</messageArchive>
				*/
				break;

			case "sendConnectionList":
				// This function is not on by default, use sendConnectionListInterval in getDomainPreferences to turn it on
				$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;
				/*
				//the incoming POST xmlData will look like this:
				<?xml version='1.0' encoding='iso-8859-1'?>
				<rooms>
					<room>
						<name><![CDATA[Lobby]]></name>
						<users>
							<user id="1"/>
							<user id="2"/>
							<user id="3"/>
						</users>
					</room>
					<room>
						<name><![CDATA[My Empty Room]]></name>
						<users></users>
					</room>
				</rooms>
				*/
				break;

			default:
				break;
		}
	}

	echo( "</communicationsuite>" );
?>
