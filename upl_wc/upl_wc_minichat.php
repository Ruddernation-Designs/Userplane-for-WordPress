<?php

class upl_wc_minichat {
	
	public function escape($string) {
		$value = preg_replace('/\n/', '\\n', $string);
		$value = preg_replace('/\r/', '', $value);
		return $value;
	}
	
	public function show_minichat_for_guests() {
		?>
<script type="text/javascript">
var randomnumber=Math.floor(Math.random()*5000);
var embed = '<embed src="http://swf.userplane.com/CommunicationSuite/mc.swf" width="100%" height="250" quality="best" bgcolor="#FFFFFF" menu="0" name="mc" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="strServer=flashcom.damntough.userplane.com&strSwfServer=swf.userplane.com&strDomainID=damntough.com&strApplicationName=CommunicationSuite&strSessionGUID=Wiki_Guest_' + randomnumber + '&strBgColor=&strFgColor=&strConvBgColor=&strConvBorColor&strConvLinkColor="><br><iframe src="http://subtracts.userplane.com/mmm/bannerstorage/ch_int_textad_r.html?app=wc&zoneID=1366&clickID=a20e44fa" name="Text_Ad" scrolling="NO" width="100%" height="22" frameborder="0"></iframe>'
document.write(embed);
</script>		
		<?php
	}
	
