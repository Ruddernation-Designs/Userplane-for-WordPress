<?php
	header( "Content-Type: text/xml; charset=utf-8" );

	echo( "<?xml version='1.0' encoding='utf-8'?>" );
	echo( "<!-- COPYRIGHT Userplane 2004 (http://www.userplane.com) -->" );
	echo( "<!-- CS version 2.1.0 -->" );
	echo( "<communicationsuite>" );

	echo( "<time>" . date("F d, Y h:i:s A") . "</time>" );

	$strFunction = isset($_GET['function']) ? $_GET['function'] : (isset($_GET['action']) ? $_GET['action'] : null);
	$strDomainID = isset($_GET['domainID']) ? $_GET['domainID'] : null;
	$strInstanceID = isset($_GET['instanceID']) ? $_GET['instanceID'] : null;
	$strCallID = isset($_GET['callID']) ? $_GET['callID'] : null;

	if( $strFunction != null && $strDomainID != null )
	{
		switch( $strFunction )
		{
			case "getDomainPreferences":
				$bStartup = isset($_GET['startup']) ? $_GET['startup'] : null;
				$bStartup = $bStartup == "true" || $bStartup == "1";

				echo( "<domain>" );
					echo( "<common>" );
						echo( "<maxxmlretries>5</maxxmlretries>" );
						echo( "<avenabled>false</avenabled>" );
						echo( "<forbiddenwordslist>crap,shit</forbiddenwordslist>" );
						echo( "<allowCalls>setBannedStatus,setBlockedStatus,setFriendStatus</allowCalls>" );
						echo( "<domainPrefReloadInterval>-1</domainPrefReloadInterval>" );
						echo( "<maxUsers includeAdmins=\"false\" includeSpeakers=\"false\">-1</maxUsers>" );
						echo( "<domainInvalid>false</domainInvalid>" );
						echo( "<adminsRequired>false</adminsRequired>" );
						echo( "<textColors>000000,ff0000,f0037f,4c004a,000275,26429b,00a0c6,005100,6dc000,ff3f00,ff8600,542c06,905b34,787878,7ea5ba</textColors>" );
						echo( "<smileys>" );
							echo( "<smiley>" );
								echo( "<name>Ultra Angry</name>" );
								echo( "<image>http://images.yourCompany.userplane.com/images/smiley/UltraAngry.jpg</image>" );
								echo( "<codes>" );
									echo( "<code><![CDATA[>>:O]]></code>" );
									echo( "<code><![CDATA[>>:-O]]></code>" );
								echo( "</codes>" );
							echo( "</smiley>" );
							echo( "<smiley>" );
								echo( "<name>Angry</name>" );
								echo( "<image>DELETE</image>" );
							echo( "</smiley>" );
						echo( "</smileys>" );
					echo( "</common>" );
					echo( "<chat>" );
						echo( "<allowModeratedRooms autoOn=\"false\">false</allowModeratedRooms>" );
						echo( "<floodControlResetTime>5</floodControlResetTime>" );
						echo( "<floodControlInterval>5</floodControlInterval>" );
						echo( "<floodControlMaxMessages>10</floodControlMaxMessages>" );
						echo( "<labels>" );
							echo( "<userdata initiallines=\"0\">" );
								echo( "<line>Age</line>" );
								echo( "<line>Sex</line>" );
								echo( "<line>Location</line>" );
							echo( "</userdata>" );
							echo( "<lobby><name>Waiting Room</name><description>Lobby Description</description></lobby>" );
						echo( "</labels>" );
						echo( "<maxroomusers>20</maxroomusers>" );
						// Allowing multiple dock items could result in bandwidth overage fees.
						// Please contact a userplane representative for details on overage rates and billing questions.
						// http://www.userplane.com/contact.cfm
						echo( "<maxdockitems>0</maxdockitems>" );
						echo( "<characterlimit>200</characterlimit>" );
						echo( "<userroomcreate>true</userroomcreate>" );
						echo( "<roomemptytimeout>600</roomemptytimeout>" );
						echo( "<maxhistorymessages>20</maxhistorymessages>" );
						echo( "<showJoinLeaveMessages>true</showJoinLeaveMessages>" );
						echo( "<gui>" );
							echo( "<viewprofile>true</viewprofile>" );
							echo( "<instantcommunicator>true</instantcommunicator>" );
							echo( "<addfriend>true</addfriend>" );
							echo( "<block>true</block>" );
							echo( "<reportabuse textLines=\"0\" avEnabled=\"false\" avWebAccessible=\"true\" avSeconds=\"30\" avUserID=\"\">false</reportabuse>" );
							echo( "<titleBarColor></titleBarColor>" );
							echo( "<scrollTrackColor></scrollTrackColor>" );
							echo( "<outerBackgroundColor></outerBackgroundColor>" );
							echo( "<innerBackgroundColor></innerBackgroundColor>" );
							echo( "<uiFontColor></uiFontColor>" );
							echo( "<buttonColor></buttonColor>" );
							echo( "<leftPaneMinimized>false</leftPaneMinimized>" );
							echo( "<dockMinimized>false</dockMinimized>" );
							echo( "<images>" );
								echo( "<watermark alpha=\"5\">http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg</watermark>" );
							echo( "</images>" );
							echo( "<initialinputlines>1</initialinputlines>" );
							echo( "<help>true</help>" );
						echo( "</gui>" );
						echo( "<roomlist>" );
							// Make as many as you want, these will always appear when the app reloads (even if deleted in the client)
							echo( "<room><name>Singles</name><description>Singles Description</description></room>" );
							echo( "<room><name>Lazy People</name><description>Lazy People Description</description></room>" );
							echo( "<room><name>Athletic People</name><description>Athletic People Description</description></room>" );
						echo( "</roomlist>" );
						echo( "<getannouncementsinterval>-1</getannouncementsinterval>" );
						echo( "<sendarchive>false</sendarchive>" );
						echo( "<banNotification><![CDATA[<b>[[NAME]] was banned</b>]]></banNotification>" );
						echo( "<sendConnectionListInterval>-1</sendConnectionListInterval>" );
						echo( "<conferenceCallEnabled>-1</conferenceCallEnabled>" );
						echo( "<conferenceCallText>Call the party line: </conferenceCallText>" );
					echo( "</chat>" );
					echo( "<video>" );
						echo( "<maxrecordseconds>30</maxrecordseconds>" );
						echo( "<autoApprove>false</autoApprove>" );
						echo( "<sendVideoFileListInterval>0</sendVideoFileListInterval>" );
						echo( "<noVideoImage></noVideoImage>" );
						echo( "<videoNotEnabledImage></videoNotEnabledImage>" );
					echo( "</video>" );
					echo( "<boards>" );
						echo( "<autoApprove>true</autoApprove>" );
						echo( "<reportAbuse>true</reportAbuse>" ); // if report abuse button is on / off
						echo( "<seo enabled=\"true\">" );
							echo( "<url></url>" );
							echo( "<keywords></keywords>" );
							echo( "<description></description>" );
						echo( "</seo>" );
						echo( "<ranks>" );
							echo( "<rank threshhold=\"0\">" );
								echo( "<name>Grunt</name>" );
								echo( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							echo( "</rank>" );
							echo( "<rank threshhold=\"100\">" );
								echo( "<name>Private</name>" );
								echo( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							echo( "</rank>" );
							echo( "<rank threshhold=\"200\">" );
								echo( "<name>Sargeant</name>" );
								echo( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							echo( "</rank>" );
							echo( "<rank threshhold=\"300\">" );
								echo( "<name>General</name>" );
								echo( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							echo( "</rank>" );
						echo( "</ranks>" );
					echo( "</boards>" );
				echo( "</domain>" );
				break;

			case "getUser":
				$strSessionGUID = isset($_GET['sessionGUID']) ? $_GET['sessionGUID'] : null;
				$strKey = isset($_GET['key']) ? $_GET['key'] : null;
				$strUserIDList = isset($_GET['userIDList']) ? $_GET['userIDList'] : null;
				$strApp = isset($_GET['app']) ? $_GET['app'] : null;
				$strUrl = isset($_GET['url']) ? $_GET['url'] : null;
				$strIpAddress = isset($_GET['ip']) ? $_GET['ip'] : null;

				if( $strSessionGUID != null || $strUserIDList != null )
				{
					$userIDArray = array();
					if( $strUserIDList != null )
					{
						$userIDArray = array_unique(array_filter(explode(",", $strUserIDList), "strlen"));
					}

					// This first section is all about authenticating a sessionGUID that gets passed in
					$sessionGUIDsUserID = "INVALID";
					// Only validate the URL.sessionGUID if it is there, otherwise this could just be a data request for other users
					if( strlen(trim($strSessionGUID)) != 0 )
					{
						$bSessionGUIDIsValidSession = true; // You need to put something in here that sets this boolean accurately
						if( $bSessionGUIDIsValidSession )
						{
							$sessionGUIDsUserID = "639742"; // You need to lookup the userID that corresponds to the sessionGUID
							$userIDArray[] = $sessionGUIDsUserID;
						}
					}

					// Now that we have done any potential authentication work, loop through all the users whose data we have to look up
					for( $i = 0 ; $i < count($userIDArray) ; $i++ )
					{
						$currentUserId = $userIDArray[$i];
						if( strlen(trim($currentUserId)) != 0 )
						{
							// Need to look up data for the specified userID
							echo( "<user>" );
								echo( "<common>" );
									// If the currentUserID is one we authenticated above, return the sessionGUID too so we can accept/reject the connection
									if( $currentUserId == $sessionGUIDsUserID )
									{
										echo( "<sessionGUID>" . $strSessionGUID . "</sessionGUID>" );
									}
									echo( "<userid>" . $currentUserId . "</userid>" );
									echo( "<disconnectApps></disconnectApps>" );
									echo( "<admin>false</admin>" );
									echo( "<speaker>false</speaker>" );
									echo( "<displayname>Jack Jackson</displayname>" );
									echo( "<email>someuser@domain.com</email>" );
									echo( "<allowcommapiaccess>false</allowcommapiaccess>" );
									echo( "<aimscreenname enabled=\"false\" autoLogin=\"true\"></aimscreenname>" );
									echo( "<allowCustomStatusMessages>true</allowCustomStatusMessages>" );
									echo( "<avsettings>" );
										echo( "<avenabled>true</avenabled>" );
										echo( "<audioSend>true</audioSend>" );
										echo( "<videoSend>true</videoSend>" );
										echo( "<audioReceive>true</audioReceive>" );
										echo( "<videoReceive>true</videoReceive>" );
										echo( "<audiokbps>16</audiokbps>" ); 		// acceptable values: 10,16,22,44,88
										echo( "<videokbps>100</videokbps>" );		// recommended range: 10 - 200
										echo( "<videofps>15</videofps>" );			// acceptable range: 1 - 30
										echo( "<videosize>1</videosize>" );			// acceptable values: 1, 2, 3
										echo( "<videoDisplaySize>2</videoDisplaySize>" );
									echo( "</avsettings>" );
									echo( "<buddylist>" );
										echo( "<user>" );
											echo( "<userid>22222</userid>" );
											echo( "<displayname>joeschmoe</displayname>" );
											echo( "<images>" );
												echo( "<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>" );
												echo( "<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>" );
											echo( "</images>" );
										echo( "</user>" );
										echo( "<user>" );
											echo( "<userid>33333</userid>" );
											echo( "<displayname>johnjohnson</displayname>" );
											echo( "<images>" );
												echo( "<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>" );
												echo( "<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>" );
											echo( "</images>" );
										echo( "</user>" );
									echo( "</buddylist>" );
									echo( "<blocklist>" );
										echo( "<userid>45</userid>" );
										echo( "<userid>21</userid>" );
									echo( "</blocklist>" );
									echo( "<images>" );
										echo( "<icon>http://images.yourcompay.userplane.com/pathToIcon.jpg</icon>" );
										echo( "<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>" );
										echo( "<fullsize>http://images.yourcompany.userplane.com/pathToFullSize.jpg</fullsize>" );
									echo( "</images>" );
								echo( "</common>" );
								echo( "<chat>" );
									echo( "<userdatavalues>" );
										echo( "<line>Milpitas, CA</line>" );
										echo( "<line>Honda of Milpitas</line>" );
										echo( "<line>2003 CBR F4</line>" );
									echo( "</userdatavalues>" );
									echo( "<gui>" );
										echo( "<viewprofile>true</viewprofile>" );
										echo( "<instantcommunicator>true</instantcommunicator>" );
									echo( "</gui>" );
									echo( "<notextentry>false</notextentry>" );
									echo( "<invisible>false</invisible>" );
									echo( "<userroomcreate>true</userroomcreate>" );
									echo( "<adminrooms>" );
										echo( "<room createOnLogin='true'><name>Joe's Room</name><description>A rooom just for Joe</description></room>" );
										echo( "<room createOnLogin='false'><name>Singles</name><description>Singles Description</description></room>" );
										echo( "<room createOnLogin='false'><name>18-24</name></room>" );
									echo( "</adminrooms>" );
									echo( "<restrictedRooms allowRestricted='false'>" );
										echo( "<room createOnLogin='true' creatorID='4377'><name>Only Site Admins</name><description>Only Site admins can get into this room</description></room>" );
									echo( "</restrictedRooms>" );
									echo( "<initialroom createOnLogin='true'>Lazy People</initialroom>" );
									echo( "<maxdockitems>1</maxdockitems>" );
									echo( "<permitCopy>true</permitCopy>" );
									echo( "<sessionTimeout>-1</sessionTimeout>" );
									echo( "<sessionTimeoutMessage>Your session has expired.</sessionTimeoutMessage>" );
									echo( "<selecteduser>123</selecteduser>" );
									echo( "<inactivityTimeout>2</inactivityTimeout>" );
									echo( "<inactivityTimeoutMessage>You were timed out due to inactivity.</inactivityTimeoutMessage>" );
									echo( "<permitWhisper>true</permitWhisper>" );
									echo( "<banOptions>" );
										echo( "<message>How long would you like to ban this user?</message>" );
										echo( "<list>" );
											echo( "<option>One Hour</option>" );
											echo( "<option>One Day</option>" );
											echo( "<option>One Week</option>" );
											echo( "<option>One Month</option>" );
											echo( "<option>Forever</option>" );
										echo( "</list>" );
									echo( "</banOptions>" );
									echo( "<userConnectGreeting></userConnectGreeting>" );
								echo( "</chat>" );
								echo( "<userlist>" );
									echo( "<gui>" );
										echo( "<modulelist>miniprofile,onlineusers,buddylist</modulelist>" );
										echo( "<viewprofile>false</viewprofile>" );
										echo( "<instantcommunicator>false</instantcommunicator>" );
										echo( "<addfriend>true</addfriend>" );
										echo( "<search>true</search>" );
										echo( "<allowCustomStatusMessages>true</allowCustomStatusMessages>" );
									echo( "</gui>" );
									echo( "<buddyviewableonly>false</buddyviewableonly>" );
								echo( "</userlist>" );
								echo( "<minichat>" );
									echo( "<useAnonymousScreenNames>false</useAnonymousScreenNames>" );
									echo( "<showUserCount>true</showUserCount>" );
									echo( "<showWatcherUserCount>true</showWatcherUserCount>" );
									echo( "<allowTextInput>false</allowTextInput>" );
									echo( "<allowRoomUserlist>false</allowRoomUserlist>" );
								echo( "</minichat>" );
								echo( "<boards>" );
									echo( "<gui>" );
										echo( "<viewprofile>true</viewprofile>" );
										echo( "<webmessenger>true</webmessenger>" );
										echo( "<rate>true</rate>" ); // rate buttons on / off
										echo( "<embed>true</embed>" ); // embed button on / off
										echo( "<branch>true</branch>" ); // branch button on / off
										echo( "<search>true</search>" ); // search tab on / off
										echo( "<watch>true</watch>" ); // watched threads tab and watch button on / off
										echo( "<help>true</help>" ); // help button on / off
										echo( "<link>true</link>" ); // link buttons on / off
										echo( "<addfriend>true</addfriend>" );
										echo( "<latestPosts>5</latestPosts>" ); // number of posts to show in the modules on the home state
										echo( "<activeThreads>5</activeThreads>" ); // number of threads to show in the modules on the home state
										echo( "<connectGreeting>Welcome to Boards!</connectGreeting>" );
										echo( "<profileData>" );
											echo( "<line label=\"Age\">29</line>" );
											echo( "<line label=\"Sex\">M</line>" );
											echo( "<line label=\"Location\">Santa Monica</line>" );
										echo( "</profileData>" );
									echo( "</gui>" );
									echo( "<readOnly>false</readOnly>" );
									echo( "<adminForums>" );
										echo( "<forumID>2342</forumID>" );
										echo( "<forumID>765</forumID>" );
									echo( "</adminForums>" );
									echo( "<adminTopics>" );
										echo( "<topicID>323</topicID>" );
										echo( "<topicID>2451</topicID>" );
									echo( "</adminTopics>" );
									echo( "<restrictedForums allowRestricted=\"false\">" );
										echo( "<forumID>5665</forumID>" );
										echo( "<forumID>765</forumID>" );
										echo( "<forumID>54543</forumID>" );
									echo( "</restrictedForums>" );
									echo( "<timeouts>" );
										echo( "<session>-1</session>" );
										echo( "<sessionMessage>Your session has expired.</sessionMessage>" );
										echo( "<inactivity>2</inactivity>" );
										echo( "<inactivityMessage>You were timed out due to inactivity.</inactivityMessage>" );
									echo( "</timeouts>" );
								echo( "</boards>" );
							echo( "</user>" );
						}
					}
				}
				break;

			case "onRoomStatusChange":
				$strRoomName = isset($_GET['roomName']) ? $_GET['roomName'] : null;
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$bAdmin = isset($_GET['admin']) ? $_GET['admin'] : null;
				$bAdmin = $bAdmin == "true" || $bAdmin == "1";
				$bExists = isset($_GET['exists']) ? $_GET['exists'] : null;
				$bExists = $bExists == "true" || $bExists == "1";

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( $strRoomName != null && $strUserID != null )
				{
					// bExists is the true or false boolean that specifies whether the room exists or not
					// bAdmin is also available (see docs)
					if( $bExists )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "onUserConnectionChange":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$bConnected = isset($_GET['connected']) ? $_GET['connected'] : null;
				$bConnected = $bConnected == "true" || $bConnected == "1";

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( $strUserID != null )
				{
					// $bConnected is whether they are currently connected
					if( $bConnected )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "onUserRoomChange":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strRoomName = isset($_GET['roomName']) ? $_GET['roomName'] : null;
				$bInRoom = isset($_GET['inRoom']) ? $_GET['inRoom'] : null;
				$bInRoom = $bInRoom == "true" || $bInRoom == "1";

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( $strRoomName != null && $strUserID != null )
				{
					// bInRoom is the true or false boolean that specifies whether they are in the room
					if( $bInRoom )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "onLastUserDisconnect":
				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				// Handle this event, no need to return anything else
				break;

			case "setBannedStatus":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$bBanned = isset($_GET['banned']) ? $_GET['banned'] : null;
				$bBanned = $bBanned == "true" || $bBanned == "1";
				$strInfo = isset($_GET['info']) ? $_GET['info'] : null;

				if( $strUserID != null )
				{
					// bBanned is true or false whether userID has been banned by an admin
					if( $bBanned )
					{
						if( $strInfo != null && $strInfo != "" )
						{
							//if you're using a banOptions list (see getDomainPreferences), strInfo will contain the text of the <option> tag (i.e "One Day")
						}
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "setBlockedStatus":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strBlockedUserID = isset($_GET['blockedUserID']) ? $_GET['blockedUserID'] : null;
				$bBlocked = isset($_GET['blocked']) ? $_GET['blocked'] : null;
				$bBlocked = $bBlocked == "true" || $bBlocked == "1";

				if( $strUserID != null && $strBlockedUserID != null )
				{
					// bBlocked is the true or false boolean that specifies whether they are blocked
					if( $bBlocked )
					{
					}
					else
					{
					}
					// Handle thisevent, no need to return anything else
				}
				break;

			case "setFriendStatus":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strFriendUserID = isset($_GET['friendUserID']) ? $_GET['friendUserID'] : null;
				$bFriend = isset($_GET['friend']) ? $_GET['friend'] : null;
				$bFriend = $bFriend == "true" || $bFriend == "1";

				if( $strUserID != null && $strFriendUserID != null )
				{
					// bFriend is a boolean true or false whether strUserID is adding or removing strFriendUserID from friend list
					if( $bFriend )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "getAnnouncements":
				// This function is not on by default, use getAnnouncementsInterval in getDomainPreferences to turn it on
				echo( "<announcementList>" );
					echo( "<announcement><![CDATA[<b>Site Notification:</b> There will be limbo in the leto lounge at 0200]]></announcement>" );
					echo( "<announcement><![CDATA[Check out our new <a href='newsPage.html' target='_blank'>news section</a>]]></announcement>" );
				echo( "</announcementList>" );
				break;

			case "getConfPhoneNumber":
				$strApp = isset($_GET['app']) ? $_GET['app'] : null;
				$strConferenceID = isset($_GET['conferenceID']) ? $_GET['conferenceID'] : null;

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				echo( "<confPhoneNumber><![CDATA[800-555-1212 x12345]]></confPhoneNumber>" );
				break;

			case "reportAbuse":
				$strXmlData = isset($_POST['xmlData']) ? $_POST['xmlData'] : null;
				// This function is not on by default, use reportAbuse in getDomainPreferences to turn it on
				/*
				//the incoming POST xmlData will look like this:
				<?xml version='1.0' encoding='iso-8859-1'?>
				<abuse>
					<reportingUserID>12345</reportingUserID>
					<abuserUserID>23456</abuserUserID>
					<abuserIPAddress></abuserIPAddress>
					<recordingName>DE291953-5004-C272-9A6A9ABCC3031B35</recordingName>
					<recordingWebAccessibleURL></recordingWebAccessibleURL>
					<description>Said awful things to me accused me of being a "pimp"</description>
					<room>
						<name><![CDATA[asfd]]></name>
						<messages>
							<entry type="msg">
								<timestamp>1126551127685</timestamp>
								<displayName><![CDATA[tom]]></displayName>
								<userID invisible="false">1</userID>
								<content><![CDATA[this is my message]]></content>
							</entry>
						</messages>
					</room>
				</abuse>
				*/
				break;

			case "sendArchive":
				$strXmlData = isset($_POST['xmlData']) ? $_POST['xmlData'] : null;
				// This function is not on by default, use sendArchive in getDomainPreferences to turn it on
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
				$strXmlData = isset($_POST['xmlData']) ? $_POST['xmlData'] : null;
				// This function is not on by default, use sendConnectionListInterval in getDomainPreferences to turn it on
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

			case "getVideoFilesToDelete":
				echo( "<videoList>" );
					echo( "<user id=\"12345\">" );
						echo( "<video status=\"new\"><![CDATA[videoID1]]></video>" );
						echo( "<video status=\"approved\"><![CDATA[videoID2]]></video>" );
						echo( "<video status=\"all\"><![CDATA[videoID3]]></video>" );
					echo( "</user>" );
					echo( "<user id=\"34567\"/>" ); // This will delete all videos for a particular user
					echo( "<user id=\"67890\">" );
						echo( "<video status=\"approved\"><![CDATA[videoID4]]></video>" );
					echo( "</user>" );
				echo( "</videoList>" );
				break;

			case "getVideos":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strVideoIDs = isset($_GET['videoIDs']) ? $_GET['videoIDs'] : null;
				$strVideoUserID = isset($_GET['videoUserID']) ? $_GET['videoUserID'] : null;

				$videoArray = array();
				if( $strVideoIDs != null )
				{
					$videoArray = array_unique(array_filter(explode(",", $strVideoIDs), "strlen"));
				}

				echo( "<videoList>" );
					for( $i = 0 ; $i < count($videoArray) ; $i++ )
					{
						$currentVideoId = $videoArray[$i];
						echo( "<video>" );
							echo( "<videoID>" . $currentVideoId . "</videoID>" ); // a unique identifier for this video
							echo( "<autoPlay>true</autoPlay>" ); //Êset to true to play on startup
							echo( "<autoLoad>true</autoLoad>" ); // set to true to load on startup
							echo( "<startImage></startImage>" ); // the background image to display on startup -- if not passed, it will use the autogenerated thumbnail from the video.
							echo( "<title></title>" ); //  the video title
							echo( "<description></description>" ); //  a text description of the media
							echo( "<ownerUsername></ownerUsername>" ); // the username of the person who uploaded/recorded this video
							echo( "<viewCount>0</viewCount>" );
							echo( "<rankCount>0</rankCount>" );
							echo( "<rating>10</rating>" ); // the current rating (1-10)
							echo( "<tags></tags>" );	// comma seperated list of tags
						echo( "</video>" );
					}
				echo( "</videoList>" );
				break;

			case "getRecordingPreferences":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strVideoID = isset($_GET['videoID']) ? $_GET['videoID'] : null;
				$strVideoUserID = isset($_GET['videoUserID']) ? $_GET['videoUserID'] : null;

				echo( "<video>" );
					echo( "<webAccessible>true</webAccessible>" ); // this is only for webrecorder calls
				echo( "</video>" );
				break;

			case "onVideoFileChange":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strVideoID = isset($_GET['videoID']) ? $_GET['videoID'] : null;
				$strStatusList = isset($_GET['statusList']) ? $_GET['statusList'] : null;
				$strError = isset($_GET['error']) ? $_GET['error'] : null; // if there was a problem with the recording or encoding

				$strXmlData = isset($_POST['xmlData']) ? $_POST['xmlData'] : null;

				/*
					statuslist is a comma-delimeted string of all the files associated with this
					userID and videoID.  For example:

					new,approved

					In this case there is an approved video that is live on the site and also another
					new video waiting for an admin to approve.  Once the admin approves this new video,
					it will replace the approved video and another onVideoFileChange event will get
					fired

					There will also be xmlData passed in with details of each file per status in statusList. You can
					just ignore statusList if you want to use this data since it is duplicated

					<videolist>
					    <video>
					        <status>new</status>
					        <videourl>http://server/path/to/file.flv<videourl>
					        <thumbnailurl>http://server/path/to/file.jpg<thumbnailurl>
					        <duration>2:04<duration>
					    </video>
					    <video>
					        <status>approved</status>
					        <videourl>http://server/path/to/file.flv<videourl>
					        <thumbnailurl>http://server/path/to/file.jpg<thumbnailurl>
					        <duration>1:36<duration>
					    </video>
					</videolist>
				*/

				// Put your code here.  No need to return anything
				break;


			case "startWebmessengerConversation":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strTargetUserID = isset($_GET['targetUserID']) ? $_GET['targetUserID'] : null;

				// Put your code here.  No need to return anything
				break;

			case "onWebmessengerConnectionClosed":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strTargetUserID = isset($_GET['targetUserID']) ? $_GET['targetUserID'] : null;

				// in addition, you can also use the FORM.xmlData variable to get any messages that were never delivered to the targetUser.
				$strXmlData = isset($_POST['xmlData']) ? $_POST['xmlData'] : null;

				// Put your code here.  No need to return anything
				break;

			case "sendPendingWebmessengerMessages":
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$strTargetUserID = isset($_GET['targetUserID']) ? $_GET['targetUserID'] : null;

				// Use the FORM.xmlData variable to get any messages that were never delivered to the targetUser.
				$strXmlData = isset($_POST['xmlData']) ? $_POST['xmlData'] : null;

				// Put your code here.  No need to return anything
				break;

			case "onForumStatusChange":
				$strForumID = isset($_GET['forumID']) ? $_GET['forumID'] : null;
				$strForumName = isset($_GET['forumName']) ? $_GET['forumName'] : null;
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$bExists = isset($_GET['exists']) ? $_GET['exists'] : null;
				$bExists = $bExists == "true" || $bExists == "1";

				// Put your code here.  No need to return anything
				break;

			case "onTopicStatusChange":
				$strTopicID = isset($_GET['topicID']) ? $_GET['topicID'] : null;
				$strTopicName = isset($_GET['topicName']) ? $_GET['topicName'] : null;
				$strUserID = isset($_GET['userID']) ? $_GET['userID'] : null;
				$bExists = isset($_GET['exists']) ? $_GET['exists'] : null;
				$bExists = $bExists == "true" || $bExists == "1";

				// Put your code here.  No need to return anything
				break;

			default:
				break;
		}
	}

	echo( "</communicationsuite>" );
?>
