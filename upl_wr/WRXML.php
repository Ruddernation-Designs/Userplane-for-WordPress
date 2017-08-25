<?php

	header( "Content-Type: text/xml; charset=utf-8" );

	

	echo( "<?xml version='1.0' encoding='utf-8'?>" );

	echo( "<!-- COPYRIGHT Userplane 2004 (http://www.userplane.com) -->" );

	echo( "<!-- WR version 1.5.0 -->" );

	echo( "<vrappserver>" );



	$strDomainID = isset($_GET['domainID']) ? $_GET['domainID'] : null;

	$strFunction = isset($_GET['function']) ? $_GET['function'] : (isset($_GET['action']) ? $_GET['action'] : null);

	$strCallID = isset($_GET['callID']) ? $_GET['callID'] : null;



	if( $strFunction != null && $strDomainID != null ) {

	

	function get_recorder_configuration($name, $default) {

		global $configuration;

		$name = strtolower($name);

		$name = 'wr_' . $name;

		if(key_exists($name, $configuration)) {

			return $configuration[$name];

		} else {

			return $default;

		}

	}



		if( $strFunction == "getAdminIPAddresses" ) {

				require_once '../upl_common/upl_common_init_engine.php';

				require_once 'upl_wr_config.php';

				global $configuration;

				$configuration = upl_wr_config::get_wr_configuration();



			$ips = get_recorder_configuration("adminsips", '');

			$ipsList = split("\r\n", $ips);

			while(list($i, $ip) = each($ipsList)) {

				if($ip != '') {

					echo( "<adminip>$ip</adminip>" );

				}

			}

		}



		else if( $strFunction == "getDeletedRecordings" ) {

				require_once '../upl_common/upl_common_init_engine.php';

				require_once 'upl_wr_records.php';

				

			$result = upl_wr_records::get_deleted_records();

			foreach ($result as $record) {

				echo( "<memberID recordingName=\"" . $record->name . "\" status=\"" . 'all' . "\">" . $record->uid . "</memberID>" );

			}

		}



		else if( $strFunction == "getDomainPreferences" ) {

				require_once '../upl_common/upl_common_init_engine.php';

				require_once 'upl_wr_config.php';

				global $configuration;

				$configuration = upl_wr_config::get_wr_configuration();

			echo( "<allowCalls>getMemberID,getDeletedRecordings,notifyRecordingChange,getAdminIPAddresses,sendRecordingList</allowCalls>" );

			echo( "<maxXMLRetries>" . get_recorder_configuration('maxxmlretries', 10) . "</maxXMLRetries>" );

			echo( "<maxrecordseconds>" . get_recorder_configuration('maxrecordseconds', 30) . "</maxrecordseconds>" );

			echo( "<autoApprove>" . ($configuration['wr_autoApprove'] == 0 ? 'false' : 'true') . "</autoApprove>" );

			echo( "<sendRecordingListInterval>" . get_recorder_configuration('sendRecordingListInterval', 0) . "</sendRecordingListInterval>" );

			echo( "<noVideoImage>" . get_recorder_configuration('noVideoImage', '') . "</noVideoImage>" );

			echo( "<videoNotEnabledImage>" . get_recorder_configuration('videoNotEnabledImage', '') . "</videoNotEnabledImage>" );

		}



		else if( $strFunction == "getMemberID" ) {

			$strSessionGUID = isset($_GET['sessionGUID']) ? $_GET['sessionGUID'] : null;

			$strKey = isset($_GET['key']) ? $_GET['key'] : null;

		

			if( $strSessionGUID != null ) {

				require_once '../upl_common/upl_common_init_engine.php';

				require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');

				require_once 'upl_wr_config.php';

				global $configuration;

				$configuration = upl_wr_config::get_wr_configuration();



				$uid = upl_common_user::get_user_by_session_id($strSessionGUID);

				if(isset($uid)) {

					echo( "<memberid>" . $uid . "</memberid>" );

					echo( "<admin>" . (upl_common_user::is_admin($uid) == 0 ? 'false' : 'true') . "</admin>" );

					echo( "<videoEnabled>" . (get_recorder_configuration('videoEnabled', 0) == 0 ? 'false' : 'true') . "</videoEnabled>" );

					echo( "<audioKbps>" . get_recorder_configuration('chat_audioKbps', 10) . "</audioKbps>" );

					echo( "<videoKbps>" . get_recorder_configuration('chat_videoKbps', 100) . "</videoKbps>" );

					echo( "<videoFps>" . get_recorder_configuration('chat_videoFps', 15) . "</videoFps>" );

					echo( "<videoSize>" . (get_recorder_configuration('chat_videoSize', 0)) . "</videoSize>" );

				} else {

					echo( "<memberid>INVALID</memberid>" );

				}

			}

		}



		else if( $strFunction == "notifyRecordingChange" ) {

			$strMemberID = isset($_GET['memberID']) ? $_GET['memberID'] : null;

			$strStatus = isset($_GET['status']) ? $_GET['status'] : null;

			$bExists = isset($_GET['exists']) ? $_GET['exists'] : null;

			$bExists = $bExists == "true" || $bExists == "1";

			$recordingName = isset($_GET['recordingName']) ? $_GET['recordingName'] : null;

		

			if( $strMemberID != null && $strStatus != null && $recordingName != null) {

				require_once '../upl_common/upl_common_init_engine.php';

				require_once 'upl_wr_records.php';

				upl_wr_records::update_record_status($strMemberID, $recordingName, $strStatus, $bExists);

			}

		}



		else if( $strFunction == "sendRecordingList" ) {

			$strXmlData = isset($_POST['xmlData']) ? stripslashes($_POST['xmlData']) : null;

			if( $strXmlData != null ) {

				require_once '../upl_common/upl_common_init_engine.php';

				require_once 'upl_wr_records.php';

				upl_wr_records::update_records_list($strXmlData);

			}

		}

	}

	

	echo( "</vrappserver>" );

?>

