<?php

class upl_wr_records {
	
	public function update_records_list($strXmlData) {
		global $wpdb;
		require_once 'xmlparcer.php';
		$allrecs = upl_wr_records::get_all_records();
		$resultArray = getMembersRecords($strXmlData);
		$confirmedRec = array();
		foreach ($resultArray as $id => $recs) {
			foreach ($recs as $rnum => $rec) {
				$newState = (($rec['status'] == 'approved') + 1);
				$found = false;
				foreach ($allrecs as $record) {
					if($record->name == $rec['name'] && $record->uid == $id) {
						if($record->state != $newState) {
//							echo '<changestate>' . $rec['name'] . '</changestate>';
							$summary_sql = "update " . $wpdb->prefix . "upl_wr_records set state = $newState where name = '" . $rec['name'] . "' and uid = '$id'";
							$wpdb->query($summary_sql);
						}
						$confirmedRec[$record->rid] = 1;
						$found = true;
						break;
					}
				}
				if(!$found) {
//					echo '<add>' . $rec['name'] . '</add>';
					$summary_sql = "insert into " . $wpdb->prefix . "upl_wr_records (name, uid, state) values ('" . $rec['name'] . "', '$id', '$newState')";
					$wpdb->query($summary_sql);
				}
			}
		}
		foreach ($allrecs as $record) {
			if(!key_exists($record->rid, $confirmedRec)) {
//				echo '<del>' . $record->name . '</del>';
				$summary_sql = "delete from " . $wpdb->prefix . "upl_wr_records where name = '" . $record->name . "' and uid = '" . $record->uid . "'";
				$wpdb->query($summary_sql);
			}
		}
	}
	
	public function update_record_status($uid, $name, $stateStr, $bExists) {
		$summary_sql = '';
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$name = $wpdb->escape($name);
		$sql = 'select state from ' . $wpdb->prefix . 'upl_wr_records where name = "' . $name .'" and uid = "' . $uid . '"';
		$current_state = $wpdb->get_row($sql);
		if($current_state == null) {
			if($bExists) {
				$state = (($stateStr == 'approved') + 1);
				$summary_sql = "insert into " . $wpdb->prefix . "upl_wr_records (name, uid, state) values ('$name', '$uid', '$state')";
				$wpdb->query($summary_sql);
			}
			return;
		}
		$current_state = $current_state->state;
		if($current_state < 0) {
			$current_state = -$current_state;
		}
		$state_new = 0;
		if ($stateStr == 'new') {
			$state_new = 1;
		} else if ($stateStr == 'approved') {
			$state_new = 2;
		} else {
			return;
		}
		if(!isset($bExists) || $bExists == '') {
			if ($current_state == $state_new) {
				$summary_sql = "delete from " . $wpdb->prefix . "upl_wr_records where name = '$name' and uid = '$uid'";
				$wpdb->query($summary_sql);
			}
			return;
		}
		$summary_sql = "update " . $wpdb->prefix . "upl_wr_records set state = $state_new where name = '$name' and uid = '$uid'";
		$wpdb->query($summary_sql);
	}
	
	public function get_records($uid, $filter='') {
		global $wpdb;
		$uid = $wpdb->escape($uid);
		$sql = "select * from " . $wpdb->prefix . "upl_wr_records where uid = '$uid' $filter order by state DESC, name";
		return $wpdb->get_results($sql);
	}
	
	public function get_deleted_records() {
		global $wpdb;
		$sql = "select * from " . $wpdb->prefix . "upl_wr_records where state < 0";
		return $wpdb->get_results($sql);
	}

	public function get_all_records() {
		global $wpdb;
		$sql = "select * from " . $wpdb->prefix . "upl_wr_records";
		return $wpdb->get_results($sql);
	}
	
