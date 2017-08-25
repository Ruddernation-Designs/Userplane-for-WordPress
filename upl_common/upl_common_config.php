<?php

class upl_common_config {
	
	public function show_config_table($fields, $name) {
		global $CONFIG_PHRASES;
		echo '<div class="wrap">';
		echo '<form method="post" action="">';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Update Options &raquo;') .'" /></p>';
		$last_block = '';
		foreach ( $fields as $field ) {
			if ($last_block != $field->block) {
				if ($last_block != '') {
					echo '</table>';
				}
				$last_block = $field->block;
				$title = __($CONFIG_PHRASES[$name . '.paramblock.' . $field->block]);
				echo '<h2>' . $title . '</h2>';
				echo '<table class="optiontable">';
			}
			echo '<tr valign="top">';
			echo '<th scope="row">' . __($CONFIG_PHRASES[$name . '.param.' . $field->code]) . ':</th>';
			echo '<td>';
				
			if($field->settype == 'text') {
				echo '<input name="config_params['. $field->code . ']" type="text" id="'. $field->code . '" value="'. $field->val . '" size="40" />';
			} else if($field->settype == 'boolean') {
				echo '<select name="config_params['. $field->code . ']" >';
            	echo '<option value="1" ' . ($field->val != 0 ? 'selected' : '') . ' >Yes</option>';
            	echo '<option value="0" ' . ($field->val == 0 ? 'selected' : '') . ' >No</option>';
        		echo '</select>';
			} else if($field->settype == 'textarea') {
				echo '<textarea name="config_params['. $field->code . ']" id="'. $field->code . '" cols="38" rows="4">' . $field->val . '</textarea>';
			} else if($field->settype == 'select') {
				echo '<select name="config_params['. $field->code . ']" >';
				if($field->code == 'wc_chat_audiokbps' || $field->code == 'wr_chat_audiokbps') {
	            	echo '<option value="10" ' . ($field->val == 10 ? 'selected' : '') . ' >10</option>';
	            	echo '<option value="16" ' . ($field->val == 16 ? 'selected' : '') . ' >16</option>';
	            	echo '<option value="22" ' . ($field->val == 22 ? 'selected' : '') . ' >22</option>';
	            	echo '<option value="44" ' . ($field->val == 44 ? 'selected' : '') . ' >44</option>';
	            	echo '<option value="88" ' . ($field->val == 88 ? 'selected' : '') . ' >88</option>';
				} else if($field->code == 'wc_chat_videosize' || $field->code == 'wr_chat_videosize') {
	            	echo '<option value="1" ' . ($field->val == 1 ? 'selected' : '') . ' >160x120</option>';
	            	echo '<option value="2" ' . ($field->val == 2 ? 'selected' : '') . ' >320x240</option>';
	            	echo '<option value="3" ' . ($field->val == 3 ? 'selected' : '') . ' >640x480</option>';
				} else if($field->code == 'wc_lobby') {
					require_once(ABSPATH . 'wp-content/plugins/upl_wc/upl_wc_rooms.php');
					echo upl_wc_rooms::get_list_rooms_options($field->val);
				}
        		echo '</select>';
			}
			echo '<p>' . __($CONFIG_PHRASES[$name . '.paramd.' . $field->code]) . '</p>';
			echo '</td> </tr>';
		}
		echo '</table>';
		echo '<p class="submit"><input type="submit" name="submit" value="' . __('Update Options &raquo;') .'" /></p>';
		echo '</form>';
		echo '</div>';
	}
	
	public function config_saved() {
		echo '<div id="message" class="updated fade"><p><strong>' . __('Configuration saved.') . '</strong></p></div>';
	}
	
}

?>