	public function show_minichat($guest, $path_to_upl_wc) {
		require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
		require_once 'upl_wc_config.php';
		$configuration = upl_wc_config::get_chat_configuration();
		if ($guest) {
			$randval = rand(1, 5000);
			$strSessionGUID = "Guest_$randval";
			$configuration["wc_showMinichatRoomName"] = 0;
			$configuration["wc_showMinichatDescription"] = 0;
			$strInstanceID = "";
		} else {
//			$strSessionGUID = "minichat_" . upl_common_user::get_current_session();
			$strSessionGUID = upl_common_user::get_current_session();
			$strInstanceID = "upedge_default";
		}
		$strSwfServer = "swf.userplane.com";
		$strApplicationName = "CommunicationSuite";
		$strFlashcomServer = $configuration['wc_strflashcomserver'];
		$strDomainID = $configuration['wc_strdomainid'];
		$strKey = "";
		$strUpdateRedirectURL = 'mc.php';
		
?>
<script type="text/javascript">
<!--
		function csEvent( strEvent, strParameter1, strParameter2, cssID ) {
			if( strEvent == "InstantCommunicator.StartConversation" ) {
				var strUserID = strParameter1;
				var bServer = strParameter2;
				// open up an InstantCommunicator window.  For example:
				//launchWM( "<?php echo ($strSessionGUID) ?>", strUserID );
			}
			else if( strEvent == "User.ViewProfile" ) {
				var strUserID = strParameter1;
			}
			else if( strEvent == "User.Block" )	{
				var strBlockedUserID = strParameter1;
				var bBlocked = strParameter2;
			}
			else if( strEvent == "User.AddFriend" )	{
				var strFriendUserID = strParameter1;
				var bFriend = strParameter2;
			}
			else if( strEvent == "Chat.Help" ) {
			}
			else if( strEvent == "User.NoTextEntry" ) {
			}
			else if( strEvent == "Minichat.LaunchWebchat" ) {
				var popupWindowTest = window.open("<?php echo (get_option('siteurl')); ?>/wp-content/plugins/upl_wc/chat.php", "Userplane_Chat", "width=800,height=500,toolbar=0,directories=0,menubar=0,status=0,location=0,scrollbars=0,resizable=1" );
			}
			else if( strEvent == "Connection.Success" ) {
			}
			else if( strEvent == "Connection.Failure" )	{
				if( strParameter1 == "Session.Timeout" ) {
					//handle timeout here, both inactivity and session timeouts
				}
				if( strParameter1 == "User.Banned" ) {
					//handle ban event here
				}
			}
		}
		
		function getLocaleData( cssID )	{
			var data = new Object();
				data.userMessageSentMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_userMessageSentMessage"])); ?>";
				data.userJoinNotificationMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_userJoinNotificationMessage"])); ?>";
				data.userLeaveNotificationMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_userLeaveNotificationMessage"])); ?>";
				data.userNameChangeNotificationMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_userNameChangeNotificationMessage"])); ?>";
				data.textAdvertisementMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_textAdvertisementMessage"])); ?>";
				data.userNotAuthorizedErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_userNotAuthorizedErrorMessage"])); ?>";
				data.serverLicenseErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_serverLicenseErrorMessage"])); ?>";
				data.userBanNoticeErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_userBanNoticeErrorMessage"])); ?>";
				data.clientVersionErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_clientVersionErrorMessage"])); ?>";
				data.serverMaxUsersErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_serverMaxUsersErrorMessage"])); ?>";
				data.whisperSentMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_whisperSentMessage"])); ?>";
				data.whisperNotSentMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_whisperNotSentMessage"])); ?>";
				data.whisperReceivedMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_whisperReceivedMessage"])); ?>";
				data.whisperPersonalMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_whisperPersonalMessage"])); ?>";
				data.floodControlSlowDownMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_floodControlSlowDownMessage"])); ?>";
				data.floodControlResumeMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_floodControlResumeMessage"])); ?>";
				data.historyNotificationMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_historyNotificationMessage"])); ?>";
				data.whisperHowToMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_whisperHowToMessage"])); ?>";
				data.serverNoAdminErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_serverNoAdminErrorMessage"])); ?>";
				data.invalidDomainErrorMessage = "<?php echo (upl_wc_minichat::escape($configuration["wc_invalidDomainErrorMessage"])); ?>";

			if( cssID == "mc" )	{
				data.userJoinNotificationMessage = "<?php echo ($configuration["wc_userJoinNotificationMessage"]); ?>";
				data.userLeaveNotificationMessage = "<?php echo ($configuration["wc_userLeaveNotificationMessage"]); ?>";
				data.userCountLabel = "<?php echo ($configuration["wc_userCountLabel"]); ?>";
				data.watcherCountLabel = "<?php echo ($configuration["wc_watcherCountLabel"]); ?>";
				data.copyrightText = "<?php echo ($configuration["wc_copyrightText"]); ?>";
			}
			return data;
		}

		function getPreferences( cssID ) {
			var data = new Object();
			if( cssID == "mc" )	{
				data.useTimestamps = <?php echo(($configuration["wc_useTimestamps"] == 1) ? 'true' : 'false'); ?>;
				data.branding = "<?php echo ($configuration["wc_branding"]); ?>";
				data.brandingOpacity = <?php echo ($configuration["wc_brandingOpacity"]); ?>;
				data.chatButtonLabel = "<?php echo ($configuration["wc_chatButtonLabel"]); ?>";
				data.sendMessageButtonLabel = "<?php echo ($configuration["wc_sendMessageButtonLabel"]); ?>";
				data.showMinichatFooter = <?php echo(($configuration["wc_showMinichatFooter"] == 1) ? 'true' : 'false'); ?>;
				data.minichatBuddyPicURL = "<?php echo ($configuration["wc_minichatBuddyPicURL"]); ?>";
				data.showMinichatBuddyPic = <?php echo(($configuration["wc_showMinichatBuddyPic"] == 1) ? 'true' : 'false'); ?>;
				data.showMinichatDescription = <?php echo(($configuration["wc_showMinichatDescription"] == 1) ? 'true' : 'false'); ?>;
				data.showMinichatRoomName = <?php echo(($configuration["wc_showMinichatRoomName"] == 1) ? 'true' : 'false'); ?>;
				data.minichatBuddyPicMaxWidth = <?php echo ($configuration["wc_minichatBuddyPicMaxWidth"]); ?>;
				data.minichatBuddyPicMaxHeight = <?php echo ($configuration["wc_minichatBuddyPicMaxHeight"]); ?>;
				data.minichatBackgroundColor = "<?php echo ($configuration["wc_minichatBackgroundColor"]); ?>";
				data.minichatForegroundColor = "<?php echo ($configuration["wc_minichatForegroundColor"]); ?>";
				data.minichatConversationBackgroundColor = "<?php echo ($configuration["wc_minichatConversationBackgroundColor"]); ?>";
				data.minichatConversationBorderColor = "<?php echo ($configuration["wc_minichatConversationBorderColor"]); ?>";
			}
			return data;
		}
-->
</script>
<div style="height:250px">
	<script type="text/javascript" src="<?php echo $path_to_upl_wc; ?>flashobject.js"></script>
	<!---
		The content of this div should hold whatever HTML you would like to show in the case that the
		user does not have Flash installed.  Its contents get replaced with the Flash movie for everyone
		else.
	--->
	<div id="flashcontent" style="height:250px">
		<strong>You need to upgrade your Flash Player by clicking <a href="http://www.macromedia.com/go/getflash/" target="_blank">this link</a>.</strong><br><br><strong>If you see this and have already upgraded we suggest you follow <a href="http://www.adobe.com/cfusion/knowledgebase/index.cfm?id=tn_14157" target="_blank">this link</a> to uninstall Flash and reinstall again.</strong>
	</div>

	<script type="text/javascript">
		// <![CDATA[

		var fo = new FlashObject("http://<?php echo ($strSwfServer); ?>/<?php echo ($strApplicationName); ?>/mc.swf", "mc", "100%", "100%", "9", "#ffffff", false, "best");
		fo.addParam("scale", "noscale");
		fo.addParam("menu", "false");
		fo.addParam("salign", "LT");
		fo.addParam("allowScriptAccess", "always");
		fo.addVariable("strServer", "<?php echo ($strFlashcomServer); ?>");
		fo.addVariable("strSwfServer", "<?php echo ($strSwfServer); ?>");
		fo.addVariable("strApplicationName", "<?php echo ($strApplicationName); ?>" );
		fo.addVariable("strDomainID", "<?php echo ($strDomainID); ?>" );
		fo.addVariable("strInstanceID", "<?php echo ($strInstanceID); ?>" );
		fo.addVariable("strSessionGUID", "<?php echo ($strSessionGUID); ?>" );
		fo.addVariable("strKey", "<?php echo ($strKey); ?>" );
		fo.addVariable("strCssID", "mc");
		fo.useExpressInstall('expressinstall.swf');
  		fo.setAttribute('xiRedirectUrl', "<?php echo ($strUpdateRedirectURL); ?>");
		fo.write("flashcontent");

		// COPYRIGHT Userplane 2006 (http://www.userplane.com)
		// CS version 2.0.2

		// ]]>
	</script>
	
</div>
<?php
	$zoneID = $configuration['wc_mini_zone_id'];
		if ($zoneID != '') {
?>
			<iframe src="http://subtracts.userplane.com/mmm/bannerstorage/ch_int_textad_r.html?app=wc&zoneID=<?php echo __($zoneID); ?>&clickID=a20e44fa" name="Text_Ad" scrolling="NO" width="100%" height="22" frameborder="0"></iframe>
<?php
		}

		
	}
	
}

?>