<?php



class upl_wr_post {

	

	private function get_uri($rid) {

		require_once 'upl_wr_records.php';

		$record = upl_wr_records::get_record_by_id($rid);

		return "<a href='" . get_option('siteurl') . "/wp-admin/admin.php?page=upl_wr_my&action=view&rid=$rid' >" . $record->name . "</a>";

	}

	

	private function get_rid($uri) {

		

	}

	

	public function post_gui() {

		require_once 'upl_wr_records.php';

		global $user_ID;

		$records = upl_wr_records::get_records($user_ID, "and state > 0");

?>

		

<fieldset id="postrecordsdiv" class="dbx-box">

<h3 class="dbx-handle"><?php _e("Attach Video") ?></h3> 

<div class="dbx-content">



<table class="editform">

		<tr>

		<td>Choose video:</td>

		<td>

		<select name="upl_wr_related_video">' .

			<option value="" ></option>

<?php

			foreach ($records as $record) {

				echo '<option value="' . $record->rid . '" >' . $record->name . '</option>';

			}

?>

		</select>

		</td>

		</tr>

</table>

<p class="submit"><input type="submit" id="updatemetasub" name="updatemeta" tabindex="9" value="<?php _e( 'Attach video &raquo;' ) ?>" /></p>

</div>

</fieldset>

<?php

	}

	

	public function save_post_record($id) {

		global $wpdb;

		$title = 'Attached Video';

		if( !isset( $id ) ) {

			$id = $_REQUEST[ 'post_ID' ];

		}

	    if( !current_user_can('edit_post', $id) ) {

	        return $id;

		}

		if ( !$_POST['updatemeta'] ) {

			return $id;

		}

		$rid = stripslashes(trim($_REQUEST[ "upl_wr_related_video" ]));

		if( !isset( $rid ) || empty( $rid ) ) {

			return $id;

		}

		$meta_value = upl_wr_post::get_uri($rid);

		$metadata = has_meta($id);

		if ($metadata) {

			foreach($metadata as $entry) {

				if ($entry['meta_key'] == $title && $entry['meta_value'] == $meta_value) {

					return $id;

				}

			}

		}

		add_post_meta( $id, $title, $meta_value );

	}

}



?>