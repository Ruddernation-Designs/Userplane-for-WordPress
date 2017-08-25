<?php
	require_once '../upl_common/upl_common_init_engine.php';
	require_once 'upl_wc_config.php';
	$configuration = upl_wc_config::get_chat_configuration();
	$banner_zone_id = $configuration["wc_banner_zone_id"];
	$text_zone_id = $configuration["wc_text_zone_id"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
	<meta http-equiv=Content-Type content="text/html;  charset=ISO-8859-1">
	<title>Greetings And Welcome To Peeps Central Chat&#8482;</title>
</head>

<?php
	if ($banner_zone_id == "" || $text_zone_id == "") {
		$out = "<frameset rows='*' framespacing='0' frameborder='no' border='0'>
					<frame src='wc.php' name='Webchat_Frame' scrolling='NO' noresize>
				</frameset>";
	} else {
		$out = "<frameset rows='*,145' framespacing='0' frameborder='no' border='0'>
					<frame src='wc.php' name='Webchat_Frame' scrolling='NO' noresize>
					<frame src='http://subtracts.userplane.com/mmm/bannerstorage/ch_int_frameset.html?app=wc&zoneID=" . $banner_zone_id . "&textZoneID=" . $text_zone_id ."' name='Ad_Frame' scrolling='NO' noresize>
				</frameset>";
	}
	echo($out);
?>

</HTML>
