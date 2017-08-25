<?php
	// DO NOT MODIFY THIS FILE

	function up_presence($presence_id, $password, $user_id, $url)
	{
		$encr_user_id = up_getEncrypted($password, $user_id);
		if($encr_user_id == "")
		{
		  	return false;
		}

		print ("\n\n<script src=\"http://cache.static.userplane.com/presence/f.js\" language=\"javascript\" type=\"text/javascript\"></script>\n");
		print ("<script language=\"javascript\" type=\"text/javascript\">\n");
		print ("<!--\n");
		print ("\tup_wmURL = '$url';\n");
		printf("\tup_runPresence(%s, '%s');\n", $presence_id, $encr_user_id);
		print ("//-->\n");
		print ("</script>\n\n");

		return true;
	}
	// USED TO ECRYPT USER ID
	function up_getEncrypted($password, $user_id)
	{
		srand();

		$td = mcrypt_module_open('rijndael-128', '', 'cbc', '');
		$keylen = mcrypt_enc_get_key_size($td);
		$key = substr($password, 0, $keylen);
		$key = str_pad($key, $keylen);
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		if (mcrypt_generic_init($td, $key, $iv) != -1)
		{
			$pad = 16 - strlen($user_id);
			$mypadded = $user_id . str_repeat(chr($pad), $pad);
			$c_t = mcrypt_generic($td, pack('H*', md5($user_id)).$user_id);
			mcrypt_generic_deinit($td);
			$result = base64_encode($iv.$c_t);
			return $result;
		}
		else
		{
		  	return "";
		}
	}
	// USED TO DECRYPT ENCRYPTED USER ID
	function up_getDecrypted($password, $encrypted)
	{
	 	$base46str = base64_decode($encrypted);
		$td = mcrypt_module_open('rijndael-128', '', 'cbc', '');
		$keylen = mcrypt_enc_get_key_size($td);
		$key = substr($password, 0, $keylen);
		$key = str_pad($key, $keylen);
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = substr($base46str, 0, $iv_size);
		$encrypted = substr($base46str, $iv_size);
		if (strlen($iv) != $iv_size)
		{
			return "";
		}
		if (mcrypt_generic_init($td, $key, $iv) != -1)
		{
			$u_t = mdecrypt_generic($td, $encrypted);
		 	$md5 = substr($u_t, 0, 16);
		 	$decrypted = substr($u_t, 16);
			$pad = substr($decrypted, -1);
			$result = trim($decrypted, $pad);
			mcrypt_generic_deinit($td);
			return $result;
		}
		else
		{
		  	return "";
		}
	}
?>