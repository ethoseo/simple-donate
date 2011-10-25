<?php
/*
Plugin Name: Simple Donate
Plugin URI: http://www.ethoseo.com/tools/simple-donate
Description: Simple Donate is an easy way to create a PayPal donation form that allows donors to select their contribution amount. It is great for non-profits and political campaigns.
Version: 1.0
Author: Ethoseo Internet Marketing
Author URI: http://www.ethoseo.com
License: GPL2
	
	 Copyright 2011 Ethoseo Internet Marketing <info@ethoseo.com>
	 This program is free software; you can redistribute it and/or modify
	 it under the terms of the GNU General Public License as published by
	 the Free Software Foundation; version 2 of the License (GPL v2) only.

	 This program is distributed in the hope that it will be useful,
	 but WITHOUT ANY WARRANTY; without even the implied warranty of
	 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
	 GNU General Public License for more details.

	 You should have received a copy of the GNU General Public License
	 along with this program; if not, write to the Free Software
	 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA	02110-1301	USA
*/


$ethoseoSD_version = "1.0";

add_action('admin_menu', 'ethoseoSD_add_to_menu');

function ethoseoSD_add_to_menu() {
	$ethoseoSD_admin_page = add_options_page("Simple Donate", "Simple Donate", "activate_plugins", "simple-donate", "ethoseoSD_admin_page" );
	add_action('admin_head-' . $ethoseoSD_admin_page, 'ethoseoSD_admin_css');
}


if(!get_option("ethoseoSD_paypal_business")){
	add_action('admin_notices', 'ethoseoSD_admin_notice_not_config');

	function ethoseoSD_admin_notice_not_config() {
		if(current_user_can('activate_plugins')){
			echo '<div class="error">
				<p>Simple Donate <a href="' . admin_url() . 'options-general.php?page=simple-donate"><strong>must</strong> be configured</a> to work.</p>
			</div>';
		}
	}
}

function ethoseoSD_admin_css() {
	global $ethoseoSD_version;
	echo "<link rel='stylesheet' href='" . plugins_url( 'css/admin.css?ver=' . $ethoseoSD_version , __FILE__ ) . "' type='text/css' media='all'/>";
}

function ethoseoSD_admin_page() {
	if (!current_user_can('activate_plugins'))	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	global $wpdb;
	function echoif($bool, $false = "", $true = FALSE) {
		if($bool){
			if($true){
				echo $true;
			}else{
				echo $bool;
			}
		}else{
			echo $else;
		}
	}
	?>
<div class="wrap">
<!--
Hi There <?php 
global $current_user;
echo $current_user->display_name;
?>!
You're reading the code, that means I think you're pretty awesome. <?php /* Especially if you're reading the PHP code. */ ?>
This plugin uses the Paypal Button API to create donate buttons with different levels.
If you have a better way of doing this or anything else, or want to talk WordPress, PHP, internet marketing, or similarly nerdy things drop me an email: <nick@ethoseo.com>.
Enjoy The Plugin!
--
Nick of Ethoseo Internet Marketing
-->
	<div id="icon-simple-donate" class="icon32"><br /></div><h2>Simple Donate</h2>
	<?php
		if($_POST['submit'] == "Save Changes"){
			update_option("ethoseoSD_paypal_business", $_POST['paypal_business']);
			update_option("ethoseoSD_paypal_bn", $_POST['paypal_bn']);
			update_option("ethoseoSD_paypal_currency_code", $_POST['paypal_currency_code']);
			update_option("ethoseoSD_maxdonate", $_POST['maxdonate']);
			update_option("ethoseoSD_maxdonate_amt", $_POST['maxdonate_amt']);
			update_option("ethoseoSD_trackanalytics", $_POST['trackanalytics']);

			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}
	?>
	<?php include "ethoseo.php"; ?>
	<p>To use this plugin use the shortcode [simpledonate] using the Simple Donate Button or creating your own, using <a href="http://www.ethoseo.com/tools/simple-donate">our API</a></p>
	<form method="POST">
		<h3>Organization Info</h3>
		<table class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th scope="row"><label for="paypal_business">PayPal Email Address</label></th>
				<td>
					<input name="paypal_business" type="text" id="paypal_business" class="regular-text" value="<?php echoif(get_option("ethoseoSD_paypal_business")); ?>" />
					<span class="description">The email you have registered with PayPal</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="paypal_bn">Organization Name</label></th>
				<td>
					<input name="paypal_bn" type="text" id="paypal_bn" class="regular-text" value="<?php echoif(get_option("ethoseoSD_paypal_bn")); ?>" />
					<span class="description">This <em>may</em> show up on the PayPal Checkout Page.</span>
				</td>
			</tr>
		</table>
		<h3>Payment Info</h3>
		<table class="form-table" style="clear: left; width: auto;">
			<tr valign="top">
				<th scope="row"><label for="paypal_currency_code">Currency Code</label></th>
				<td>
					<select name="paypal_currency_code" id="paypal_currency_code">
						<option value='AUD' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "AUD"),"",'selected="selected"'); ?>>AUD</option>
						<option value='CAD' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "CAD"),"",'selected="selected"'); ?>>CAD</option>
						<option value='CZK' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "CZK"),"",'selected="selected"'); ?>>CZK</option>
						<option value='DKK' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "DKK"),"",'selected="selected"'); ?>>DKK</option>
						<option value='EUR' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "EUR"),"",'selected="selected"'); ?>>EUR</option>
						<option value='HUF' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "HUF"),"",'selected="selected"'); ?>>HUF</option>
						<option value='JPY' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "JPY"),"",'selected="selected"'); ?>>JPY</option>
						<option value='NOK' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "NOK"),"",'selected="selected"'); ?>>NOK</option>
						<option value='NZD' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "NZD"),"",'selected="selected"'); ?>>NZD</option>
						<option value='PLN' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "PLN"),"",'selected="selected"'); ?>>PLN</option>
						<option value='GBP' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "GBP"),"",'selected="selected"'); ?>>GBP</option>
						<option value='SGD' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "SGD"),"",'selected="selected"'); ?>>SGD</option>
						<option value='SEK' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "SEK"),"",'selected="selected"'); ?>>SEK</option>
						<option value='CHF' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "CHF"),"",'selected="selected"'); ?>>CHF</option>
						<option value='USD' <?php echoif((get_option("ethoseoSD_paypal_currency_code") == "USD" || get_option("ethoseoSD_paypal_currency_code") == ""),"",'selected="selected"'); ?>>USD</option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="maxdonate">Set A Maximum Donation</label></th>
				<td>
					<input name="maxdonate" type="checkbox" id="maxdonate" value="true" <?php echoif(get_option("ethoseoSD_maxdonate"),"",'checked="checked"'); ?>/>
					<span class="description">In some instances there may be a legislated maximum donation amount from a single party. Check this if that is the case.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="maxdonate_amt">Set A Maximum Donation</label></th>
				<td>
					<input name="maxdonate_amt" type="number" id="maxdonate_amt" class="small-text" value="<?php echoif(get_option("ethoseoSD_maxdonate_amt")); ?>" />
					<span class="description">If you choose to have a maximum donation limit, set the amount here.</span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="trackanalytics">Track Donations Using Google Analytics</label></th>
				<td>
					<input name="trackanalytics" type="checkbox" id="trackanalytics" value="true" <?php echoif(get_option("ethoseoSD_trackanalytics"),"",'checked="checked"'); ?>/>
					<span class="description">If you use Google Analytics, this is highly reccomended.</span>
				</td>
			</tr>
		</table>
		<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"	/></p>
	</form>