	public function show_my_records() {
		echo '<div class="wrap">';
		echo '<h2>' . __('My Videos') . '</h2>';
		global $user_ID;
		$records = upl_wr_records::get_records($user_ID, "and state > 0");
		upl_wr_records::show_records_table($records, 1, 1, 1, 0);
		echo '</div>';
	}
	
	public function view($rid) {
		$record = upl_wr_records::get_record_by_id($rid);
		if($record == null) {
			upl_wr_records::show_message('No video found.', true);
			return false;
		}
		upl_wr_records::show_message('');
		echo '<div class="wrap">';
		echo '<h2>' . __('View video: ') . __($record->name) . '</h2>';
		$strSwfName = 'vrPlayer.swf';
		require_once 'upl_wr_config.php';
		$configuration = upl_wr_config::get_wr_configuration();
		$iVideoSize = $configuration['wr_chat_videosize'];
        if ($iVideoSize == 1) {
        	$width = 160;
        	$height = 261;
        } else if ($iVideoSize == 2) {
        	$width = 320;
        	$height = 381;
        } else {
        	$width = 640;
        	$height = 621;
        }		
		$additional = 'fo.addVariable("viewingMemberID", "' . $record->uid . '");';
		upl_wr_records::show_flash($record->name, $strSwfName, $width, $height, $additional);
		echo '</div>';
	}

	public function show_new_video_form() {
		echo '<div class="wrap">';
		echo '<h2>' . __('Add New Video') . '</h2>';
		echo '<form method="post" action="">';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Start recording &raquo;') .'" /></p>';
		echo '<table class="optiontable">';
		echo '<tr valign="top">';
		echo '<th scope="row">' . __('Video name') . ':</th>';
		echo '<td>';
		echo '<input name="video_name" type="text" id="video_name" value="" size="40" />';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Start recording &raquo;') .'" /></p>';
		echo '</form>';
		echo '</div>';		
	}
	
	private function check_name($name) {
		global $user_ID;
		global $wpdb;
		$sql = 'select count(rid) as c from ' . $wpdb->prefix . 'upl_wr_records where name = "' . $wpdb->escape($name) .'" and uid = "' . $user_ID . '"';
		$count = $wpdb->get_row($sql);
		return ($count->c == 0);
	}
	
	public function get_record_by_id($rid) {
		global $wpdb;
		return $wpdb->get_row('select * from ' . $wpdb->prefix . 'upl_wr_records where rid = ' . $wpdb->escape($rid));
	}
	
	public function edit($rid) {
		$record = upl_wr_records::get_record_by_id($rid);
		if($record == null) {
			upl_wr_records::show_message('No video found.', true);
			return false;
		}
		upl_wr_records::show_message('');
		upl_wr_records::show_recorder($record->name);
	}
	
	public function add($name) {
		if($name == '') {
//			upl_wr_records::show_message('Video name can not be empty.', true);
			echo '<div id="message" class="error"><p><strong>' . __('Video name can not be empty.') . '</strong></p><p><a href="admin.php?page=upl_wr_my">' . __('&laquo; Back') . '</a></p></div>';
			return false;
		}
		if(!upl_wr_records::check_name($name)) {
//			upl_wr_records::show_message('The video with specified name already exists.', true);
			echo '<div id="message" class="error"><p><strong>' . __('The video with specified name already exists.') . '</strong></p><p><a href="admin.php?page=upl_wr_my">' . __('&laquo; Back') . '</a></p></div>';
			return false;
		}
//		upl_wr_records::show_message('');
		echo '<div id="message" class="updated fade"><p><strong>' . __('') . '</strong></p><p><a href="admin.php?page=upl_wr_my">' . __('&laquo; Back') . '</a></p></div>';
		upl_wr_records::show_recorder($name);
	}
	
