<?php
	require_once '../upl_common/upl_common_init_engine.php';
	require_once 'upl_wc_config.php';
	$configuration = upl_wc_config::get_chat_configuration();
	require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
	$strSessionGUID = upl_common_user::get_current_session();
	$strFlashcomServer = $configuration["wc_strflashcomserver"];
	$strDomainID = $configuration["wc_strdomainid"];
	$helpLink = $configuration["wc_helplink"];
	$user_id = upl_common_user::get_user_by_session_id($strSessionGUID);
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html;  charset=ISO-8859-1">
	<title>Userplane AV Webchat; Session ID=<?php echo( $strSessionGUID ); ?></title>

	<script language="JavaScript">
	<!--
		function csEvent( strEvent, strParameter1, strParameter2 ) {
			if( strEvent == "InstantCommunicator.StartConversation" ) {
				var strUserID = strParameter1;
				var bServer = strParameter2;
				// open up an InstantCommunicator window.  For example:
				launchWM( "<?php echo( $strSessionGUID ); ?>", strUserID );
			}
			else if( strEvent == "User.ViewProfile" ) {
				var strUserID = strParameter1;
				var selfID = <?php echo($user_id); ?>;
				if(selfID == strUserID) {
					myWindow = window.open("<?php echo(get_option('siteurl')); ?>/wp-admin/profile.php", "AboutWindow_" + strUserID, 'toolbar=1,directories=1,menubar=1,status=1,location=1,scrollbars=1,resizable=1');
				} else {
					myWindow = window.open("<?php echo(get_option('siteurl')); ?>/wp-admin/user-edit.php?user_id=" + strUserID, "AboutWindow_" + strUserID, 'toolbar=1,directories=1,menubar=1,status=1,location=1,scrollbars=1,resizable=1');
				}
			}
			else if( strEvent == "User.Block" ) {
				var strBlockedUserID = strParameter1;
				var bBlocked = strParameter2;
			}
			else if( strEvent == "User.AddFriend" )	{
				var strFriendUserID = strParameter1;
				var bFriend = strParameter2;
			}
			else if( strEvent == "Chat.Help" ) {
				myWindow = window.open("<?php 
					echo($helpLink); ?>", "Help", 'toolbar=1,directories=1,menubar=1,status=1,location=1,scrollbars=1,resizable=1');
			}
			else if( strEvent == "User.NoTextEntry" ) {
			}
			else if( strEvent == "Connection.Success" )	{
			}
			else if( strEvent == "Connection.Failure" ) { 
				if( strParameter1 == "Session.Timeout" ) { 
				} 
				if( strParameter1 == "User.Banned" ) {
				}
			}
		}
		
		function launchWM( userID, destinationUserID ) {
			var popupWindowTest = window.open( "<?php echo(get_option('siteurl')) ?>/wp-content/plugins/upl_wm/wm_ads.php?strDestinationUserID=" + destinationUserID, "WMWindow_" + replaceAlpha(userID) + "_" + replaceAlpha(destinationUserID), "width=468,height=595,toolbar=0,directories=0,menubar=0,status=0,location=0,scrollbars=0,resizable=1" );
			if( popupWindowTest == null ) {
				alert( "Your popup blocker stopped an IM window from opening" );
			}
		}
		
		function replaceAlpha( strIn ) {
			var strOut = "";
			for( var i = 0 ; i < strIn.length ; i++ )
			{
				var cChar = strIn.charAt(i);
				if( ( cChar >= 'A' && cChar <= 'Z' )
					|| ( cChar >= 'a' && cChar <= 'z' )
					|| ( cChar >= '0' && cChar <= '9' ) ) {
					strOut += cChar;
				}
				else {
					strOut += "_";
				}
			}
			return strOut;
		}
	//-->
	</script>
</head>
<body bgcolor="#ffffff" bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">
<?php
	if ($wm_installed && $password != '' && $presence_id != '') {
		require_once '../userplane_common/presence.php';
  		up_presence($presence_id, $password, $user_id, $wmURL);
	}
?>
	
<?php
	// Do not change anything below here
	$strSwfServer = "swf.userplane.com";
	$strApplicationName = "CommunicationSuite";
	$strLocale = "english";
?>

<script type="text/javascript" src="flashobject.js"></script>

<?php
//	The content of this div should hold whatever HTML you would like to show in the case that the 
//	user does not have Flash installed.  Its contents get replaced with the Flash movie for everyone
//	else.
?>
<div id="flashcontent">
	<strong>You need to upgrade your Flash Player by clicking <a href="http://www.macromedia.com/go/getflash/" target="_blank">this link</a>.</strong><br><br><strong>If you see this and have already upgraded we suggest you follow <a href="http://www.adobe.com/cfusion/knowledgebase/index.cfm?id=tn_14157" target="_blank">this link</a> to uninstall Flash and reinstall again.</strong>
</div>

<script type="text/javascript">
	// <![CDATA[
	
	var urlFlash = "http://<?php echo( $strSwfServer ); ?>/<?php echo( $strApplicationName ); ?>/ch.swf";
	var fo = new FlashObject(urlFlash, "ch", "100%", "100%", "6", "#ffffff", false, "best");
	fo.addParam("scale", "noscale");
	fo.addParam("menu", "false");
	fo.addParam("salign", "LT");
	fo.addParam("allowScriptAccess", "always");
	fo.addVariable("strServer", "<?php echo( $strFlashcomServer ); ?>");
	fo.addVariable("strSwfServer", "<?php echo( $strSwfServer ); ?>");
	fo.addVariable("strApplicationName", "<?php echo( $strApplicationName ); ?>");
	fo.addVariable("strDomainID", "<?php echo( $strDomainID ); ?>");
	fo.addVariable("strSessionGUID", "<?php echo( $strSessionGUID ); ?>");
	fo.addVariable("strKey", "<?php echo( $strKey ); ?>");
	fo.addVariable("strLocale", "<?php echo( $strLocale ); ?>");
	fo.addVariable("strInitialRoom", "<?php echo( $strInitialRoom ); ?>");
	fo.write("flashcontent");
	
	// COPYRIGHT Userplane 2006 (http://www.userplane.com)
	// CS version 1.9.4
	
	// ]]>
</script>

</body>
</html>
