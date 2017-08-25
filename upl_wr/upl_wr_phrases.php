<?php

global $CONFIG_PHRASES;

$CONFIG_PHRASES['wr.paramblock.wrupl'] = 'Userplane settings';
$CONFIG_PHRASES['wr.param.wr_strflashcomserver'] = 'Flashcom Server';
$CONFIG_PHRASES['wr.paramd.wr_strflashcomserver'] = 'This is the flashcom server you are connecting to. You will have one server per account and can have many domainID’s all running on the same flashcom server.';
$CONFIG_PHRASES['wr.param.wr_strdomainid'] = 'Domain ID';
$CONFIG_PHRASES['wr.paramd.wr_strdomainid'] = 'This specifies to our application server the URL to your CSXML file. This will be assigned by Userplane and will correspond to the domain that you are running Webrecorder on.';
$CONFIG_PHRASES['wr.param.wr_banner_zone_id'] = 'Zone ID';
$CONFIG_PHRASES['wr.paramd.wr_banner_zone_id'] = 'Zone ID for Userplane Ad.';
//$CONFIG_PHRASES['wr.param.wr_text_zone_id'] = 'Text zone ID';
//$CONFIG_PHRASES['wr.paramd.wr_text_zone_id'] = 'Zone ID for Userplane Ad.';

$CONFIG_PHRASES['wr.paramblock.wrsys'] = 'Recorder system settings';
$CONFIG_PHRASES['wr.param.wr_maxxmlretries'] = 'Max XML retries';
$CONFIG_PHRASES['wr.paramd.wr_maxxmlretries'] = 'How many times should a call to your XML be allowed to fail before it gives up. The default is 0 which means that the calls will continue indefinitely.';
$CONFIG_PHRASES['wr.param.wr_sendrecordinglistinterval'] = 'Send recording list interval';
$CONFIG_PHRASES['wr.paramd.wr_sendrecordinglistinterval'] = 'How often (in hours) the sendRecordingList XML function should be called. Set to 0 for never.';
$CONFIG_PHRASES['wr.param.wr_maxrecordseconds'] = 'Max record seconds';
$CONFIG_PHRASES['wr.paramd.wr_maxrecordseconds'] = ' 	 The maximum length of a new recording (in seconds).';
$CONFIG_PHRASES['wr.param.wr_autoApprove'] = 'Auto approve';
$CONFIG_PHRASES['wr.paramd.wr_autoApprove'] = 'If you would like your site to not require an admin to approve, set this value to true. Otherwise, set it to false.';
$CONFIG_PHRASES['wr.param.wr_novideoimage'] = 'No video image (optional)';
$CONFIG_PHRASES['wr.paramd.wr_novideoimage'] = 'A URL to an image that is to show when a recording contains no video. If you do not include this parameter, the interface will show a default message.';
$CONFIG_PHRASES['wr.param.wr_videonotenabledimage'] = 'Video not enabled image (optional)';
$CONFIG_PHRASES['wr.paramd.wr_videonotenabledimage'] = 'A URL to an image that is to show when a user has videoEnabled set to false in the getMemberID function call. If you do not include this parameter, the interface will show a default message.';
$CONFIG_PHRASES['wr.param.wr_adminsips'] = 'List of the administrator IP addresses:';
$CONFIG_PHRASES['wr.paramd.wr_adminsips'] = 'You can authenticate additional users by IP address. This function should return a list of IP addresses that admins can connect from to administer recordings. Only admins via getMemberID and users connected to IP addresses returned in this list will be able to connect via the administration player. One IP address per line.';

$CONFIG_PHRASES['wr.paramblock.wravs'] = 'Users AV settings';
$CONFIG_PHRASES['wr.param.wr_videoenabled'] = 'Video enabled';
$CONFIG_PHRASES['wr.paramd.wr_videoenabled'] = 'True or false depending on whether or not the user can use video.';
$CONFIG_PHRASES['wr.param.wr_chat_audiokbps'] = 'Audio kbps';
$CONFIG_PHRASES['wr.paramd.wr_chat_audiokbps'] = 'This is the bandwidth allotted for audio recording, which is in kilobits per second.';
$CONFIG_PHRASES['wr.param.wr_chat_videokbps'] = 'Video kbps';
$CONFIG_PHRASES['wr.paramd.wr_chat_videokbps'] = 'This is the bandwidth allotted for video recording, which is in kilobits per second. Recommended range: 10 – 200.';
$CONFIG_PHRASES['wr.param.wr_chat_videofps'] = 'Video fps';
$CONFIG_PHRASES['wr.paramd.wr_chat_videofps'] = 'Frames per second. Acceptable range: 1 – 30.';
$CONFIG_PHRASES['wr.param.wr_chat_videosize'] = 'Video size';
$CONFIG_PHRASES['wr.paramd.wr_chat_videosize'] = 'The size refers to the image captured by the camera, not the size of the video area in the user interface.';

?>