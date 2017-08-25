<cfcontent type="text/xml; charset=utf-8"><?xml version='1.0' encoding='utf-8'?>
<!-- COPYRIGHT Userplane 2004 (http://www.userplane.com) -->
<!-- CS version 2.1.0 -->
<communicationsuite>
	<time><cfoutput>#now()#</cfoutput></time>

	<cfparam name="URL.action" default="">
	<cfparam name="URL.function" default="#URL.action#">
	<cfparam name="URL.domainID" default="">
	<cfparam name="URL.instanceID" default="">
	<cfparam name="URL.callID" default="">

	<cfswitch expression="#URL.function#">

		<cfcase value="getDomainPreferences">
			<cfparam name="URL.startup" default="">

			<domain>
				<common>
					<maxxmlretries>5</maxxmlretries>
					<avenabled>true</avenabled>
					<forbiddenwordslist>crap,shit</forbiddenwordslist>
					<allowCalls>setBannedStatus,setBlockedStatus,setFriendStatus</allowCalls>
					<domainPrefReloadInterval>-1</domainPrefReloadInterval> <!--- in minutes --->
					<maxUsers includeAdmins="false" includeSpeakers="false">-1</maxUsers>
					<domainInvalid>false</domainInvalid> <!--- if true, users will not be allowed connection and all will be disconnected if connected already --->
					<adminsRequired>false</adminsRequired> <!--- if true, users will not be allowed connection if no admins connected and all will be disconnected when admin leaves --->
					<textColors>000000,ff0000,f0037f,4c004a,000275,26429b,00a0c6,005100,6dc000,ff3f00,ff8600,542c06,905b34,787878,7ea5ba</textColors>
					<smileys>
						<smiley>
							<name>Ultra Angry</name>
							<image>http://images.yourCompany.userplane.com/images/smiley/UltraAngry.jpg</image>
							<codes>
								<code><![CDATA[>>:O]]></code>
								<code><![CDATA[>>:-O]]></code>
							</codes>
						</smiley>
						<smiley>
							<name>Angry</name>
							<image>DELETE</image>
						</smiley>
					</smileys>
				</common>
				<chat>
					<allowModeratedRooms autoOn="false">false</allowModeratedRooms>
					<floodControlResetTime>5</floodControlResetTime>
					<floodControlInterval>5</floodControlInterval>
					<floodControlMaxMessages>5</floodControlMaxMessages>
					<labels>
						<userdata initiallines="0">
							<line>Age</line>
							<line>Sex</line>
							<line>Location</line>
						</userdata>
						<lobby><name>Waiting Room</name><description>Lobby Description</description></lobby>
					</labels>
					<maxroomusers>20</maxroomusers>
					<!--- Allowing multiple dock items could result in bandwidth overage fees.--->
					<!--- Please contact a userplane representative for details on overage rates and billing questions.--->
					<!--- http://www.userplane.com/contact.cfm--->
					<maxdockitems>0</maxdockitems>
					<characterlimit>200</characterlimit>
					<userroomcreate>true</userroomcreate>
					<roomemptytimeout>600</roomemptytimeout>
					<maxhistorymessages>20</maxhistorymessages>
					<showJoinLeaveMessages>true</showJoinLeaveMessages>
					<gui>
						<viewprofile>true</viewprofile>
						<instantcommunicator>true</instantcommunicator>
						<addfriend>true</addfriend>
						<block>true</block>
						<reportabuse textLines="0" avEnabled="false" avWebAccessible="true" avSeconds="30" avUserID="">false</reportabuse>
						<titleBarColor></titleBarColor>
						<scrollTrackColor></scrollTrackColor>
						<outerBackgroundColor></outerBackgroundColor>
						<innerBackgroundColor></innerBackgroundColor>
						<uiFontColor></uiFontColor>
						<buttonColor></buttonColor>
						<leftPaneMinimized>false</leftPaneMinimized>
						<dockMinimized>false</dockMinimized>
						<images>
							<watermark alpha="5">http://images.clearplane.userplane.com/im/images/UserplaneLogo.jpg</watermark>
						</images>
						<initialinputlines>1</initialinputlines>
						<help>true</help>
					</gui>
					<roomlist>
						<!--- Make as many as you want, these will always appear when the app reloads (even if deleted in the client) --->
						<room><name>Singles</name><description>Singles Description</description></room>
						<room><name>Lazy People</name><description>Lazy People Description</description></room>
						<room><name>Athletic People</name><description>Athletic People Description</description></room>
					</roomlist>
					<getannouncementsinterval>-1</getannouncementsinterval>
					<sendarchive>false</sendarchive>
					<banNotification><![CDATA[<b>[[NAME]] was banned</b>]]></banNotification>
					<sendConnectionListInterval>-1</sendConnectionListInterval>
					<conferenceCallEnabled>-1</conferenceCallEnabled>
					<conferenceCallText>Call the party line: </conferenceCallText>
				</chat>
				<video>
					<maxrecordseconds>30</maxrecordseconds>
					<autoApprove>false</autoApprove>
					<sendVideoFileListInterval>0</sendVideoFileListInterval>
					<noVideoImage></noVideoImage>
					<videoNotEnabledImage></videoNotEnabledImage>
				</video>
				<webmessenger>
					<allowCalls>setBlockedStatus,sendConnectionList,startConversation</allowCalls>
					<characterlimit>200</characterlimit>
					<forbiddenwordslist>ass,fuck</forbiddenwordslist>
					<smileys>
						<smiley>
							<name>Ultra Angry</name>
							<image>http://images.yourCompany.userplane.com/images/smiley/UltraAngry.jpg</image>
							<codes>
								<code><![CDATA[>>:O]]></code>
								<code><![CDATA[>>:-O]]></code>
							</codes>
						</smiley>
						<smiley>
							<name>Angry</name>
							<image>DELETE</image>
						</smiley>
					</smileys>
					<maxvideobandwidth>20000</maxvideobandwidth>
					<domainlogolarge alpha="10"></domainlogolarge>
					<line1>Age</line1>
					<line2>Sex</line2>
					<line3>Location</line3>
					<line4></line4>
					<avEnabled>true</avEnabled>
					<clickableUserName>true</clickableUserName>
					<clickableTextUserName>false</clickableTextUserName>
					<buddyListButton>true</buddyListButton>
					<preferencesButton>true</preferencesButton>
					<smileyButton>true</smileyButton>
					<blockButton>true</blockButton>
					<gameButton>true</gameButton>
					<soundButton>true</soundButton>
					<sliderButton>true</sliderButton>
					<addBuddyEnabled>true</addBuddyEnabled>
					<connectionTimeout>60</connectionTimeout>
					<sendConnectionListInterval>0</sendConnectionListInterval>
					<sendArchive>false</sendArchive>
					<sendTextToImages>false</sendTextToImages>
					<buttonBarColor></buttonBarColor>
					<inputAreaColor></inputAreaColor>
					<inputAreaBorderColor></inputAreaBorderColor>
					<hideDropShadows>false</hideDropShadows>
					<hideHelp>false</hideHelp>
					<showLocalUserIcon>false</showLocalUserIcon>
					<conferenceCallEnabled>-1</conferenceCallEnabled>
					<maxxmlretries>5</maxxmlretries>
					<receiveSoundURL></receiveSoundURL>
					<sendSoundURL></sendSoundURL>
					<buttonIcons>
						<action></action>
						<add></add>
						<block></block>
						<bold></bold>
						<buddyList></buddyList>
						<italic></italic>
						<preferences></preferences>
						<print></print>
						<smiley></smiley>
						<soundOn></soundOn>
						<soundOff></soundOff>
						<underline></underline>
						<resize></resize>
					</buttonIcons>
					<systemMessages>
						<waiting>true</waiting>
						<open>true</open>
						<closed>true</closed>
						<blocked>true</blocked>
						<away>true</away>
						<nonDeliveryMessage timeout='30' sendOnClose='true' sendOnTimeout='false' promptUser='false'>If [[DISPLAYNAME]] doesn't receive this message, they will be emailed when you close your window</nonDeliveryMessage>
						<nonDeliveryConfirm></nonDeliveryConfirm>
						<conferenceCallInvitation>Join me in a private anonymous phone call: [[NUMBER]]</conferenceCallInvitation>
						<conferenceCallReminder>Join a private anonymous phone call: [[NUMBER]]</conferenceCallReminder>
						<conferenceCallRetrievingNumber>Creating a private anonymous phone number...</conferenceCallRetrievingNumber>
					</systemMessages>
					<quickMessageList>
						<message>
							<title>Standard greeting</title>
							<body>Welcome! How can I help you today?</body>
						</message>
					</quickMessageList>
				</webmessenger>
				<boards>
					<autoApprove>true</autoApprove>
					<reportAbuse>true</reportAbuse> <!--- if report abuse button is on / off --->
					<seo enabled="true">
						<url></url>
						<keywords></keywords>
						<description></description>
					</seo>
					<ranks>
						<rank threshhold="0">
							<name>Grunt</name>
							<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>
						</rank>
						<rank threshhold="100">
							<name>Private</name>
							<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>
						</rank>
						<rank threshhold="200">
							<name>Sargeant</name>
							<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>
						</rank>
						<rank threshhold="300">
							<name>General</name>
							<icon>http://www.yourSite.com/pathToFile/newbie.png</icon>
						</rank>
					</ranks>
				</boards>
			</domain>
		</cfcase>

		<cfcase value="getUser">
			<cfparam name="URL.sessionGUID" default="">
			<cfparam name="URL.userIDList" default="">
			<cfparam name="URL.key" default="">
			<cfparam name="URL.app" default="">
			<cfparam name="URL.ip" default="">
			<cfparam name="URL.url" default="">

			<!--- This first section is all about authenticating a sessionGUID that gets passed in --->
			<cfset sessionGUIDsUserID = "INVALID">
			<!--- Only validate the URL.sessionGUID if it is there, otherwise this could just be a data request for other users --->
			<cfif len(trim( URL.sessionGUID )) NEQ 0>
				<!--- IF URL.sessionGUID is a valid session --->
					<cfset sessionGUIDsUserID = "639742"> <!--- set the userID --->
					<!--- and then append it to the list of users we are looking up in this call --->
					<cfset URL.userIDList = listAppend(URL.userIDList, sessionGUIDsUserID)>
				<!--- ENDIF --->
			</cfif>

			<!--- Now that we have done any potential authentication work, loop through all the users whose data we have to look up --->
			<cfloop list="#URL.userIDList#" index="currentUserID">
				<cfif len(trim( currentUserID )) NEQ 0>
					<!--- Need to look up data for the specified userID here and plug it all in below --->
					<cfoutput>
						<user>
							<common>
								<!--- If the currentUserID is one we authenticated above, return the sessionGUID too so we can accept/reject the connection --->
								<cfif currentUserID EQ sessionGUIDsUserID>
									<sessionGUID>#URL.sessionGUID#</sessionGUID>
								</cfif>
								<userid>#currentUserID#</userid>
								<disconnectApps></disconnectApps> <!--- comma-delimited or "all" --->
								<admin>false</admin>
								<speaker>false</speaker>
								<displayname>My User Name</displayname>
								<email>someuser@domain.com</email>
								<allowcommapiaccess>false</allowcommapiaccess>
								<aimscreenname enabled="false" autoLogin="true"></aimscreenname>
								<allowCustomStatusMessages>true</allowCustomStatusMessages>
								<avsettings>
									<avEnabled>true</avEnabled>
									<audioSend>true</audioSend>
									<videoSend>true</videoSend>
									<audioReceive>true</audioReceive>
									<videoReceive>true</videoReceive>
									<audiokbps>16</audiokbps> 		<!--- acceptable values: 10,16,22,44,88 --->
									<videokbps>100</videokbps>		<!--- recommended range: 10 - 200 --->
									<videofps>15</videofps>			<!--- acceptable range: 1 - 30 --->
									<videosize>1</videosize>		<!--- acceptable values: 1, 2, 3  --->
									<videoDisplaySize>2</videoDisplaySize>
								</avsettings>
								<buddylist>
									<user>
										<userid>22222</userid>
										<displayname>joeschmoe</displayname>
										<images>
											<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>
											<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>
										</images>
									</user>
									<user>
										<userid>33333</userid>
										<displayname>johnjohnson</displayname>
										<images>
											<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>
											<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>
										</images>
									</user>
								</buddylist>
								<blocklist>
									<userid>77777</userid>
								</blocklist>
								<images>
									<icon>http://images.yourcompany.userplane.com/pathToIcon.jpg</icon>
									<thumbnail>http://images.yourcompany.userplane.com/pathToThumbnail.jpg</thumbnail>
									<fullsize>http://images.yourcompany.userplane.com/pathToFullSize.jpg</fullsize>
								</images>
							</common>
							<chat>
								<userdatavalues>
									<line>Milpitas, CA</line>
									<line>Honda of Milpitas</line>
									<line>2003 CBR F4</line>
								</userdatavalues>
								<gui>
									<viewprofile>true</viewprofile>
									<instantcommunicator>true</instantcommunicator>
								</gui>
								<notextentry>false</notextentry>
								<invisible>false</invisible>
								<userroomcreate>true</userroomcreate>
								<adminrooms>
									<room createOnLogin="true"><name>Joe's Room</name><description>A rooom just for Joe</description></room>
									<room createOnLogin="false"><name>Singles</name><description>Singles Description</description></room>
									<room createOnLogin="false"><name>18-24</name></room>
								</adminrooms>
								<restrictedRooms allowRestricted="false">
									<room createOnLogin="true" creatorID="4377"><name>Only Site Admins</name><description>Only Site admins can get into this room</description></room>
								</restrictedRooms>
								<initialroom createOnLogin="true">Lazy People</initialroom>
								<maxdockitems>1</maxdockitems>
								<permitCopy>true</permitCopy>
								<sessionTimeout>-1</sessionTimeout>
								<sessionTimeoutMessage>Your session has expired.</sessionTimeoutMessage>
								<selecteduser>123</selecteduser>
								<inactivityTimeout>2</inactivityTimeout>
	    						<inactivityTimeoutMessage>You were timed out due to inactivity.</inactivityTimeoutMessage>
	  							<permitWhisper>true</permitWhisper>
								<banOptions>
									<message>How long would you like to ban this user?</message>
									<list>
										<option>One Hour</option>
										<option>One Day</option>
										<option>One Week</option>
										<option>One Month</option>
										<option>Forever</option>
									</list>
								</banOptions>
								<userConnectGreeting></userConnectGreeting>
							</chat>
							<userlist>
								<gui>
									<modulelist>miniprofile,onlineusers,buddylist</modulelist>
									<viewprofile>false</viewprofile>
									<instantcommunicator>false</instantcommunicator>
									<addfriend>true</addfriend>
									<search>true</search>
									<allowCustomStatusMessages>true</allowCustomStatusMessages>
								</gui>
								<buddyviewableonly>false</buddyviewableonly>
							</userlist>
							<minichat>
								<useAnonymousScreenNames>false</useAnonymousScreenNames>
								<showUserCount>true</showUserCount>
								<showWatcherUserCount>true</showWatcherUserCount>
								<allowTextInput>false</allowTextInput>
								<allowRoomUserlist>false</allowRoomUserlist>
							</minichat>
							<webmessenger>
								<member>
									<displayname>Joe Schmoe</displayname>
									<imagepath>http://images.yourcompany.userplane.com/pathToUserImage.jpg</imagepath>
									<avEnabled>true</avEnabled>
									<kissSmackEnabled>true</kissSmackEnabled>
									<showerrors>true</showerrors>
									<sound>true</sound>
									<focus>true</focus>
									<autoOpenAV>false</autoOpenAV>
									<autoStartAudio>false</autoStartAudio>
									<autoStartVideo>false</autoStartVideo>
									<backgroundColor></backgroundColor>
									<fontColor></fontColor>
									<quickMessageList ignoreNoTextEntry="false">
										<message>
											<title>Standard Greeting</title>
											<body>I'm happy to be here!</body>
										</message>
									</quickMessageList>
									<noTextEntry>false</noTextEntry>
									<sessionTimeout>-1</sessionTimeout>
									<sessionTimeoutMessage>Your session has timed out</sessionTimeoutMessage>
								</member>
								<targetMember>
									<displayname>Jill Jackson</displayname>
									<line1>24</line1>
									<line2>Female</line2>
									<line3>San Francisco, CA</line3>
									<line4></line4>
									<imagepath>http://images.yourcompany.userplane.com/pathToUserImage.jpg</imagepath>
									<avEnabled>false</avEnabled>
									<blocked>false</blocked>
									<backgroundColor></backgroundColor>
									<fontColor></fontColor>
								</targetMember>
							</webmessenger>
							<boards>
								<gui>
									<viewprofile>true</viewprofile>
									<webmessenger>true</webmessenger>
									<rate>true</rate> <!--- rate buttons on / off --->
									<embed>true</embed> <!--- embed button on / off --->
									<branch>true</branch> <!--- branch button on / off --->
									<search>true</search> <!--- search tab on / off --->
									<watch>true</watch> <!--- watched threads tab and watch button on / off --->
									<help>true</help> <!--- help button on / off --->
									<link>true</link> <!--- link buttons on / off --->
									<addfriend>true</addfriend>
									<latestPosts>5</latestPosts> <!--- number of posts to show in the modules on the home state --->
									<activeThreads>5</activeThreads> <!--- number of threads to show in the modules on the home state --->
									<connectGreeting>Welcome to Boards!</connectGreeting>
									<profileData>
										<line label="Age">29</line>
										<line label="Sex">M</line>
										<line label="Location">Santa Monica</line>
									</profileData>
								</gui>
								<readOnly>false</readOnly>
								<adminForums>
									<forumID>2342</forumID>
									<forumID>765</forumID>
								</adminForums>
								<adminTopics>
									<topicID>323</topicID>
									<topicID>2451</topicID>
								</adminTopics>
								<restrictedForums allowRestricted="false">
									<forumID>5665</forumID>
									<forumID>765</forumID>
									<forumID>54543</forumID>
								</restrictedForums>
								<timeouts>
									<session>-1</session>
									<sessionMessage>Your session has expired.</sessionMessage>
									<inactivity>2</inactivity>
									<inactivityMessage>You were timed out due to inactivity.</inactivityMessage>
								</timeouts>
							</boards>
						</user>
					</cfoutput>
				</cfif>
			</cfloop>

		</cfcase>

		<cfcase value="onRoomStatusChange">
			<!--- This function is not on by default, use allowCalls in getDomainPreferences to turn it on --->
			<cfparam name="URL.roomName" default="">
			<cfparam name="URL.ownerID" default="">
			<cfparam name="URL.admin" default=""> <!--- boolean true or false whether room was created by admin --->
			<cfparam name="URL.exists" default=""> <!--- boolean true or false whether room exists or not --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="onUserConnectionChange">
			<!--- This function is not on by default, use allowCalls in getDomainPreferences to turn it on --->
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.connected" default=""> <!--- boolean true or false whether user is connected --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="onUserRoomChange">
			<!--- This function is not on by default, use allowCalls in getDomainPreference to turn it on --->
			<cfparam name="URL.roomName" default="">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.inRoom" default=""> <!--- boolean true or false whether user is in room --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="onLastUserDisconnect">
			<!--- This function is not on by default, use allowCalls in getDomainPreference to turn it on --->
			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="setBannedStatus">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.banned" default=""> <!--- boolean true or false whether userID has been banned by an admin --->
			<cfparam name="URL.info" default=""> <!--- if you're using a banOptions list (see getDomainPreferences), the info parameter will contain the text of the <option> tag (i.e "One Day") --->
			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="setBlockedStatus">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.blockedUserID" default="">
			<cfparam name="URL.blocked" default=""> <!--- boolean true or false whether userID has blockedUserID blocked --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="setFriendStatus">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.friendUserID" default="">
			<cfparam name="URL.friend" default=""> <!--- boolean true or false whether userID is adding or removing friendUserID from friend list --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="getAnnouncements">
			<!--- This function is not on by default, use getAnnouncementsInterval in getDomainPreferences to turn it on --->
			<announcementList>
				<announcement><![CDATA[<b>Site Notification:</b> There will be limbo in the leto lounge at 0200]]></announcement>
				<announcement><![CDATA[Check out our new <a href="newsPage.html" target="_blank">news section</a>]]></announcement>
			</announcementList>
		</cfcase>

		<cfcase value="getConfPhoneNumber">
			<cfparam name="URL.app" default="">
			<cfparam name="URL.conferenceID" default="">
			<!--- This function is not on by default, use allowCalls in getDomainPreferences to turn it on --->
			<confPhoneNumber><![CDATA[800-555-1212 x12345]]></confPhoneNumber>
		</cfcase>

		<cfcase value="reportAbuse">
			<!--- This function is not on by default, use reportAbuse in getDomainPreferences to turn it on --->
			<cfparam name="FORM.xmlData" default="">
			<!--- the incoming POST xmlData will look like this: --->
			<!---
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
			--->
		</cfcase>

		<cfcase value="sendArchive">
			<!--- This function is not on by default, use sendArchive in getDomainPreferences to turn it on --->
			<cfparam name="FORM.xmlData" default="">
			<!--- the incoming POST xmlData will look like this: --->
			<!---
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
			--->
		</cfcase>

		<cfcase value="sendConnectionList">
			<!--- This function is not on by default, use sendConnectionListInterval in getDomainPreferences to turn it on --->
			<cfparam name="FORM.xmlData" default="">
			<!--- the incoming POST xmlData will look like this: --->
			<!---
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
			--->
		</cfcase>

		<cfcase value="getVideoFilesToDelete">
			<cfoutput>
				<videoList>
					<user id="12345">
						<video status="new"><![CDATA[videoID1]]></video>
						<video status="approved"><![CDATA[videoID2]]></video>
						<video status="all"><![CDATA[videoID3]]></video>
					</user>
					<user id="34567"/> <!--- This will delete all videos for a particular user --->
					<user id="67890">
						<video status="approved"><![CDATA[videoID4]]></video>
					</user>
				</videoList>
			</cfoutput>
		</cfcase>

		<cfcase value="getVideos">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.videoIDs" default="">
			<cfparam name="URL.videoUserID" default="">
			<cfoutput>
				<!--- URL.videoIDs is a comma delimited list of videoIDs for the URL.videoUserID user --->

				<videoList>
					<cfloop list="#URL.videoIDs#" index="currentVideoID">
						<video>
							<videoID>#currentVideoID#</videoID> <!--- a unique identifier for this video --->
							<autoPlay>true</autoPlay> <!---Êset to true to play on startup --->
							<autoLoad>true</autoLoad> <!--- set to true to load on startup --->
							<startImage></startImage> <!--- the background image to display on startup -- if not passed, it will use the autogenerated thumbnail from the video. --->
							<title></title> <!---  the video title --->
							<description></description> <!---  a text description of the media --->
							<ownerUsername></ownerUsername> <!--- the username of the person who uploaded/recorded this video --->
							<viewCount>0</viewCount>
							<rankCount>0</rankCount>
							<rating>10</rating> <!--- the current rating (1-10) --->
							<tags></tags>	<!--- comma seperated list of tags --->
						</video>
					</cfloop>
				</videoList>
			</cfoutput>
		</cfcase>

		<cfcase value="getRecordingPreferences">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.videoID" default="">
			<cfparam name="URL.videoUserID" default="">
			<cfoutput>
				<video>
					<webAccessible>true</webAccessible> <!--- this is only for webrecorder calls --->
				</video>
			</cfoutput>
		</cfcase>

		<cfcase value="onVideoFileChange">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.videoID" default="">
			<cfparam name="URL.statusList" default="">
			<cfparam name="URL.error" default=""> <!--- if there was a problem with the recording or encoding --->

			<cfparam name="FORM.xmlData" default="">

			<!---
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
			--->

			<!--- Put your code here.  No need to return anything --->
		</cfcase>


		<cfcase value="startWebmessengerConversation">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.targetUserID" default="">

		</cfcase>

		<cfcase value="onWebmessengerConnectionClosed">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.targetUserID" default="">


			<!--- in addition, you can also use the FORM.xmlData variable to get any messages that were never delivered to the targetUser. --->
			<cfparam name="FORM.xmlData" default="">
		</cfcase>

		<cfcase value="sendPendingWebmessengerMessages">
			<cfparam name="URL.userID" default="">
			<cfparam name="URL.targetUserID" default="">

			<!--- Use the FORM.xmlData variable to get any messages that were never delivered to the targetUser. --->
			<cfparam name="FORM.xmlData" default="">
		</cfcase>

		<cfcase value="onForumStatusChange">
			<cfparam name="URL.forumID" default="">
			<cfparam name="URL.forumName" default="">
			<cfparam name="URL.userID" default=""> <!--- the userID of the person doing the add/edit or delete --->
			<cfparam name="URL.exists" default=""> <!--- boolean true or false whether add/edit or delete --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

		<cfcase value="onTopicStatusChange">
			<cfparam name="URL.topicID" default="">
			<cfparam name="URL.topicName" default="">
			<cfparam name="URL.userID" default=""> <!--- the userID of the person doing the add/edit or delete --->
			<cfparam name="URL.exists" default=""> <!--- boolean true or false whether add/edit or delete --->

			<!--- Handle this event, no need to return anything else --->

		</cfcase>

	</cfswitch>

</communicationsuite>