</div>
	<?php
}

add_action('wp_enqueue_scripts', 'ethoseoSD_enqueue_jquery');

function ethoseoSD_enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
}

function convert_to_bool ( $items, $keys = FALSE) {
	if($keys){
		foreach($keys as $key){
			$new_f_items[$key] = $items[$key];
		}
		$items = $new_f_items;
	}
	foreach($items as $key => $item){
		if($item == "true" || $item == "1" || $item == "yes"){
			$new_items[$key] = true;
		}else{
			$new_items[$key] = false;
		}
	}
	return $new_items;
}

function returnif($bool, $false = "", $true = FALSE) {
	if($bool){
		if($true){
			echo $true;
		}else{
			echo $bool;
		}
	}else{
		echo $else;
	}
}

function ethoseoSD_eb_shortcode( $atts ) {



	//	CONVERT ATTRIBUTES TO USABLE VARIABLES
	//		Convert Amounts and Labels into Arrays
	for($i = 1;$i; $i++){
		if($atts["amt" . $i] && $atts["label" . $i]){
			$options[$i] = array(
				"amt" => $atts["amt" . $i],
				"label" => $atts["label" . $i]
			);
		}else{
			break;
		}
	}
	//		Convert Booleans
	$bools = convert_to_bool($atts, array("repeat","debug"));
	$allow_debug = $bools['debug'] && current_user_can('activate_plugins');

	//	CREATE OBJECT

	$return_SD = '<form action="https://www.paypal.com/cgi-bin/webscr" id="sd_paypalform" method="post">';

	$return_SD .= '<ul class="sd_hidden_form" style="display: none;">';
	foreach($options as $option){
		$return_SD .= '<li><label class="sd_label_radio"><input type="radio" name="sd_radio" class="sd_object sd_usermod sd_radio" value="' . $option['amt'] . '" />' . $option['label'] . '</label></li>';
	}
	$return_SD .= '<li><label class="sd_label_radio donate_other_radio_label"><input type="radio" name="sd_radio" class="sd_object sd_usermod sd_radio donate_other_radio" value="donateother" />' . returnif($atts['label_other'],"Other:") . ' </label></li>';

	$return_SD .= '</ul>';

	
	$return_SD .= '<input type="number" name="amount" max="' . get_option("ethoseoSD_maxdonate_amt") . '" step="' . $atts['other_step'] . '" class="sd_object other_amt paypal_object sd_usermod" />';

	//		Hidden Bits
	//			Constant
	$return_SD .=	
		'<input type="hidden" name="cmd" value="_donations" id="cmd"/>' .
		'<input type="hidden" name="no_shipping" value="2"/>' .
		'<input type="hidden" name="no_note" value="1"/>' .
		'<input type="hidden" name="tax" value="0"/>';
	//			User Set
	$return_SD .= '<input type="hidden" name="business" value="' . get_option("ethoseoSD_paypal_business") . '" class="sd_object paypal_object" />';
	$return_SD .= '<input type="hidden" name="bn" value="' . get_option("ethoseoSD_paypal_bn") . '" class="sd_object paypal_object"/>';
	$return_SD .= '<input type="hidden" name="item_name" value="' . $atts['item_name'] . '" class="sd_object paypal_object"/>';
	$return_SD .= '<input type="hidden" name="currency_code" value="' . get_option("ethoseoSD_paypal_currency_code") . '" class="sd_object paypal_object"/>';
	$return_SD .= '<input type="submit" name="submit" value="' . $atts['button_text'] . '" class="sd_object" id="sd_submit" />';

	$return_SD .= '</form>';

	//		Javascript
	$return_SD .= '<script type="text/javascript">';

	$return_SD .= '
			jQuery(function(){
				jQuery(".sd_hidden_form").show();
				jQuery(".sd_object.other_amt.paypal_object").appendTo(".sd_hidden_form .donate_other_radio_label").attr("name","other_amt").removeClass("paypal_object");
				jQuery("#sd_paypalform #sd_submit").before(\'<input type="hidden" name="amount" value="\' + jQuery(".other_amt").val() + \'" class="sd_object paypal_object" id="paypal_amount" />\');
				
				jQuery(".sd_object.sd_usermod").change(function() {
					jQuery(".sd_error_amt").remove();
					if(jQuery(this).attr("type") == "radio"){
						if(!jQuery(this).hasClass("other_amt") && !jQuery(this).hasClass("donate_other_radio")){';
						if($allow_debug){
							$return_SD .= 'console.debug("Set Amount to: " + jQuery(this).val());';
						}
						$return_SD .= 'jQuery("#sd_paypalform #paypal_amount").val(jQuery(this).val());
						}
					}else{';
	if(get_option("ethoseoSD_maxdonate")){
		$return_SD .= '
							if(parseInt(jQuery("#sd_paypalform .other_amt").val()) <= ' . get_option("ethoseoSD_maxdonate_amt") . '){
								jQuery("#sd_paypalform #paypal_amount").val(jQuery("#sd_paypalform .other_amt").val());
							} else {
								jQuery("#sd_paypalform #paypal_amount").val("' . get_option("ethoseoSD_maxdonate_amt") . '");
								jQuery("#sd_paypalform .other_amt").val("' . get_option("ethoseoSD_maxdonate_amt") . '");
								jQuery("#sd_paypalform").prepend(\'<div class="sd_error sd_error_amt">You contribution is above the maximum allowed amount. It has been lowered to the maximum.</div>\');
							}';
	}else{
		if($allow_debug){
			$return_SD .= '
													console.debug("Set Val: " + jQuery("#sd_paypalform .other_amt").val());';
		}
		$return_SD .= '
										jQuery("#sd_paypalform #paypal_amount").val(jQuery("#sd_paypalform .other_amt").val());';
	}
	$return_SD .= '
					}
				});';
	if(get_option("ethoseoSD_trackanalytics")){
		$return_SD .= '
					jQuery("#sd_paypalform").submit(function() {
						if(!(jQuery("#sd_paypalform .other_amt").val() == "" && jQuery(".donate_other_radio:checked").length)){
							if(jQuery("#paypal_amount").attr("name") == "a3"){
								_gaq.push([\'_trackEvent\', \'Donate\', \'Subscribe\', \'Monthly\',jQuery("#paypal_amount").val]);
							} else {
								_gaq.push([\'_trackEvent\', \'Donate\', \'One Time\', \'One Time\',jQuery("#paypal_amount").val]);
							}
							return true;
						}else{
							return false;
						}
					});';
	}
	$return_SD .= '
			});
		</script>';


	//	DEBUG VALUES
	$debug = "<pre>" . json_encode($options) . "</pre>";
	if($allow_debug){
		$return_SD .= $debug;
	}

	//	RETURN OBJECT
	return $return_SD;
}
add_shortcode('simpledonate', 'ethoseoSD_eb_shortcode');

// Add TinyMCE Button
function ethoseoSD_addbuttons() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_ethoseoSD_tinymce_plugin");
		add_filter('mce_buttons', 'register_ethoseoSD_button');
	}
}

function register_ethoseoSD_button($buttons) {
	array_push($buttons, "|", "simpledonate");
	return $buttons;
}

function add_ethoseoSD_tinymce_plugin($plugin_array) {
	$plugin_array['simpledonate'] = plugins_url('mce/editor_plugin.js', __FILE__ );
	return $plugin_array;
}

// init process for button control
add_action('init', 'ethoseoSD_addbuttons'); 
?>