	private function show_flash($name, $strSwfName, $iWidth, $iHeight, $additional='') {
		require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
		require_once 'upl_wr_config.php';
		$configuration = upl_wr_config::get_wr_configuration();
		$strSwfServer = 'swf.userplane.com';
		$strApplicationName = 'Webrecorder';
		$strFlashcomServer = $configuration['wr_strflashcomserver'];
		$strDomainID = $configuration['wr_strdomainid'];
		$strSessionGUID = upl_common_user::get_current_session();
		$strLocale = 'english';
		$strRecordingName = $name;
		$admin = upl_common_user::is_admin();
		$zoneID = $configuration['wr_banner_zone_id'];
?>
<script type="text/javascript" src="<?php echo (get_option('siteurl')); ?>/wp-content/plugins/upl_wr/flashobject.js"></script>

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
	
	var fo = new FlashObject("http://<?php echo ($strSwfServer); ?>/<?php echo ($strApplicationName); ?>/<?php echo ($strSwfName); ?>", "wr", "<?php echo ($iWidth); ?>", "<?php echo ($iHeight); ?>", "6", "#ffffff", false, "best");
	fo.addParam("scale", "noscale");
	fo.addParam("menu", "false");
	fo.addParam("salign", "LT");
	fo.addParam("allowScriptAccess", "always");
	fo.addVariable("server", "<?php echo ($strFlashcomServer); ?>");
	fo.addVariable("swfServer", "<?php echo ($strSwfServer); ?>");
	fo.addVariable("applicationName", "<?php echo ($strApplicationName); ?>");
	fo.addVariable("domainID", "<?php echo ($strDomainID); ?>");
	fo.addVariable("sessionGUID", "<?php echo ($strSessionGUID); ?>");
	fo.addVariable("key", "");
	fo.addVariable("locale", "<?php echo ($strLocale); ?>");
	fo.addVariable("recordingName", "<?php echo ($strRecordingName); ?>");
	fo.addVariable("enableJavascript", "false");
<?php	
	echo $additional;
	if ($admin) {
		echo 'fo.addVariable("admin", "true");';
	}
?>	
	fo.write("flashcontent");
	
	// COPYRIGHT Userplane 2006 (http://www.userplane.com)
	// WR version 1.5.0
	
	// ]]>
</script>    
<?php		
		if($zoneID != '') {
			echo '<iframe src="http://subtracts.userplane.com/mmm/bannerstorage/ch_int_textad_r.html?app=wc&zoneID=' . $zoneID . '&clickID=a20e44fa" name="Text_Ad" scrolling="NO" width="' . $iWidth . '" height="22" frameborder="0"></iframe>';
		}
	}
	
	private function show_recorder($name) {
		echo '<div class="wrap">';
		echo '<h2>' . __('Video name: ') . __($name) . '</h2>';
		$strSwfName = 'vrRecorder.swf';
		$iWidth = '320';
		$iHeight = '261';
		upl_wr_records::show_flash($name, $strSwfName, $iWidth, $iHeight);
		echo '</div>';
	}
	
	public function show_approved_records() {
		echo '<div class="wrap">';
		echo '<h2>' . __('All videos') . '</h2>';
		upl_wr_records::show_filter(1,0);
		global $wpdb;
		$filter = upl_wr_records::current_filter();
		$filter_user = $wpdb->escape($filter['user']);
		$filter_state = 'and state = 2';
		$users = $wpdb->get_results("select distinct ID, display_name from " .  $wpdb->prefix . "upl_wr_records r inner join ". $wpdb->users . " u on r.uid = u.ID where display_name like '%$filter_user%' $filter_state order by display_name");
		if (count($users) == 0) {
			echo __('No videos found.');
			echo '</div>';
		}
		foreach($users as $user) {
?>
			<table class="widefat"><tbody>
			<tr>
				<th><h3><?php _e($user->display_name); ?></h3></th>
			</tr>
			<tr>
				<td>
<?php
			$records = upl_wr_records::get_records($user->ID, $filter_state);
			upl_wr_records::show_records_table($records, 1, 0, 0, 0);
?>
				</td>
			</tr>
		</tbody></table>
<?php
		}
		echo '</div>';
	}
	
