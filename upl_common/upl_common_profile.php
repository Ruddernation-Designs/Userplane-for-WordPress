<?php

class upl_common_profile {
	
	public function init_hooks() {
		add_action('admin_head', array('upl_common_profile', 'start_buffering_profile_form'));
		add_action('edit_user_profile', array('upl_common_profile', 'show_upl_profile'));
		add_action('show_user_profile', array('upl_common_profile', 'show_upl_profile'));
		add_action('profile_update', array('upl_common_profile', 'save_upl_profile'));
	}

	public function show_upl_profile() {
		$uid = get_user_option('ID');
		$upl_profile = upl_common_profile::get_upl_profile($uid);
		?>		
		
		<fieldset>
		<legend>Chat Suite details</legend>
		
		<?php
                include_once("upl_common_user.php");
                $res=upl_common_user::get_user_with_user_id(0);
                print_r($res);
		$avatar = new upl_avatar();

		$avatars_url = '';

		
			$avatars_url = $avatar->get_avatars_url($uid) ;
			$image_tag = sprintf('<p><img src="%s"/></p>', $avatars_url);
			echo($image_tag);
		
		?>
		

		<p><label><?php _e('Location:') ?><br />
		<input type="text" name="location" value="<?php echo($upl_profile->location); ?>" />
		</label></p>
		
		<p><label><?php _e('Birthday:') ?><br />
		<?php 
		$month_names = array (
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
		);

		$birth_month = upl_common_profile::form_string_select($month_names, 'birth_month', $upl_profile->birth_month);
		echo($birth_month);

		$birth_day = upl_common_profile::form_int_range_select(1, 31, 1, 'birth_day', $upl_profile->birth_day);
		echo($birth_day);

		$birth_year = upl_common_profile::form_int_range_select(1910, 2000, 1, 'birth_year', $upl_profile->birth_year);
		echo($birth_year);
		?>		
		</label></p>
		
		<p><label><?php _e('Sex:') ?><br />
		<?php
		$sex_range = array(
		'---',
		'male',
		'female'
		);

		$sex = upl_common_profile::form_string_select($sex_range, 'sex', $upl_profile->sex);
		echo($sex);

		?>
		</label></p>
		
		<p><label><?php _e('Avatar:') ?><br />
		<input type="file" name="avatar_name"/>
		</label></p>
	
		</fieldset>
		
		<?php
	}

	private function get_current_avatar_name($user_id) {
		$users_profile = upl_common_profile::get_upl_profile($user_id);

		$avatar = new upl_avatar('avatar_name');
		$avatar_uploaded = trim($avatar->avatar_upload());

		if (!empty($avatar_uploaded)) {
			return $avatar_uploaded;
		}

		if (!empty($users_profile->avatar_name)) {
			return $users_profile->avatar_name;
		}

		return '';
	}

	private function update_profile($user_id) {
		global $wpdb;
		$avatar_name = upl_common_profile::get_current_avatar_name($user_id);

		$query = sprintf(
		'UPDATE %supl_wc_users
			SET 
			birth_month = %d,
			birth_year = %d,
			birth_day = %d,
			sex = %d,
			location = "%s",
			avatar_name = "%s"
			 WHERE user_id = %d', 
		$wpdb->prefix,
		$_POST['birth_month'],
		$_POST['birth_year'],
		$_POST['birth_day'],
		$_POST['sex'],
		$_POST['location'],
		$avatar_name,
		$user_id);
		$wpdb->query($query);
	}

	private function insert_profile($user_id) {
		global $wpdb;
		$avatar_name = upl_common_profile::get_current_avatar_name($user_id);

		$query = sprintf(
		'INSERT INTO %supl_wc_users (
		birth_month, 
		birth_year, 
		birth_day, 
		sex, 
		location, 
		avatar_name, 
		user_id)
		VALUES (%d, %d, %d, %d, "%s", "%s", %d)',
		$wpdb->prefix,
		$_POST['birth_month'],
		$_POST['birth_year'],
		$_POST['birth_day'],
		$_POST['sex'],
		$_POST['location'],
		$avatar_name,
		$user_id);

