<%@ Page Language="C#" ValidateRequest="false" ContentType="text/xml; charset=utf-8" %>

<%
	Response.Write( "<?xml version='1.0' encoding='utf-8'?>" );
	Response.Write( "<!-- COPYRIGHT Userplane 2004 (http://www.userplane.com) -->" );
	Response.Write( "<!-- CS version 2.0.2 -->" );
	Response.Write( "<communicationsuite>" );

	Response.Write( "<time>" + new DateTime() + "</time>" );

	String strDomainID = Request.QueryString["domainID"];
	String strInstanceID = Request.QueryString["instanceID"];
	String strFunction = Request.QueryString["function"];
	String strCallID = Request.QueryString["callID"];

	if( strFunction == null )
	{
		strFunction = Request.QueryString["action"];
	}

	if( strFunction != null && strDomainID != null )
	{
		String strSessionGUID, strKey, strUserID, strUserIDList, strApp, strUrl, strIpAddress, strRoomName, strInfo, strVideoIDs, strVideoUserID, strVideoID, strStatusList, strError, strTargetUserID, strForumID, strForumName, strTopicID, strTopicName, strBlockedUserID, strFriendUserID, strConferenceID, strXmlData = null;
		bool bStartup, bConnected, bAdmin, bExists, bInRoom, bBlocked, bBanned, bFriend = false;

		switch( strFunction )
		{
			case "getDomainPreferences":
				bStartup = Request.QueryString["startup"] == "true" || Request.QueryString["startup"] == "1";

				Response.Write( "<domain>" );
					Response.Write( "<common>" );
						Response.Write( "<maxxmlretries>5</maxxmlretries>" );
						Response.Write( "<avenabled>false</avenabled>" );
						Response.Write( "<forbiddenwordslist>crap,shit</forbiddenwordslist>" );
						Response.Write( "<allowCalls>setBannedStatus,setBlockedStatus,setFriendStatus</allowCalls>" );
						Response.Write( "<domainPrefReloadInterval>-1</domainPrefReloadInterval>" );
						Response.Write( "<maxUsers includeAdmins=\"false\" includeSpeakers=\"false\">-1</maxUsers>" );
						Response.Write( "<domainInvalid>false</domainInvalid>" );
						Response.Write( "<adminsRequired>false</adminsRequired>" );
						Response.Write( "<textColors>000000,ff0000,f0037f,4c004a,000275,26429b,00a0c6,005100,6dc000,ff3f00,ff8600,542c06,905b34,787878,7ea5ba</textColors>" );
						Response.Write( "<smileys>" );
							Response.Write( "<smiley>" );
								Response.Write( "<name>Ultra Angry</name>" );
								Response.Write( "<image>http://images.yourCompany.userplane.com/images/smiley/UltraAngry.jpg</image>" );
								Response.Write( "<codes>" );
									Response.Write( "<code><![CDATA[>>:O]]></code>" );
									Response.Write( "<code><![CDATA[>>:-O]]></code>" );
								Response.Write( "</codes>" );
							Response.Write( "</smiley>" );
							Response.Write( "<smiley>" );
								Response.Write( "<name>Angry</name>" );
								Response.Write( "<image>DELETE</image>" );
							Response.Write( "</smiley>" );
						Response.Write( "</smileys>" );
					Response.Write( "</common>" );
					Response.Write( "<chat>" );
						Response.Write( "<allowModeratedRooms autoOn=\"false\">false</allowModeratedRooms>" );
						Response.Write( "<floodControlResetTime>5</floodControlResetTime>" );
						Response.Write( "<floodControlInterval>5</floodControlInterval>" );
						Response.Write( "<floodControlMaxMessages>5</floodControlMaxMessages>" );
						Response.Write( "<labels>" );
							Response.Write( "<userdata initiallines=\"0\">" );
								Response.Write( "<line>Age</line>" );
								Response.Write( "<line>Sex</line>" );
								Response.Write( "<line>Location</line>" );
							Response.Write( "</userdata>" );
							Response.Write( "<lobby><name>Waiting Room</name><description>Lobby Description</description></lobby>" );
						Response.Write( "</labels>" );
						Response.Write( "<maxroomusers>20</maxroomusers>" );
						// Allowing multiple dock items could result in bandwidth overage fees.
						// Please contact a userplane representative for details on overage rates and billing questions.
						// http://www.userplane.com/contact.cfm
						Response.Write( "<maxdockitems>0</maxdockitems>" );
						Response.Write( "<characterlimit>200</characterlimit>" );
						Response.Write( "<userroomcreate>true</userroomcreate>" );
						Response.Write( "<roomemptytimeout>600</roomemptytimeout>" );
						Response.Write( "<maxhistorymessages>20</maxhistorymessages>" );
						Response.Write( "<showJoinLeaveMessages>true</showJoinLeaveMessages>" );
						Response.Write( "<gui>" );
							Response.Write( "<viewprofile>true</viewprofile>" );
							Response.Write( "<instantcommunicator>true</instantcommunicator>" );
							Response.Write( "<addfriend>true</addfriend>" );
							Response.Write( "<block>true</block>" );
							Response.Write( "<reportabuse textLines=\"0\" avEnabled=\"false\" avWebAccessible=\"true\" avSeconds=\"30\" avUserID=\"\">false</reportabuse>" );
							Response.Write( "<titleBarColor></titleBarColor>" );
							Response.Write( "<scrollTrackColor></scrollTrackColor>" );
							Response.Write( "<outerBackgroundColor></outerBackgroundColor>" );
							Response.Write( "<innerBackgroundColor></innerBackgroundColor>" );
							Response.Write( "<uiFontColor></uiFontColor>" );
							Response.Write( "<buttonColor></buttonColor>" );
							Response.Write( "<leftPaneMinimized>false</leftPaneMinimized>" );
							Response.Write( "<dockMinimized>false</dockMinimized>" );
							Response.Write( "<images>" );
								Response.Write( "<watermark alpha=\"5\">http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg</watermark>" );
							Response.Write( "</images>" );
							Response.Write( "<initialinputlines>1</initialinputlines>" );
							Response.Write( "<help>true</help>" );
						Response.Write( "</gui>" );
						Response.Write( "<roomlist>" );
							// Make as many as you want, these will always appear when the app reloads (even if deleted in the client)
							Response.Write( "<room><name>Singles</name><description>Singles Description</description></room>" );
							Response.Write( "<room><name>Lazy People</name><description>Lazy People Description</description></room>" );
							Response.Write( "<room><name>Athletic People</name><description>Athletic People Description</description></room>" );
						Response.Write( "</roomlist>" );
						Response.Write( "<getannouncementsinterval>-1</getannouncementsinterval>" );
						Response.Write( "<sendarchive>false</sendarchive>" );
						Response.Write( "<banNotification><![CDATA[<b>[[NAME]] was banned</b>]]></banNotification>" );
						Response.Write( "<sendConnectionListInterval>-1</sendConnectionListInterval>" );
						Response.Write( "<conferenceCallEnabled>-1</conferenceCallEnabled>" );
						Response.Write( "<conferenceCallText>Call the party line: </conferenceCallText>" );
					Response.Write( "</chat>" );
					Response.Write( "<video>" );
						Response.Write( "<maxrecordseconds>30</maxrecordseconds>" );
						Response.Write( "<autoApprove>false</autoApprove>" );
						Response.Write( "<sendVideoFileListInterval>0</sendVideoFileListInterval>" );
						Response.Write( "<noVideoImage></noVideoImage>" );
						Response.Write( "<videoNotEnabledImage></videoNotEnabledImage>" );
					Response.Write( "</video>" );
					Response.Write( "<boards>" );
						Response.Write( "<autoApprove>true</autoApprove>" );
						Response.Write( "<reportAbuse>true</reportAbuse>" ); // if report abuse button is on / off
						Response.Write( "<seo enabled=\"true\">" );
							Response.Write( "<url></url>" );
							Response.Write( "<keywords></keywords>" );
							Response.Write( "<description></description>" );
						Response.Write( "</seo>" );
						Response.Write( "<ranks>" );
							Response.Write( "<rank threshhold=\"0\">" );
								Response.Write( "<name>Grunt</name>" );
								Response.Write( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							Response.Write( "</rank>" );
							Response.Write( "<rank threshhold=\"100\">" );
								Response.Write( "<name>Private</name>" );
								Response.Write( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							Response.Write( "</rank>" );
							Response.Write( "<rank threshhold=\"200\">" );
								Response.Write( "<name>Sargeant</name>" );
								Response.Write( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							Response.Write( "</rank>" );
							Response.Write( "<rank threshhold=\"300\">" );
								Response.Write( "<name>General</name>" );
								Response.Write( "<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>" );
							Response.Write( "</rank>" );
						Response.Write( "</ranks>" );
					Response.Write( "</boards>" );
				Response.Write( "</domain>" );
				break;

			case "getUser":
				strSessionGUID = Request.QueryString["sessionGUID"];
				strKey = Request.QueryString["key"];
				strUserIDList = Request.QueryString["userIDList"];
				strApp = Request.QueryString["app"];
				strUrl = Request.QueryString["url"];
				strIpAddress = Request.QueryString["ip"];

				if( strSessionGUID != null || strUserIDList != null )
				{
					ArrayList userIDArrayList = new ArrayList();
					if( strUserIDList != null )
					{
						foreach( String currentUserID in strUserIDList.Split(',') )
						{
							if( currentUserID.Length > 0 )
							{
								userIDArrayList.Add(currentUserID);
							}
						}
					}

					// This first section is all about authenticating a sessionGUID that gets passed in
					String sessionGUIDsUserID = "INVALID";
					// Only validate the strSessionGUID if it is there, otherwise this could just be a data request for other users
					if( strSessionGUID.Length != 0 )
					{
						bool bSessionGUIDIsValidSession = true; // You need to put something in here that sets this boolean accurately
						if( bSessionGUIDIsValidSession )
						{
							sessionGUIDsUserID = "639742"; // You need to lookup the userID that corresponds to the sessionGUID
							userIDArrayList.Add(sessionGUIDsUserID);
						}
					}

					// Now that we have done any potential authentication work, loop through all the users whose data we have to look up
			        foreach (String currentUserId in userIDArrayList)
			        {
						// Need to look up data for the specified userID
						Response.Write( "<user>" );
							Response.Write( "<common>" );
								if( sessionGUIDsUserID == currentUserId )
								{
									Response.Write( "<sessionGuid>" + strSessionGUID + "</sessionGuid>" );
								}
								Response.Write( "<userid>" + currentUserId + "</userid>" );
								Response.Write( "<disconnectApps></disconnectApps>" );
								Response.Write( "<admin>false</admin>" );
								Response.Write( "<speaker>false</speaker>" );
								Response.Write( "<displayname>Jack Jackson</displayname>" );
								Response.Write( "<email>someuser@domain.com</email>" );
								Response.Write( "<allowcommapiaccess>false</allowcommapiaccess>" );
								Response.Write( "<aimscreenname enabled=\"false\" autoLogin=\"true\"></aimscreenname>" );
								Response.Write( "<allowCustomStatusMessages>true</allowCustomStatusMessages>" );
								Response.Write( "<avsettings>" );
									Response.Write( "<avenabled>true</avenabled>" );
									Response.Write( "<audioSend>true</audioSend>" );
									Response.Write( "<videoSend>true</videoSend>" );
									Response.Write( "<audioReceive>true</audioReceive>" );
									Response.Write( "<videoReceive>true</videoReceive>" );
									Response.Write( "<audiokbps>16</audiokbps>" ); 		// acceptable values: 10,16,22,44,88
									Response.Write( "<videokbps>100</videokbps>" );		// recommended range: 10 - 200
									Response.Write( "<videofps>15</videofps>" );		// acceptable range: 1 - 30
									Response.Write( "<videosize>1</videosize>" );		// acceptable values: 1, 2, 3
									Response.Write( "<videoDisplaySize>2</videoDisplaySize>" );
								Response.Write( "</avsettings>" );
								Response.Write( "<buddylist>" );
									Response.Write( "<user>" );
										Response.Write( "<userid>22222</userid>" );
										Response.Write( "<displayname>joeschmoe</displayname>" );
										Response.Write( "<images>" );
											Response.Write( "<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>" );
											Response.Write( "<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>" );
										Response.Write( "</images>" );
									Response.Write( "</user>" );
									Response.Write( "<user>" );
										Response.Write( "<userid>33333</userid>" );
										Response.Write( "<displayname>johnjohnson</displayname>" );
										Response.Write( "<images>" );
											Response.Write( "<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>" );
											Response.Write( "<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>" );
										Response.Write( "</images>" );
									Response.Write( "</user>" );
								Response.Write( "</buddylist>" );
								Response.Write( "<blocklist>" );
									Response.Write( "<userid>45</userid>" );
									Response.Write( "<userid>21</userid>" );
								Response.Write( "</blocklist>" );
								Response.Write( "<images>" );
									Response.Write( "<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>" );
									Response.Write( "<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>" );
									Response.Write( "<fullsize>http://images.yourcompany.userplane.com/pathToFullSize.jpg</fullsize>" );
								Response.Write( "</images>" );
							Response.Write( "</common>" );
							Response.Write( "<chat>" );
								Response.Write( "<userdatavalues>" );
									Response.Write( "<line>Milpitas, CA</line>" );
									Response.Write( "<line>Honda of Milpitas</line>" );
									Response.Write( "<line>2003 CBR F4</line>" );
								Response.Write( "</userdatavalues>" );
								Response.Write( "<gui>" );
									Response.Write( "<viewprofile>true</viewprofile>" );
									Response.Write( "<instantcommunicator>true</instantcommunicator>" );
								Response.Write( "</gui>" );
								Response.Write( "<notextentry>false</notextentry>" );
								Response.Write( "<invisible>false</invisible>" );
								Response.Write( "<userroomcreate>true</userroomcreate>" );
								Response.Write( "<adminrooms>" );
									Response.Write( "<room createOnLogin='true'><name>Joe's Room</name><description>A rooom just for Joe</description></room>" );
									Response.Write( "<room createOnLogin='false'><name>Singles</name><description>Singles Description</description></room>" );
									Response.Write( "<room createOnLogin='false'><name>18-24</name></room>" );
								Response.Write( "</adminrooms>" );
								Response.Write( "<restrictedRooms allowRestricted='false'>" );
									Response.Write( "<room createOnLogin='true' creatorID='4377'><name>Only Site Admins</name><description>Only Site admins can get into this room</description></room>" );
								Response.Write( "</restrictedRooms>" );
								Response.Write( "<initialroom createOnLogin='true'>Lazy People</initialroom>" );
								Response.Write( "<maxdockitems>1</maxdockitems>" );
								Response.Write( "<permitCopy>true</permitCopy>" );
								Response.Write( "<sessionTimeout>-1</sessionTimeout>" );
								Response.Write( "<sessionTimeoutMessage>Your session has expired.</sessionTimeoutMessage>" );
								Response.Write( "<selectedUser>123</selectedUser>" );
								Response.Write( "<inactivityTimeout>2</inactivityTimeout>" );
								Response.Write( "<inactivityTimeoutMessage>You were timed out due to inactivity.</inactivityTimeoutMessage>" );
								Response.Write( "<permitWhisper>true</permitWhisper>" );
								Response.Write( "<banOptions>" );
									Response.Write( "<message>How long would you like to ban this user?</message>" );
									Response.Write( "<list>" );
										Response.Write( "<option>One Hour</option>" );
										Response.Write( "<option>One Day</option>" );
										Response.Write( "<option>One Week</option>" );
										Response.Write( "<option>One Month</option>" );
										Response.Write( "<option>Forever</option>" );
									Response.Write( "</list>" );
								Response.Write( "</banOptions>" );
								Response.Write( "<userConnectGreeting></userConnectGreeting>" );
							Response.Write( "</chat>" );
							Response.Write( "<userlist>" );
								Response.Write( "<gui>" );
									Response.Write( "<modulelist>miniprofile,onlineusers,buddylist</modulelist>" );
									Response.Write( "<viewprofile>false</viewprofile>" );
									Response.Write( "<instantcommunicator>false</instantcommunicator>" );
									Response.Write( "<addfriend>true</addfriend>" );
									Response.Write( "<search>true</search>" );
									Response.Write( "<allowCustomStatusMessages>true</allowCustomStatusMessages>" );
								Response.Write( "</gui>" );
								Response.Write( "<buddyviewableonly>false</buddyviewableonly>" );
							Response.Write( "</userlist>" );
							Response.Write( "<minichat>" );
								Response.Write( "<useAnonymousScreenNames>false</useAnonymousScreenNames>" );
								Response.Write( "<showUserCount>true</showUserCount>" );
								Response.Write( "<showWatcherUserCount>true</showWatcherUserCount>" );
								Response.Write( "<allowTextInput>false</allowTextInput>" );
								Response.Write( "<allowRoomUserlist>false</allowRoomUserlist>" );
							Response.Write( "</minichat>" );
							Response.Write( "<boards>" );
								Response.Write( "<gui>" );
									Response.Write( "<viewprofile>true</viewprofile>" );
									Response.Write( "<webmessenger>true</webmessenger>" );
									Response.Write( "<rate>true</rate>" ); // rate buttons on / off
									Response.Write( "<embed>true</embed>" ); // embed button on / off
									Response.Write( "<branch>true</branch>" ); // branch button on / off
									Response.Write( "<search>true</search>" ); // search tab on / off
									Response.Write( "<watch>true</watch>" ); // watched threads tab and watch button on / off
									Response.Write( "<help>true</help>" ); // help button on / off
									Response.Write( "<link>true</link>" ); // link buttons on / off
									Response.Write( "<addfriend>true</addfriend>" );
									Response.Write( "<latestPosts>5</latestPosts>" ); // number of posts to show in the modules on the home state
									Response.Write( "<activeThreads>5</activeThreads>" ); // number of threads to show in the modules on the home state
									Response.Write( "<connectGreeting>Welcome to Boards!</connectGreeting>" );
									Response.Write( "<profileData>" );
										Response.Write( "<line label=\"Age\">29</line>" );
										Response.Write( "<line label=\"Sex\">M</line>" );
										Response.Write( "<line label=\"Location\">Santa Monica</line>" );
									Response.Write( "</profileData>" );
								Response.Write( "</gui>" );
								Response.Write( "<readOnly>false</readOnly>" );
								Response.Write( "<adminForums>" );
									Response.Write( "<forumID>2342</forumID>" );
									Response.Write( "<forumID>765</forumID>" );
								Response.Write( "</adminForums>" );
								Response.Write( "<adminTopics>" );
									Response.Write( "<topicID>323</topicID>" );
									Response.Write( "<topicID>2451</topicID>" );
								Response.Write( "</adminTopics>" );
								Response.Write( "<restrictedForums allowRestricted=\"false\">" );
									Response.Write( "<forumID>5665</forumID>" );
									Response.Write( "<forumID>765</forumID>" );
									Response.Write( "<forumID>54543</forumID>" );
								Response.Write( "</restrictedForums>" );
								Response.Write( "<timeouts>" );
									Response.Write( "<session>-1</session>" );
									Response.Write( "<sessionMessage>Your session has expired.</sessionMessage>" );
									Response.Write( "<inactivity>2</inactivity>" );
									Response.Write( "<inactivityMessage>You were timed out due to inactivity.</inactivityMessage>" );
								Response.Write( "</timeouts>" );
							Response.Write( "</boards>" );
						Response.Write( "</user>" );
					}
				}
				break;

			case "onRoomStatusChange":
				strUserID = Request.QueryString["userID"];
				strRoomName = Request.QueryString["roomName"];
				bAdmin = Request.QueryString["admin"] == "true" || Request.QueryString["admin"] == "1";
				bExists = Request.QueryString["exists"] == "true" || Request.QueryString["exists"] == "1";

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( strRoomName != null && strUserID != null )
				{
					// bExists is the true or false boolean that specifies whether the room exists or not
					// bAdmin is also available (see docs)
					if( bExists )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "onUserConnectionChange":
				strUserID = Request.QueryString["userID"];
				bConnected = Request.QueryString["connected"] == "true" || Request.QueryString["connected"] == "1";

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( strUserID != null )
				{
					// bConnected is the true or false boolean that specifies wheter they are online or offline
					if( bConnected )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "onUserRoomChange":
				strUserID = Request.QueryString["userID"];
				strRoomName = Request.QueryString["roomName"];
				bInRoom = Request.QueryString["inRoom"] == "true" || Request.QueryString["inRoom"] == "1";

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				if( strRoomName != null && strUserID != null )
				{
					// bInRoom is the true or false boolean that specifies whether they are in the room
					if( bInRoom )
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
				break;

			case "setBannedStatus":
				strUserID = Request.QueryString["userID"];
				strInfo = Request.QueryString["info"];
				bBanned = Request.QueryString["banned"] == "true" || Request.QueryString["banned"] == "1";

				if( strUserID != null )
				{
					// bBanned is true or false whether userID has been banned by an admin
					if( bBanned )
					{
						if( strInfo != null && strInfo != "" )
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
				strUserID = Request.QueryString["userID"];
				strBlockedUserID = Request.QueryString["blockedUserID"];
				bBlocked = Request.QueryString["blocked"] == "true" || Request.QueryString["blocked"] == "1";

				if( strUserID != null && strBlockedUserID != null )
				{
					// bBlocked is the true or false boolean that specifies whether they are blocked
					if( bBlocked )
					{
					}
					else
					{
					}
					// Handle this event, no need to return anything else
				}
				break;

			case "setFriendStatus":
				strUserID = Request.QueryString["userID"];
				strFriendUserID = Request.QueryString["friendUserID"];
				bFriend = Request.QueryString["friend"] == "true" || Request.QueryString["friend"] == "1";

				if( strUserID != null && strFriendUserID != null )
				{
					// bFriend is a boolean true or false whether strUserID is adding or removing strFriendUserID from friend list
					if( bFriend )
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
				Response.Write( "<announcementList>" );
					Response.Write( "<announcement><![CDATA[<b>Site Notification:</b> There will be limbo in the leto lounge at 0200]]></announcement>" );
					Response.Write( "<announcement><![CDATA[Check out our new <a href='newsPage.html' target='_blank'>news section</a>]]></announcement>" );
				Response.Write( "</announcementList>" );
				break;

			case "getConfPhoneNumber":
				strApp = Request.QueryString["app"];
				strConferenceID = Request.QueryString["conferenceID"];

				// This function is not on by default, use allowCalls in getDomainPreferences to turn it on
				Response.Write( "<confPhoneNumber><![CDATA[800-555-1212 x12345]]></confPhoneNumber>" );
				break;

			case "reportAbuse":
				strXmlData = Request.Form["xmlData"];

				// This function is not on by default, use reportAbuse in getDomainPreferences to turn it on
				/* The incoming POST xmlData will look like this:
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
				strXmlData = Request.Form["xmlData"];

				// This function is not on by default, use sendArchive in getDomainPreferences to turn it on
				/* The incoming POST xmlData will look like this:
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
				strXmlData = Request.Form["xmlData"];

				// This function is not on by default, use sendConnectionListInterval in getDomainPreferences to turn it on
				/* The incoming POST xmlData will look like this:
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
				Response.Write( "<videoList>" );
					Response.Write( "<user id=\"12345\">" );
						Response.Write( "<video status=\"new\"><![CDATA[videoID1]]></video>" );
						Response.Write( "<video status=\"approved\"><![CDATA[videoID2]]></video>" );
						Response.Write( "<video status=\"all\"><![CDATA[videoID3]]></video>" );
					Response.Write( "</user>" );
					Response.Write( "<user id=\"34567\"/>" ); // This will delete all videos for a particular user
					Response.Write( "<user id=\"67890\">" );
						Response.Write( "<video status=\"approved\"><![CDATA[videoID4]]></video>" );
					Response.Write( "</user>" );
				Response.Write( "</videoList>" );
				break;

			case "getVideos":
				strUserID = Request.QueryString["userID"];
				strVideoIDs = Request.QueryString["videoIDs"];
				strVideoUserID = Request.QueryString["videoUserID"];

				Response.Write( "<videoList>" );
					if( strVideoIDs != null )
					{
						foreach( String currentVideoID in strVideoIDs.Split(',') )
						{
							if( currentVideoID.Length > 0 )
							{
								Response.Write( "<video>" );
									Response.Write( "<videoID>" + currentVideoID + "</videoID>" ); // a unique identifier for this video
									Response.Write( "<autoPlay>true</autoPlay>" ); //Êset to true to play on startup
									Response.Write( "<autoLoad>true</autoLoad>" ); // set to true to load on startup
									Response.Write( "<startImage></startImage>" ); // the background image to display on startup -- if not passed, it will use the autogenerated thumbnail from the video.
									Response.Write( "<title></title>" ); //  the video title
									Response.Write( "<description></description>" ); //  a text description of the media
									Response.Write( "<ownerUsername></ownerUsername>" ); // the username of the person who uploaded/recorded this video
									Response.Write( "<viewCount>0</viewCount>" );
									Response.Write( "<rankCount>0</rankCount>" );
									Response.Write( "<rating>10</rating>" ); // the current rating (1-10)
									Response.Write( "<tags></tags>" );	// comma seperated list of tags
								Response.Write( "</video>" );
							}
						}
					}
				Response.Write( "</videoList>" );
				break;

			case "getRecordingPreferences":
				strUserID = Request.QueryString["userID"];
				strVideoID = Request.QueryString["videoID"];
				strVideoUserID = Request.QueryString["videoUserID"];

				Response.Write( "<video>" );
					Response.Write( "<webAccessible>true</webAccessible>" ); // this is only for webrecorder calls
				Response.Write( "</video>" );
				break;

			case "onVideoFileChange":
				strUserID = Request.QueryString["userID"];
				strVideoID = Request.QueryString["videoID"];
				strStatusList = Request.QueryString["statusList"];
				strError = Request.QueryString["error"]; // if there was a problem with the recording or encoding

				strXmlData = Request.Form["xmlData"];

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
				strUserID = Request.QueryString["userID"];
				strTargetUserID = Request.QueryString["targetUserID"];

				// Put your code here.  No need to return anything
				break;

			case "onWebmessengerConnectionClosed":
				strUserID = Request.QueryString["userID"];
				strTargetUserID = Request.QueryString["targetUserID"];

				// in addition, you can also use the FORM.xmlData variable to get any messages that were never delivered to the targetUser.
				strXmlData = Request.Form["xmlData"];

				// Put your code here.  No need to return anything
				break;

			case "sendPendingWebmessengerMessages":
				strUserID = Request.QueryString["userID"];
				strTargetUserID = Request.QueryString["targetUserID"];

				// Use the FORM.xmlData variable to get any messages that were never delivered to the targetUser.
				strXmlData = Request.Form["xmlData"];

				// Put your code here.  No need to return anything
				break;

			case "onForumStatusChange":
				strForumID = Request.QueryString["forumID"];
				strForumName = Request.QueryString["forumName"];
				strUserID = Request.QueryString["userID"];
				bExists = Request.QueryString["exists"] == "true" || Request.QueryString["exists"] == "1";

				// Put your code here.  No need to return anything
				break;

			case "onTopicStatusChange":
				strTopicID = Request.QueryString["topicID"];
				strTopicName = Request.QueryString["topicName"];
				strUserID = Request.QueryString["userID"];
				bExists = Request.QueryString["exists"] == "true" || Request.QueryString["exists"] == "1";

				// Put your code here.  No need to return anything
				break;

			default:
				break;
		}
	}

	Response.Write( "</communicationsuite>" );
%>