	public function show_all_records() {
		echo '<div class="wrap">';
		echo '<h2>' . __('All videos') . '</h2>';
		upl_wr_records::show_filter();
		global $wpdb;
		$filter = upl_wr_records::current_filter();
		$filter_user = $wpdb->escape($filter['user']);
		$filter_state = upl_wr_records::get_sql_filter();
		$users = $wpdb->get_results("select distinct ID, display_name from " .  $wpdb->prefix . "upl_wr_records r inner join ". $wpdb->users . " u on r.uid = u.ID where display_name like '%$filter_user%' $filter_state order by display_name");
		if (count($users) == 0) {
			echo __('No videos found.');
			echo '</div>';
		}
		foreach($users as $user) {
?>
			<table class="widefat"><tbody>
			<tr>
				<th><h3><?php _e($user->display_name); ?></h3></th>
			</tr>
			<tr>
				<td>
<?php
			$records = upl_wr_records::get_records($user->ID, $filter_state);
			upl_wr_records::show_records_table($records, 1, 0, 1, 1);
?>
				</td>
			</tr>
		</tbody></table>
<?php
		}
		echo '</div>';
	}
	
	private function show_filter($user=1, $state=1) {
		$filter = upl_wr_records::current_filter();
		if ( $user == 0 && $state == 0 ){
			return;
		}
?>
		<form method="get" action="">
		<p>
			<input type="hidden" name="page" id="page" value="upl_wr_records" />
<?php		
		if($user == 1) {
?>
			<?php echo(__('Search by user:')); ?> <input name="filter" id="filter" value="<?php echo $filter['user']; ?>" type="text" /> 
<?php		
		}
		if($state == 1) {
?>

			<?php echo(__('Search by state:')); ?> 
			<select name="state" id="state" value="">
				<option value='0' <?php if($filter['state'] == 0) echo('selected'); ?> >All</option>
				<option value='1' <?php if($filter['state'] == 1) echo('selected'); ?> >New</option>
				<option value='2' <?php if($filter['state'] == 2) echo('selected'); ?> >Approved</option>
				<option value='-1' <?php if($filter['state'] == -1) echo('selected'); ?> >Marked for deletion</option>
			</select>
<?php			
		}
?>
			<input type="submit" class="button" value="<?php echo(__('Search »')); ?>" />
		</p>
		</form>
<?php		
	}
	
	private function current_filter() {
		$filter = array();
		$filter['user'] = key_exists('filter' ,$_GET) ? $_GET['filter'] : '';
		$filter['state'] = key_exists('state' ,$_GET) ? $_GET['state'] : 0;
		return $filter;
	}
	
	private function get_sql_filter() {
		$result = '';
		$filter = upl_wr_records::current_filter();
		global $wpdb;
		if ($filter['state'] != 0) {
			if ($filter['state'] < 0) {
				$result .= "and state < 0";
			}
			if ($filter['state'] == 1 || $filter['state'] == 2) {
				$state = $wpdb->escape($filter['state']);
				$result .= "and state = '$state'";
			}
		}
		return $result;
	}
	
	private function get_state($int) {
		if ($int == 1) {
			return 'new';
		}
		if ($int == 2) {
			return 'approved';
		}
		if ($int < 0) {
			return 'marked for deletion';
		}
		return 'unknown';
	}
	
