<?php
	// You need to set these variables to be appropriate for your site and user.  Some will be provided by Userplane during account setup
	// If you have not received these values yet please contact Userplane at support@userplane.com or call (323) 938-4401
	require_once '../upl_common/upl_common_init_engine.php';
	require_once 'upl_wm_config.php';
	require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
	$configuration = upl_wm_config::get_wm_configuration();
	$strSessionGUID = upl_common_user::get_current_session();
	$strFlashcomServer = $configuration["wm_strflashcomserver"];
	$strDomainID = $configuration["wm_strdomainid"];
	$helpLink = $configuration["wm_helplink"];

	$uid = upl_common_user::get_user_by_session_id($strSessionGUID);								// The session identifier for the currently logged in user
	$strKey = "";													// Additional login information you may need passed
	
	// You will need to work on the sendCommand JavaScript function a few lines down to respond to any user clicks as you deem necessary
	
	$strDestinationUserID = $_GET["strDestinationUserID"];
?>

<html>
<head>
	<meta http-equiv=Content-Type content="text/html;  charset=ISO-8859-1">
	<title>Peeps Central Chat&#8482; Webmessenger</title>

	<script language="JavaScript">
	<!--
		function sendCommand( commandIn, valueIn )
		{
			if( commandIn == "focus" )
			{
				// DO NOT EDIT
			
				var wmObject = getWMObject();
				// only do the focus if we are sure it is not going remove focus from typing area
				if( wmObject != null && ( wmObject.focus != undefined || ( navigator.userAgent.indexOf( "MSIE" ) >= 0 && navigator.userAgent.indexOf( "Mac" ) >= 0 ) ) )
				{
					window.focus();
					wmObject.focus();
				}
			}
			else
			{
				// EDIT HERE: you will need to handle the following commands from the wm client
				if( commandIn == "viewProfile" )
				{
					var userID = valueIn;
					if( valueIn == "-1" ) {
						userID = <?php echo $uid; ?>;
						myWindow = window.open("<?php echo(get_option('siteurl')); ?>/wp-admin/profile.php", "AboutWindow_" + userID, 'toolbar=1,directories=1,menubar=1,status=1,location=1,scrollbars=1,resizable=1');
					} else {
						myWindow = window.open("<?php echo(get_option('siteurl')); ?>/wp-admin/user-edit.php?user_id=" + userID, "AboutWindow_" + userID, 'toolbar=1,directories=1,menubar=1,status=1,location=1,scrollbars=1,resizable=1');
					}
				}
				else if( commandIn == "help" )
				{
					var url = '<?php echo $helpLink; ?>';
					myWindow = window.open(url, 'Help', 'toolbar=1,directories=1,menubar=1,status=1,location=1,scrollbars=1,resizable=1');
				}
				else if( commandIn == "buddyList" )
				{
					// view their buddy list
				}
				else if( commandIn == "preferences" )
				{
					// view the preferences
				}
				else if( commandIn == "addBuddy" )
				{
					var userID = valueIn;
					// respond to an add buddy click (XML has also been notified)
				}
				else if( commandIn == "block" )
				{
					// they blocked the user
				}
				else if( commandIn == "unblock" )
				{
					// they unblocked the user
				}
				else if( commandIn == "Connection.Success" )
				{
					// client successfully connected to server
				}
				else if( commandIn == "Connection.Failure" )
				{
					// client was disconnected from server
				}	
				else if( commandIn == "Game.Open" ) 
				{ 
					openGameWindow( valueIn ); 
				} 				
			}
		}
		
		function focusIt()
		{
			window.focus();
		
			var wmObject = getWMObject();
			
			if( wmObject != null && wmObject.focus != undefined )
			{
				wmObject.focus();
			}
		}
		
		function getWMObject()
		{
			if(document.all)
			{
				return document.all["wm"];
			}
			else if(document.layers)
			{
				return document.wm;
			}
			else if(document.getElementById)
			{
				return document.getElementById("wm");
			}
			
			return null;
		}
		
		function wm_DoFSCommand( command, args ) 
		{
		}
		function openGameWindow( qs ) 
		{ 
			var newWindow = window.open("http://www.userplane.com/chatlite/games/?" + qs,"game","width=600,height=555,scrollbars=yes,resizable=yes,menubar=yes,location=no,status=no,directories=no,toolbar=no"); 

			if (newWindow == null) 
			{ 
				alert( "Your popup blocker stopped the game window from opening" ); 
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
	
	<script language="VBScript">
	<!-- 
		//  Map VB script events to the JavaScript method - Netscape will ignore this... 
		//  Since FSCommand fires a VB event under ActiveX, we respond here 
		Sub wm_FSCommand(ByVal command, ByVal args)
	  		call wm_DoFSCommand(command, args)
		end sub
	-->
	</script>
</head>
<body onLoad="javascript: focusIt();" bgcolor="#ffffff" bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">

	<?php
		if( $strDestinationUserID != "" )
		{
			$strSwfServer = "swf.userplane.com";
			$strApplicationName = "Webmessenger";
			$strLocale = "english";
			?>
		
			<script type="text/javascript" src="flashobject.js"></script>
			
			<!--- 
				The content of this div should hold whatever HTML you would like to show in the case that the 
				user does not have Flash installed.  Its contents get replaced with the Flash movie for everyone
				else.
			--->
			<div id="flashcontent">
				<strong>You need to upgrade your Flash Player by clicking <a href="http://www.macromedia.com/go/getflash/" target="_blank">this link</a>.</strong><br><br><strong>If you see this and have already upgraded we suggest you follow <a href="http://www.adobe.com/cfusion/knowledgebase/index.cfm?id=tn_14157" target="_blank">this link</a> to uninstall Flash and reinstall again.</strong>
			</div>

			<script type="text/javascript">
				// <![CDATA[
				
				var fo = new FlashObject("http://<?php echo( $strSwfServer ); ?>/<?php echo( $strApplicationName ); ?>/ic.swf", "wm", "100%", "100%", "6", "#ffffff", false, "best");
				fo.addParam("scale", "noscale");
				fo.addParam("menu", "false");
				fo.addParam("salign", "LT");
				fo.addParam("allowScriptAccess", "always");
				fo.addVariable("server", "<?php echo( $strFlashcomServer ); ?>");
				fo.addVariable("swfServer", "<?php echo( $strSwfServer ); ?>");
				fo.addVariable("applicationName", "<?php echo( $strApplicationName ); ?>");
				fo.addVariable("domainID", "<?php echo( $strDomainID ); ?>");
				fo.addVariable("sessionGUID", "<?php echo( $strSessionGUID ); ?>");
				fo.addVariable("key", "<?php echo( $strKey ); ?>");
				fo.addVariable("locale", "<?php echo( $strLocale ); ?>");
				fo.addVariable("destinationMemberID", "<?php echo( $strDestinationUserID ); ?>");
				fo.addVariable("resizable", "true");
				fo.write("flashcontent");
				
				// COPYRIGHT Userplane 2006 (http://www.userplane.com)
				// WM version 1.8.13
				
				// ]]>
			</script>
			
			<?php
		}
	?>		 
	
</div>

</body>
</html>
