<?php
/**
 * Plugin Name: Style Admin
 * Plugin URI: http://www.fuzzguard.com.au/plugins/style-admin
 * Description: Used to style the admin panel without having to edit files
 * Version: 1.3.1
 * Author: Benjamin Guy
 * Author URI: http://www.fuzzguard.com.au
 * Text Domain: style-admin
 * License: GPL2

    Copyright 2014  Benjamin Guy  (email: beng@fuzzguard.com.au)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


/**
* Don't display if wordpress admin class is not found
* Protects code if wordpress breaks
* @since 0.1
*/
if ( ! function_exists( 'is_admin' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
}




/**
* Create class styleAdmin() to prevent any function name conflicts with other WordPress plugins or the WordPress core.
* @since 0.1
*/
class styleAdmin {

        /**
        * Loads localization files for each language
        * @since 1.3
        */
        function _action_init()
        {
                // Localization
                load_plugin_textdomain('style-admin', false, 'style-admin/lang/');
        }


        /**
        * Adds the custom logo to the admin panel login page overwritting the default CSS
        * @since 1.2
        */
        function load_js_file()
        {
                wp_enqueue_script('jquery');
                wp_enqueue_script('style-admin', '/wp-content/plugins/style-admin/js/tabs.js');
		wp_enqueue_style('style-admin', '/wp-content/plugins/style-admin/css/tabs.css');
	}

    	/**
     	* Adds the custom logo to the admin panel login page overwritting the default CSS
     	* @since 0.1
     	*/
	function replace_admin_login_logo() {
		$opt_val = get_option( 'style_admin_login_css' );
		if (!empty($opt_val['style_admin_login_logo'])) {
			$logo_path = $opt_val['style_admin_login_logo'];
			echo '<style type="text/css">
				.login h1 a {background: url('.$logo_path.') no-repeat center !important; background-size: auto !important; width: auto !important; text-indent: -9999px !important; height: 80px !important; }
			</style>';
		}
	}

	    /**
     	* Adds the custom logo to the admin panel menu overwritting the default CSS
     	* @since 0.1
     	*/
                function replace_admin_menu_logo() {
                        global $menu;
               	 	$opt_val = get_option( 'style_admin_login_css' );
                	if (!empty($opt_val['style_admin_menu_logo'])) {
                        	$logo_path = $opt_val['style_admin_menu_logo'];
                        	$menu[2][0] = '<div style="text-align:center;"><img src="' . esc_url( $logo_path ) . '" alt="" style="width:150px;" /></div>';
                       	 	$menu[2][5] = 'sa-admin-logo';
                       	 	unset( $menu[4] ); //removes separator
			}
                }

    /**
     * Replaces the CSS in the login page to customize it
     * @since 0.1
     */
function replace_admin_login_css() {
		$returnData = '';
		$SA_CSS_Arr = get_option( 'style_admin_login_css');
	if (is_array( $SA_CSS_Arr)) {
    $returnData = '<style>';
		if (array_key_exists('BGColour', $SA_CSS_Arr) && $SA_CSS_Arr['BGColour_On'] != "D"){
			$returnData .= 'body.login {background: none repeat scroll 0 0 '.$SA_CSS_Arr['BGColour'].' !important; }';

		}
		if (array_key_exists('BoxTextColour', $SA_CSS_Arr) && $SA_CSS_Arr['BoxTextColour_On'] != "D"){
                        $returnData .= 'body.login div#login form#loginform p label {color: '.$SA_CSS_Arr['BoxTextColour'].' !important; }';
		}
		if ($SA_CSS_Arr['LoginRoundedCorners'] == "Y"){
			$returnData .= 'body.login div#login form#loginform {border-radius: 12px 12px 12px 12px !important; }';
			$returnData .= 'body.login div#login form#loginform p.submit input#wp-submit {border-radius: 12px 12px 12px 12px !important;}';
		}
		if (array_key_exists('BoxColour', $SA_CSS_Arr) && $SA_CSS_Arr['BoxColour_On'] != "D"){
                        $returnData .= 'body.login div#login form#loginform {background: none repeat scroll 0 0 '.$SA_CSS_Arr['BoxColour'].' !important; }';
                }
		if (array_key_exists('FooterTextColour', $SA_CSS_Arr) && $SA_CSS_Arr['FooterTextColour_On'] != "D"){
                        $returnData .= 'body.login div#login p#nav a {color: '.$SA_CSS_Arr['FooterTextColour'].' !important; }';
                        $returnData .= 'body.login div#login p#backtoblog a {color: '.$SA_CSS_Arr['FooterTextColour'].' !important; }';
		}
		if (array_key_exists('InputColour', $SA_CSS_Arr) && $SA_CSS_Arr['InputColour_On'] != "D"){
			$returnData .= 'body.login div#login form#loginform input {background: none repeat scroll 0 0 '.$SA_CSS_Arr['InputColour'].' !important; }';
		}
		if (array_key_exists('InputTextColour', $SA_CSS_Arr) && $SA_CSS_Arr['InputTextColour_On'] != "D"){
                        $returnData .= 'body.login div#login form#loginform input {color: '.$SA_CSS_Arr['InputTextColour'].' !important; }';
                }
		if (array_key_exists('SubmitColour', $SA_CSS_Arr) && $SA_CSS_Arr['SubmitColour_On'] != "D"){
			$returnData .= 'body.login div#login form#loginform p.submit input#wp-submit {background: none repeat scroll 0 0 '.$SA_CSS_Arr['SubmitColour'].' !important; border-color: '.$SA_CSS_Arr['SubmitColour'].' !important;}';
		}
		if (array_key_exists('SubmitTextColour', $SA_CSS_Arr) && $SA_CSS_Arr['SubmitTextColour_On'] != "D"){
			$returnData .= 'body.login div#login form#loginform p.submit input#wp-submit {color: '.$SA_CSS_Arr['SubmitTextColour'].' !important; }';
		}
	$returnData .= '</style>';
}

echo $returnData;
}

    /**
     * Adds the Extra Appearance menu option to the Appearance Menu
     * @since 0.1
     */
	function add_extra_option_to_appearance_menu() {
		add_theme_page( 'Style Admin Options', 'Style Admin', 'edit_theme_options', 'style-admin-options', array($this, 'extra_apperance_menu_options'));
	}
	
    /**
     * Displays the Style Admin options page
     * @since 0.1
     */
function extra_apperance_menu_options() {
    //must check that the user has the required capability 
	if ( !current_user_can( 'edit_theme_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}


    // variables for the field and option names 
    $opt_name = 'style_admin_login_css';
    $hidden_field_name = 'style_admin_submit_hidden';
    $data_field_name = 'style_admin_login_css';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[$data_field_name];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put an settings updated message on the screen

?>
<div class="updated"><p><strong><?php _e('settings saved.', 'style-admin' ); ?></strong></p></div>
<?php

    }

    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'Style Admin Options', 'style-admin' ) . "</h2>";

    // settings form
   
 
    ?>
<label><?php _e("Fill out the below fields to customize your Admin login page.", 'style-admin' ); ?></label>

<script type='text/javascript'>  
    jQuery(document).ready(function($) {  
        $('.my-color-picker').wpColorPicker();  
    });

function showSelectColour(id) {
	document.getElementById(id).style.display = "block";
}

function hideSelectColour(id) {
	document.getElementById(id).style.display = "none";
}
</script>
<div class="tabs">
    <ul class="tab-links">
        <li class="active"><a href="#tab1"><?php _e("Image Upload", 'style-admin' ); ?></a></li>
        <li><a href="#tab2"><?php _e("Background Colours", 'style-admin' ); ?></a></li>
        <li><a href="#tab3"><?php _e("Text Colours", 'style-admin' ); ?></a></li>
        <li><a href="#tab4"><?php _e("Styling Options", 'style-admin' ); ?></a></li>
    </ul>

    <div class="tab-content">
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
<div id="tab1" class="tab active">
<hr />
<h3> <?php echo __( 'Image upload', 'style-admin' ); ?> </h3>
<table class="form-table">
<tbody>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Login page logo:  ", 'style-admin' ); ?></label></th>
<td>
<input id="admin_login_logo" class="upload_image" type="text" size="36" name="<?php echo $data_field_name; ?>[style_admin_login_logo]" value="<?php echo $opt_val['style_admin_login_logo']; ?>" />
<input id="admin_login_logo_button" class="upload_image_button button" type="button" value="<?php _e("Upload Image", 'style-admin' ); ?>" />
<p class="description"><?php _e("Enter an URL or upload an image. MAX image size: 300x80", 'style-admin' ); ?></p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Admin panel menu logo:  ", 'style-admin' ); ?></label></th>
<td>
<input id="admin_menu_logo" class="upload_image" type="text" size="36" name="<?php echo $data_field_name; ?>[style_admin_menu_logo]" value="<?php echo $opt_val['style_admin_menu_logo']; ?>" />
<input id="admin_menu_logo_button" class="upload_image_button button"  type="button" value="<?php _e("Upload Image", 'style-admin' ); ?>" />
<p class="description"><?php _e("Enter an URL or upload an image. MAX image size: 300x80", 'style-admin' ); ?></p>

</td>
</tr>

</tbody>
</table>
</div>
<div id="tab2" class="tab">
<hr />

<h3> <?php echo __( 'Background Colours', 'style-admin' ); ?> </h3>
<table class="form-table">
<tbody>
<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Login background colour", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[BGColour_On]" <?php if ($opt_val['BGColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[BGColour]')" />
<label for="<?php echo $data_field_name; ?>[BGColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[BGColour_On]" <?php checked( 'C', $opt_val['BGColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[BGColour]')" />
<label for="<?php echo $data_field_name; ?>[BGColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['BGColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[BGColour]">
<input type="text" value="<?php echo $opt_val['BGColour']; ?>" name="<?php echo $data_field_name; ?>[BGColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['BGColour']; ?>" />
</div>
<p class="description"><?php _e("Login background colour", 'style-admin' ); ?></p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Login Box background colour", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[BoxColour_On]" <?php if ($opt_val['BoxColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[BoxColour]')" />
<label for="<?php echo $data_field_name; ?>[BoxColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[BoxColour_On]" <?php checked( 'C', $opt_val['BoxColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[BoxColour]')" />
<label for="<?php echo $data_field_name; ?>[BoxColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['BoxColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[BoxColour]">
<input type="text" value="<?php echo $opt_val['BoxColour']; ?>" name="<?php echo $data_field_name; ?>[BoxColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['BoxColour']; ?>" />
</div>
<p class="description"><?php _e("Login Box background colour", 'style-admin' ); ?></p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Username/Password Box background colour", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[InputColour_On]" <?php if ($opt_val['InputColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[InputColour]')" />
<label for="<?php echo $data_field_name; ?>[InputColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[InputColour_On]" <?php checked( 'C', $opt_val['InputColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[InputColour]')" />
<label for="<?php echo $data_field_name; ?>[InputColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['InputColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[InputColour]">
<input type="text" value="<?php echo $opt_val['InputColour']; ?>" name="<?php echo $data_field_name; ?>[InputColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['InputColour']; ?>" />
</div>
<p class="description"><?php _e("Username/Password Box background colour", 'style-admin' ); ?><</p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Submit button background color", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[SubmitColour_On]" <?php if ($opt_val['SubmitColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[SubmitColour]')" />
<label for="<?php echo $data_field_name; ?>[SubmitColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[SubmitColour_On]" <?php checked( 'C', $opt_val['SubmitColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[SubmitColour]')" />
<label for="<?php echo $data_field_name; ?>[SubmitColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['SubmitColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[SubmitColour]">
<input type="text" value="<?php echo $opt_val['SubmitColour']; ?>" name="<?php echo $data_field_name; ?>[SubmitColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['SubmitColour']; ?>" />
</div>
<p class="description"><?php _e("Submit button background color", 'style-admin' ); ?></p>
</td>
</tr>
</tbody>
</table>
        </div>
        <div id="tab3" class="tab">
<hr />

<h3> <?php _e( 'Text Colours', 'style-admin' ); ?> </h3>
<table class="form-table">
<tbody>
<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Login footer text colour", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[FooterTextColour_On]" <?php if ($opt_val['FooterTextColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[FooterTextColour]')" />
<label for="<?php echo $data_field_name; ?>[FooterTextColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[FooterTextColour_On]" <?php checked( 'C', $opt_val['FooterTextColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[FooterTextColour]')" />
<label for="<?php echo $data_field_name; ?>[FooterTextColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['FooterTextColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[FooterTextColour]">
<input type="text" value="<?php echo $opt_val['FooterTextColour']; ?>" name="<?php echo $data_field_name; ?>[FooterTextColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['FooterTextColour']; ?>" />
</div>
<p class="description"><?php _e( 'Text Colours', 'style-admin' ); ?></p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Login Box text colour", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[BoxTextColour_On]" <?php if ($opt_val['BoxTextColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[BoxTextColour]')" />
<label for="<?php echo $data_field_name; ?>[BoxTextColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[BoxTextColour_On]" <?php checked( 'C', $opt_val['BoxTextColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[BoxTextColour]')" />
<label for="<?php echo $data_field_name; ?>[BoxTextColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['BoxTextColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[BoxTextColour]">
<input type="text" value="<?php echo $opt_val['BoxTextColour']; ?>" name="<?php echo $data_field_name; ?>[BoxTextColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['BoxTextColour']; ?>" />
</div>
<p class="description"><?php _e("Login Box text colour", 'style-admin' ); ?></p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Submit button text color", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[SubmitTextColour_On]" <?php if ($opt_val['SubmitTextColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[SubmitTextColour]')" />
<label for="<?php echo $data_field_name; ?>[SubmitTextColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[SubmitTextColour_On]" <?php checked( 'C', $opt_val['SubmitTextColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[SubmitTextColour]')" />
<label for="<?php echo $data_field_name; ?>[SubmitTextColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['SubmitTextColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[SubmitTextColour]">
<input type="text" value="<?php echo $opt_val['SubmitTextColour']; ?>" name="<?php echo $data_field_name; ?>[SubmitTextColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['SubmitTextColour']; ?>" />
</div>
<p class="description"><?php _e("Submit button text color", 'style-admin' ); ?></p>
</td>
</tr>

<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Input Box text color", 'style-admin' ); ?>:  </label></th>
<td>
<input type="radio" name="<?php echo $data_field_name; ?>[InputTextColour_On]" <?php if ($opt_val['InputTextColour_On'] != 'C') echo "checked";  ?> value="D" onClick="hideSelectColour('<?php echo $data_field_name; ?>[InputTextColour]')" />
<label for="<?php echo $data_field_name; ?>[InputTextColour_On]"><?php _e( 'Default', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[InputTextColour_On]" <?php checked( 'C', $opt_val['InputTextColour_On'] ); ?> value="C" onClick="showSelectColour('<?php echo $data_field_name; ?>[InputTextColour]')" />
<label for="<?php echo $data_field_name; ?>[InputTextColour_On]"><?php _e( 'Custom', 'style-admin'); ?>
</label>
<div <?php if ($opt_val['InputTextColour_On']!='C') echo 'style="display: none;"'; ?> id="<?php echo $data_field_name; ?>[InputTextColour]">
<input type="text" value="<?php echo $opt_val['InputTextColour']; ?>" name="<?php echo $data_field_name; ?>[InputTextColour]" class="my-color-picker" data-default-color="<?php echo $opt_val['InputTextColour']; ?>" />
</div>
<p class="description"><?php _e("Input Box text color", 'style-admin' ); ?></p>
</td>
</tr>

</tbody>
</table>
        </div>
        <div id="tab4" class="tab">
<hr />

<h3> <?php echo __( 'Styling Options', 'style-admin' ); ?> </h3>
<table class="form-table">
<tbody>
<tr valign="top" style="height: 100px;">
<th scope="row"><label><?php _e("Rounded corners on login box", 'style-admin' ); ?>:  </label></th>
<td><input type="radio" name="<?php echo $data_field_name; ?>[LoginRoundedCorners]" <?php checked( 'Y', $opt_val['LoginRoundedCorners'] ); ?> value="Y" />
<label for="<?php echo $data_field_name; ?>[LoginRoundedCorners]"><?php _e( 'Yes', 'style-admin'); ?>
</label>
<input type="radio" name="<?php echo $data_field_name; ?>[LoginRoundedCorners]" <?php if ($opt_val['LoginRoundedCorners'] != 'Y') echo "checked";  ?> value="N" />
<label for="<?php echo $data_field_name; ?>[LoginRoundedCorners]"><?php _e( 'No', 'style-admin'); ?>
</label>
<p class="description"><?php _e("For rounded corners to be displayed on the login box and the 'Log in' button.", 'style-admin' ); ?></p>
</td>
</tr>
</tbody></table>
</div>
</div>

<hr/>
<p class="submit">
<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
</p>
</form>

</div>
</div>
<?php
}


	function style_admin_script() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', WP_PLUGIN_URL.'/style-admin/uploader.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script('my-upload');
	}
	
	function style_admin_styles() {
		wp_enqueue_style('thickbox');
		wp_enqueue_style( 'wp-color-picker' );  
	}


} //End of styleAdmin() class



/**
* Define the Class
* @since 0.1
*/
$SAClass = new styleAdmin();

/**
* Action of what function to call on wordpress initialization
* @since 1.3
*/
add_action('plugins_loaded', array($SAClass, '_action_init'));

/**
* Action of what function to call to replace the admin panel login page logo
* @since 0.1
*/
add_action('login_head', array($SAClass, 'replace_admin_login_logo'));


/**
* Action of what function to call to replace the admin panel menu logo
* @since 0.1
*/
add_action('admin_menu', array($SAClass, 'replace_admin_menu_logo'));


/**
* Action of what function to call to replace the admin panel login page CSS
* @since 0.1
*/
add_action( 'login_enqueue_scripts', array($SAClass, 'replace_admin_login_css'));

/**
* Action to call custom menu for 'Appearance menu'
* @since 0.1
*/
add_action( 'admin_menu', array($SAClass, 'add_extra_option_to_appearance_menu'));


/**
* Load extra Javascript and styles for Style Admin Options when the plugin is called.
* @since 0.1
*/
if (isset($_GET['page']) && $_GET['page'] == 'style-admin-options') {
	add_action('admin_enqueue_scripts', array($SAClass, 'style_admin_script'));
	add_action('admin_enqueue_scripts', array($SAClass, 'style_admin_styles'));
	add_action( 'admin_enqueue_scripts', array($SAClass, 'load_js_file'));
}
?>
