<?php

class upl_common_user {
	
	public function get_current_session() {
		wp_get_current_user();
		global $user_ID;
//		$secret = get_option('secret');
//		return upl_common_user::get_encrypted($secret, $user_ID);
		return md5($user_ID);
	}
	
	public function is_admin($uid=null) {
		if ($uid == null) {
			return current_user_can('manage_options');
		}
		$user = new WP_User($uid);
		if ( empty($user) ) {
			return false;
		}
		return $user->has_cap('manage_options');	
	}
	
	public function get_user_by_session_id($session_id) {
		global $wpdb;
		$sql = "SELECT ID FROM " . $wpdb->users;
		$users = $wpdb->get_results($sql);
		foreach ($users as $user) {
			$sid = md5($user->ID);
			if($sid == $session_id) {
				return $user->ID;
			}
		}
		return null;
//		$secret = get_option('secret');
//		return upl_common_user::get_decrypted($secret, $session_id);		
	}
	
	public function get_user_with_user_id($uid) {
		global $wpdb;
		$sql = "SELECT * FROM " . $wpdb->users . " u left outer join " . $wpdb->prefix . "upl_wc_users w on u.ID = w.user_id where u.ID = " . $wpdb->escape($uid);
		return $wpdb->get_row($sql);
	}
	
	public function get_user_chat_icon($pic, $tag) {
		if ($pic == '') {
			return '';
		}
                 $arg=array('item_id'		=>$pic,
                            'object'		=> "user",	// user/group/blog/custom type (if you use filters)
                            'type'		=> "thumbnail",	// thumb or full,
                            
                        'html'=>false);
                 if($tag=="fullsize")
                     $arg["type"]="full";
		return "<$tag>" .bp_core_fetch_avatar($arg). "</$tag>";
	}
	
	public function add_buddy($uid, $buddy_uid) {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$buddy_uid = $wpdb->escape($buddy_uid);
		$sql = "select count(bid) as count from " . $wpdb->prefix . "upl_wc_buddy_users where uid = '$uid' and buddy_uid = '$buddy_uid'";
		$exists = $wpdb->get_row($sql);
		if ($exists->count > 0) {
			return;
		}
		$sql = 'insert into ' . $wpdb->prefix . 'upl_wc_buddy_users (uid, buddy_uid) values ("' . $uid . '", "' . $buddy_uid . '")';
		$wpdb->query($sql);
	}

	public function remove_buddy($uid, $buddy_uid) {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$buddy_uid = $wpdb->escape($buddy_uid);
		$sql = "delete from " . $wpdb->prefix . "upl_wc_buddy_users where uid = '$uid' and buddy_uid = '$buddy_uid'";
		$wpdb->query($sql);
	}
	
	public function is_user_blocked($strUserID, $strTargetUserID) {
		global $wpdb;
		$strUserID = $wpdb->escape($strUserID);
		$strTargetUserID = $wpdb->escape($strTargetUserID);
		$sql = "select count(bid) as count from " . $wpdb->prefix . "upl_wc_blocked_users where uid = '$strUserID' and blocked_uid = '$strTargetUserID'";
		$exists = $wpdb->get_row($sql);
		return ($exists->count > 0);
	}
	
	public function add_blocked($uid, $buddy_uid) {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$buddy_uid = $wpdb->escape($buddy_uid);
		$sql = "select count(bid) as count from " . $wpdb->prefix . "upl_wc_blocked_users where uid = '$uid' and blocked_uid = '$buddy_uid'";
		$exists = $wpdb->get_row($sql);
		if ($exists->count > 0) {
			return;
		}
		$sql = 'insert into ' . $wpdb->prefix . 'upl_wc_blocked_users (uid, blocked_uid) values ("' . $uid . '", "' . $buddy_uid . '")';
		$wpdb->query($sql);
	}

	public function remove_blocked($uid, $buddy_uid) {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$buddy_uid = $wpdb->escape($buddy_uid);
		$sql = "delete from " . $wpdb->prefix . "upl_wc_blocked_users where uid = '$uid' and blocked_uid = '$buddy_uid'";
		$wpdb->query($sql);
	}
	
	public function get_birthday($userData) {
		$d = $userData->birth_day;
		$m = $userData->birth_month;
		$y = $userData->birth_year;
		if ($d == '' || $m == '' || $y == '') {
			return '';
		}
		$m += 1;
		if ($d < 10) {
			$d = "0$d";
		}
		if ($m < 10) {
			$m = "0$m";
		}
		return "$m/$d/$y";
	}
	
	private function get_encrypted($password, $user_id) {
		srand();
		$td = mcrypt_module_open('rijndael-128', '', 'cbc', '');
		$keylen = mcrypt_enc_get_key_size($td);
		$key = substr($password, 0, $keylen);
		$key = str_pad($key, $keylen);
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		if (mcrypt_generic_init($td, $key, $iv) != -1) {
			$pad = 16 - strlen($user_id);
			$mypadded = $user_id . str_repeat(chr($pad), $pad);
			$c_t = mcrypt_generic($td, pack('H*', md5($user_id)).$user_id);
			mcrypt_generic_deinit($td);
			$result = base64_encode($iv.$c_t);
			return $result;
		} else {
		  	return "";
		}
	}

	private function get_decrypted($password, $encrypted) {
	 	$base46str = base64_decode($encrypted);
		$td = mcrypt_module_open('rijndael-128', '', 'cbc', '');
		$keylen = mcrypt_enc_get_key_size($td);
		$key = substr($password, 0, $keylen);
		$key = str_pad($key, $keylen);
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = substr($base46str, 0, $iv_size);
		$encrypted = substr($base46str, $iv_size);
		if (strlen($iv) != $iv_size) {
			return "";
		}
		if (mcrypt_generic_init($td, $key, $iv) != -1) {
			$u_t = mdecrypt_generic($td, $encrypted);
		 	$md5 = substr($u_t, 0, 16);
		 	$decrypted = substr($u_t, 16);
			$pad = substr($decrypted, -1);
			$result = trim($decrypted, $pad);
			mcrypt_generic_deinit($td);
			return $result;
		} else {
		  	return "";
		}
	
	}
}

?>