		$wpdb->query($query);
	}

	public function save_upl_profile() {
		$uid = get_user_option('ID');
		$users_profile = upl_common_profile::get_upl_profile($uid);

		if ($users_profile != null) {
			upl_common_profile::update_profile($uid);
		} else {
			upl_common_profile::insert_profile($uid);
		}

	}

	public function get_upl_profile($user_id) {
		global $wpdb;
		$query = sprintf("SELECT * FROM %supl_wc_users WHERE user_id = %d", $wpdb->prefix, $user_id);
		$user_data = $wpdb->get_row($query, OBJECT);

		return($user_data);
	}

	private function form_int_range_select($begin, $end, $step, $name, $selected_option = null) {
		$select_tag = sprintf('<select name=%s>', $name);
		for ($i = $begin; $i <= $end; $i+= $step) {
			$selected_field = $selected_option == $i ? 'selected' : '';
			$select_tag .= sprintf('<option value="%d" %s >%d</option>)', $i, $selected_field, $i);
		}
		$select_tag .= '</select>';

		return $select_tag;
	}

	private function form_string_select($str_range, $name, $selected_option = null) {
		$select_tag = sprintf('<select name=%s>', $name);

		$i = 0;
		foreach ($str_range as $str_value) {
			$selected_field = $selected_option == $i ? 'selected' : '';
			$select_tag .= sprintf('<option value="%d" %s >%s</option>)', $i, $selected_field, $str_value);
			++$i;
		}
		$select_tag .= '</select>';

		return $select_tag;
	}

	/*private*/ function set_pofile_form_multipart($profile_form) {
		return str_replace(
		'<form name="profile"',
		'<form enctype="multipart/form-data" name="profile"', $profile_form
		);
	}

	/*private*/ function start_buffering_profile_form() {
		ob_start(array('upl_common_profile', 'set_pofile_form_multipart'));
	}
}

class upl_avatar {
	public function __construct($avatars_name = null) {
		$this->_avatars_path = ABSPATH . 'wp-content/images/avatars/';
		$this->_avatars_url = get_option('siteurl') . '/wp-content/images/avatars/';

		$this->_avatars_name = $avatars_name;
	}

	public function get_avatars_url($id) {
            $arg=array('item_id'		=>$id,
                            'object'		=> "user",	// user/group/blog/custom type (if you use filters)
                            'type'		=> "thumbnail",	// thumb or full,

                        'html'=>false);
		return bp_core_fetch_avatar($arg);
	}

	public function avatar_upload() {
		if ($this->validate_avatar_upload() == false) {
			return null;
		}

		if (file_exists($this->_avatars_path) == false) {
			mkdir($this->_avatars_path, 0777, true);
		}

		$dest_path = $this->_avatars_path . $_FILES[$this->_avatars_name]['name'];
		if (move_uploaded_file($_FILES[$this->_avatars_name]['tmp_name'], $dest_path) == false) {

		}

		return $_FILES[$this->_avatars_name]['name'];
	}

	private function validate_avatar_upload() {

		if (empty($_FILES[$this->_avatars_name])) {
			//errors ... set
			return false;
		}

		if (empty($_FILES[$this->_avatars_name]['name'])) {
			//set errors
			return false;
		}


		$file_name = $_FILES[$this->_avatars_name]['name'];
		if ($this->is_avatar_extension_allowable($file_name) == false) {
			return false;
		}


		return true;
	}

	private function is_avatar_extension_allowable($file_name) {
		$allowable_extensions = array (
		'bmp',
		'gif',
		'ico',
		'png',
		'jpg'
		);

		$file_extension = preg_replace("(^[\w\_\-]*.?)", "", $file_name);

		foreach($allowable_extensions as $extension) {
			if (strcasecmp($file_extension, $extension) == 0) {
				return true;
			}
		}

		return false;
	}

	private $_avatars_path;
	private $_avatars_url;
	private $_avatars_name;
}

?>