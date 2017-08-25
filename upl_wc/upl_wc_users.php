<?php

function is_user_banned($uid) {
	global $wpdb;
	$result = $wpdb->get_results('select * from ' . $wpdb->prefix . 'upl_wc_banned_users where uid = ' . $wpdb->escape($uid));
	foreach($result as $ban) {
		$end = $ban->end;
		if ($end > time()) {
			return true;
		}
	}
	return false;
}

function user_chat_access($uid, $access) {
	require_once 'upl_wc_user_privileges.php';
	return upl_wc_user_privileges::have_user_privilege($uid, $access);
}

function get_buddies($uid) {
	global $wpdb;
	$uid = $wpdb->escape($uid);
	$sql = "select * from " . $wpdb->prefix . "upl_wc_buddy_users b inner join " . $wpdb->users . " u ON b.buddy_uid = u.ID and b.uid = $uid left outer join " . $wpdb->prefix . "upl_wc_users w on u.ID = w.user_id";
	return $wpdb->get_results($sql);
}

function get_blocked($uid) {
	global $wpdb;
	$uid = $wpdb->escape($uid);
	$sql = "select * from " . $wpdb->prefix . "upl_wc_blocked_users b where b.uid = $uid";
	return $wpdb->get_results($sql);
}

function get_admin_rooms($uid) {
	require_once 'upl_wc_admin_rooms.php';
	return upl_wc_admin_rooms::get_admin_rooms($uid);
}

function get_restricted_rooms($uid, $allow) {
	require_once 'upl_wc_restricted_rooms.php';
	return upl_wc_restricted_rooms::get_restricted_rooms($uid, $allow);
}

function add_chat_room($strRoomName, $description, $owner) {
	global $wpdb;
	$strRoomName = $wpdb->escape($strRoomName);
	$description = $wpdb->escape($description);
	$owner = $wpdb->escape($owner);
	$sql = "select count(rid) as count from " . $wpdb->prefix . "upl_wc_rooms where name = '$strRoomName'";
	$exists = $wpdb->get_row($sql);
	if ($exists->count > 0) {
		return;
	}
	$sql = 'insert into ' . $wpdb->prefix . 'upl_wc_rooms (name, description, creator_id) values ("' . $strRoomName . '", "' . $description . '", "' . $owner . '")';
	$wpdb->query($sql);
}

function remove_chat_room($strRoomName) {
	global $wpdb;
	$strRoomName = $wpdb->escape($strRoomName);
	$sql = "delete from " . $wpdb->prefix . "upl_wc_rooms where name = '$strRoomName'";
	$wpdb->query($sql);
}

function set_user_last_room($strUserID, $strRoomName) {
	global $wpdb;
	$strRoomName = $wpdb->escape($strRoomName);
	$strUserID = $wpdb->escape($strUserID);
	$sql = "select count(user_id) as count from " . $wpdb->prefix . "upl_wc_users where user_id = '$strUserID'";
	$exists = $wpdb->get_row($sql);
	if ($exists->count == 0) {
		$sql = 'insert into ' . $wpdb->prefix . 'upl_wc_users (user_id, sex, birth_day, birth_month, birth_year, last_room, location, avatar_name) 
				values ("' . $strUserID . '", 0, 1, 0, "1950", "' . $strRoomName . '", "", "")';
	} else {
		$sql = "update " . $wpdb->prefix . "upl_wc_users set last_room = '$strRoomName' where user_id = '$strUserID'";
	}
	$wpdb->query($sql);
}

function ban_user($uid, $start, $end) {
	global $wpdb;
	$uid = $wpdb->escape($uid);
	$sql = "insert into " . $wpdb->prefix . "upl_wc_banned_users (uid, end, start) values ('$uid', '$end', '$start')";
	$wpdb->query($sql);
}

function unban_user($uid) {
	global $wpdb;
	$uid = $wpdb->escape($uid);
	$sql = "delete from " . $wpdb->prefix . "upl_wc_banned_users where uid = '$uid'";
	$wpdb->query($sql);
}

	function date_add($interval, $number, $date) {
	    $date_time_array = getdate($date);
	    $hours = $date_time_array['hours'];
    	$minutes = $date_time_array['minutes'];
	    $seconds = $date_time_array['seconds'];
    	$month = $date_time_array['mon'];
	    $day = $date_time_array['mday'];
    	$year = $date_time_array['year'];

		if($interval == "") {
			 $hours += $number;
		}
		if($interval == get_chat_configuration("banOptions1", 'One Hour')) {
			 $hours += $number;
		}
		if($interval == get_chat_configuration("banOptions2", 'One Day')) {
			 $day += $number;
		}
		if($interval == get_chat_configuration("banOptions3", 'One Week')) {
			  $day += ($number * 7);
		}
		if($interval == get_chat_configuration("banOptions4", 'One Month')) {
			 $month += $number;
		}
		if($interval == get_chat_configuration("banOptions5", 'Forever')) {
			$year = 2036;
		}
		$timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
    	return $timestamp;
	}

?>