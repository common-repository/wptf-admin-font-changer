<?php
/*
Plugin Name: WPTF Admin Font Changer
Description: WPTF Admin Font Changer basically allows you to change the font style of the admin for a more readable font.
Version: 1.0
Author: Jan Michael Cheng
Author URI: http://www.trusted-freelancer.com
License: GPL
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
?>
<?php

	function wptf_afc_css_loader()
	{
		require plugin_dir_path( __FILE__ ) . 'css/wptf_afc_css.php';
	}
	add_action('admin_footer', 'wptf_afc_css_loader');

	class wptf_afc
	{
		public function __construct()
		{
			add_action('admin_menu', array( &$this, 'wptf_afc_menu' ));	
		}
		
		
		public function wptf_afc_menu() {
			if (!current_user_can('manage_options'))  {
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			
			add_options_page('WPTF - Admin Font Changer - Panel', 'WPTF - Admin Font Changer', 'manage_options', 'wptf-afc-panel', array(&$this, 'wptf_afc_panel'));
		}
		
		function wptf_afc_panel() 
		{
			if (!current_user_can('manage_options'))  {
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			
			global $current_user;
			$s_opt_wptf_afc_font_family = '';
			$s_opt_wptf_afc_font_size = '';
			$s_opt_wptf_afc_font_weight = '';
			
			
			if( isset($_POST) && !empty($_POST) )
			{
				$s_wptf_afc_font_nonce = $_POST['txt_wptf_afc_font_nonce'];
				if (!wp_verify_nonce($s_wptf_afc_font_nonce, 's_wptf_afc_font_nonce'))
				{
					echo "<div id=\"message\" class=\"updated fade\"><p>Security Check - If you receive this in error, log out and back in to WordPress</p></div>";
					die();
				}

				$s_opt_wptf_afc_font_family = ( ( isset($_POST['opt_wptf_afc_font_family']) && !empty($_POST['opt_wptf_afc_font_family']) && $_POST['opt_wptf_afc_font_family'] != '-' ) ? $_POST['opt_wptf_afc_font_family'] : '' );
				$s_opt_wptf_afc_font_size = ( ( isset($_POST['opt_wptf_afc_font_size']) && !empty($_POST['opt_wptf_afc_font_size']) && $_POST['opt_wptf_afc_font_size'] != '-' ) ? $_POST['opt_wptf_afc_font_size'] : '' );
				$s_opt_wptf_afc_font_weight = ( ( isset($_POST['opt_wptf_afc_font_weight']) && !empty($_POST['opt_wptf_afc_font_weight']) && $_POST['opt_wptf_afc_font_weight'] != '-' ) ? $_POST['opt_wptf_afc_font_weight'] : '' );
				
				if( isset($s_opt_wptf_afc_font_family) && !empty($s_opt_wptf_afc_font_family) )
				{
					update_user_meta( $current_user->ID, 'wptf-afc-font-family', (string)$s_opt_wptf_afc_font_family );
				}
				else
				{
					delete_user_meta( $current_user->ID, 'wptf-afc-font-family', '' );
				}
				if( isset($s_opt_wptf_afc_font_size) && !empty($s_opt_wptf_afc_font_size) )
				{
					update_user_meta( $current_user->ID, 'wptf-afc-font-size', (string)$s_opt_wptf_afc_font_size );
				}
				else
				{
					delete_user_meta( $current_user->ID, 'wptf-afc-font-size', '' );
				}
				if( isset($s_opt_wptf_afc_font_weight) && !empty($s_opt_wptf_afc_font_weight) )
				{
					update_user_meta( $current_user->ID, 'wptf-afc-font-weight', (string)$s_opt_wptf_afc_font_weight );
				}
				else
				{
					delete_user_meta( $current_user->ID, 'wptf-afc-font-weight', '' );
				}
			}
			
			$s_opt_wptf_afc_font_family = get_user_meta($current_user->ID, 'wptf-afc-font-family', true); 
			$s_opt_wptf_afc_font_size = get_user_meta($current_user->ID, 'wptf-afc-font-size', true); 
			$s_opt_wptf_afc_font_weight = get_user_meta($current_user->ID, 'wptf-afc-font-weight', true); 
			
			/*
			echo $s_opt_wptf_afc_font_family;
			echo $s_opt_wptf_afc_font_size;
			echo $s_opt_wptf_afc_font_weight;
			*/
			?>
				<style>
					label{ display:block; }
					select{ width:300px; }
				</style>
				<div>	
					<h1>
						WPTF - Admin Font Changer
					</h1>
					<form id="frm_wptf_afc" name="frm_wptf_afc" method="post">
						<label for="opt_wptf_afc_font_family">
							Font Family:
						</label>
						<select id="opt_wptf_afc_font_family" name="opt_wptf_afc_font_family">
							<option value="-">Wordpress Default</option>
							<option value="arial" <?php if( $s_opt_wptf_afc_font_family == 'arial' ) { echo 'selected="selected"'; } ?> >Arial</option>
							<option value="times-new-roman" <?php if( $s_opt_wptf_afc_font_family == 'times-new-roman' ) { echo 'selected="selected"'; } ?> >Times New Roman</option>
							<option value="verdana" <?php if( $s_opt_wptf_afc_font_family == 'verdana' ) { echo 'selected="selected"'; } ?> >Verdana</option>
						</select>
						<br/>
						<label for="opt_wptf_afc_font_size">
							Font Size:
						</label>
						<select id="opt_wptf_afc_font_size" name="opt_wptf_afc_font_size">
							<option value="-">Wordpress Default</option>
							<option value="16" <?php if( $s_opt_wptf_afc_font_size == 16 ) { echo 'selected="selected"'; } ?> >16</option>
							<option value="17" <?php if( $s_opt_wptf_afc_font_size == 17 ) { echo 'selected="selected"'; } ?> >17</option>
							<option value="18" <?php if( $s_opt_wptf_afc_font_size == 18 ) { echo 'selected="selected"'; } ?> >18</option>
							<option value="19" <?php if( $s_opt_wptf_afc_font_size == 19 ) { echo 'selected="selected"'; } ?> >19</option>
						</select>
						<br/>
						<label for="opt_wptf_afc_font_weight">
							Font Weight:
						</label>
						<select id="opt_wptf_afc_font_weight" name="opt_wptf_afc_font_weight">
							<option value="-">Wordpress Default</option>
							<option value="normal" <?php if( $s_opt_wptf_afc_font_weight == 'normal' ) { echo 'selected="selected"'; } ?> >Normal</option>
							<option value="bold" <?php if( $s_opt_wptf_afc_font_weight == 'bold' ) { echo 'selected="selected"'; } ?> >Bold</option>
						</select>
						<br/><br/>
						<input type="hidden" name="txt_wptf_afc_font_nonce" value="<?php echo wp_create_nonce('s_wptf_afc_font_nonce'); ?>" />
						<input class="button-primary" type="submit" value="Change Font &raquo;" />
					</form>
				</div>
			<?php
		}
	}
	if( class_exists( 'wptf_afc' ) ) 
	{
		$o_wptf_afc = new wptf_afc;
	}
?>