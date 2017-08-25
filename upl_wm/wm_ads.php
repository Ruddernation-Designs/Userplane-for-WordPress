<?php

 

	$strDestinationUserID = $_GET["strDestinationUserID"];

 

	require_once '../upl_common/upl_common_init_engine.php';

	require_once 'upl_wm_config.php';

	$configuration = upl_wm_config::get_wm_configuration();

	$banner_zone_id = $configuration["wm_banner_zone_id"];

	$text_zone_id = $configuration["wm_text_zone_id"];

	

	if ($banner_zone_id == "" || $text_zone_id == "") {

		$out = "<frameset rows='*' framespacing='0' frameborder='no' border='0'>

					<frame src='wm.php?strDestinationUserID=" . $_GET["strDestinationUserID"] . "
  'name='Webmessenger_Frame'  scrolling='NO' noresize>

				</frameset>";
				
	} else {

		$out = "<frameset rows='*,108' framespacing='0' frameborder='no' border='0'>

					<frame src='wm.php?strDestinationUserID=" . $_GET["strDestinationUserID"] . "' name='Webmessenger_Frame'  scrolling='NO' noresize>

					<frame src='http://subtracts.userplane.com/mmm/bannerstorage/ch_int_frameset.html?app=wm&zoneID=" . $banner_zone_id . "&textZoneID=" . $text_zone_id ."' name='Ad_Frame' scrolling='NO' noresize>

				</frameset>";

	}

	echo($out);

?>