	private function show_records_table($records, $view=1, $change=0, $delete=0, $rase=0) {
		if(count($records) == 0) {
			echo __('There are not any videos yet.');
			return;
		}
		$cols = $view + $change + $delete + $rase;
?>
		<table class="widefat"><tbody>
		<tr class="thead">
			<th width="5%"><?php _e('ID') ?></th>
			<th width="40%"><?php _e('Video Name') ?></th>
			<th width="20%"><?php _e('State') ?></th>
<?php
		if($cols > 0) {
?>
			<th colspan="<?php _e($cols) ?>" style="text-align: center"><?php _e('Actions') ?></th>
<?php
		}
?>
		</tr>
<?php
		foreach ($records as $record) {
			$state = upl_wr_records::get_state($record->state);
			if($record->state > 0) {
				$del_action = 'delete';
				$del_action_label = "Mark for deletion";
			} else {
				$del_action = 'restore';
				$del_action_label = "Unmark for deletion";
			}
?>
			<tr class="alternate">
				<td width="5%"><?php echo ($record->rid); ?></td>
				<td width="40%"><?php echo ($record->name); ?></td>
				<td width="20%"><?php echo ($state); ?></td>
<?php
				if ($view) {
					$edit_link = add_query_arg('action', "view&rid=$record->rid&backurl=" . $_SERVER['REQUEST_URI']  );
					echo "<td><a href='$edit_link' class='edit'>".__( 'View' )."</a></td>";
				}
				if ($change) {
					$edit_link = add_query_arg('action', "edit&rid=$record->rid&backurl=" . $_SERVER['REQUEST_URI']  );
					echo "<td><a href='$edit_link' class='edit'>".__( 'Edit' )."</a></td>";
				}
				if ($delete) {
					$edit_link = add_query_arg('action', "$del_action&rid=$record->rid&backurl=" . $_SERVER['REQUEST_URI'] );
					echo "<td><a href='$edit_link' class='edit'>".__( $del_action_label )."</a></td>";
				}
				if ($rase) {
 					$edit_link = add_query_arg('action', "rase&rid=$record->rid&backurl=" . $_SERVER['REQUEST_URI']  );
					echo "<td><a href='$edit_link' class='edit'>".__( 'Delete permanently' )."</a></td>";
				}
?>
			</tr>	
<?php
		}
		echo '</tbody></table>';
		
	}

	public function show_message($message, $error=false) {
		$backurl = key_exists('backurl', $_GET) ? $_GET['backurl'] : '';
		if ($message == '' && $backurl == '') {
			return;
		}
		$filter = upl_wr_records::current_filter();
		if($filter['user'] != '') {
			$backurl .= '&filter=' . $filter['user'];
		}
		if($filter['state'] != '') {
			$backurl .= '&state=' . $filter['state'];
		}
		if ($error) {
			echo '<div id="message" class="error"><p><strong>' . __($message) . '</strong></p><p><a href="' . $backurl . '">' . __('&laquo; Back') . '</a></p></div>';
		} else {
			echo '<div id="message" class="updated fade"><p><strong>' . __($message) . '</strong></p><p><a href="' . $backurl . '">' . __('&laquo; Back') . '</a></p></div>';
		}
	}

	public function change_state($rid) {
		global $user_ID;
		$record = upl_wr_records::get_record_by_id($rid);
		if($record == null) {
			upl_wr_records::show_message('Video was not found.', true); 
			return;
		}
		$message = $record->state > 0 ? 'Video is marked for deletion.' : 'Video is unmarked for deletion.';
		require_once(ABSPATH . 'wp-content/plugins/upl_common/upl_common_user.php');
		if (upl_common_user::is_admin($user_ID) || $user_ID == $record->uid) {
			global $wpdb;
			$sql = "update " . $wpdb->prefix . "upl_wr_records set state = -state where rid = '" . $wpdb->escape($rid) . "'";
			$wpdb->query($sql);
			upl_wr_records::show_message($message); 
		} else {
			upl_wr_records::show_message('Only owner or admin can change state of the video.', true); 
		}
	}

	public function rase($rid) {
		global $wpdb;
		$sql = "DELETE FROM " . $wpdb->prefix . "upl_wr_records where rid = '" . $wpdb->escape($rid) . "'";
		$wpdb->query($sql);
		upl_wr_records::show_message('Video was removed.');
	}
	
}

?>