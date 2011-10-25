<?php
if($_POST['hide']){
	update_option("ethoseoSD_hide_ethoseo", true);
}
?>
<div style="float: right; width: 300px;">
	<a href="http://www.ethoseo.com/?utm_campaign=WordPress-Plugins&utm_medium=inplugin&utm_source=Simple-Donate"><img src="http://www.ethoseo.com/displaylogo/?type=pluginby&context=plugin-simple-donate&location=<?php echo urlencode(site_url()); ?>" alt="Plugin By Ethoseo" /></a>
<?php
if(!get_option("ethoseoSD_hide_ethoseo")){
?>
	<div class="donation_reqs" style="border-top: 1px solid #dadada; margin-top: 10px;">
		<h3>Feed Our Coffee Habit</h3>
		<form action="https://www.paypal.com/cgi-bin/webscr" id="sd_paypalform" method="post"><ul class="sd_hidden_form" style="display: none;"><li><label class="sd_label_radio"><input type="radio" name="sd_radio" class="sd_object sd_usermod sd_radio" value="2.50" />Cup</label></li><li><label class="sd_label_radio"><input type="radio" name="sd_radio" class="sd_object sd_usermod sd_radio" value="14.50" />Pound</label></li><li><label class="sd_label_radio donate_other_radio_label"><input type="radio" name="sd_radio" class="sd_object sd_usermod sd_radio donate_other_radio" value="donateother" />Other </label></li></ul><input type="number" name="amount" value="" class="sd_object other_amt paypal_object sd_usermod" /><input type="hidden" name="cmd" value="_donations" id="cmd"/><input type="hidden" name="no_shipping" value="2"/><input type="hidden" name="no_note" value="1"/><input type="hidden" name="tax" value="0"/><input type="hidden" name="business" value="info@ethoseo.com" class="sd_object paypal_object" /><input type="hidden" name="bn" value="Ethoseo Internet Marketing" class="sd_object paypal_object"/><input type="hidden" name="item_name" value="Coffee Love" class="sd_object paypal_object"/><input type="hidden" name="currency_code" value="USD" class="sd_object paypal_object"/><input type="submit" name="submit" value="Brew" class="sd_object" id="sd_submit" /></form><script type="text/javascript">
			jQuery(function(){
				jQuery(".sd_hidden_form").show();
				jQuery(".sd_object.other_amt.paypal_object").appendTo(".sd_hidden_form .donate_other_radio_label").attr("name","other_amt").removeClass("paypal_object");
				jQuery("#sd_paypalform #sd_submit").before('<input type="hidden" name="amount" value="' + jQuery(".other_amt").val() + '" class="sd_object paypal_object" id="paypal_amount" />');
				
				jQuery(".sd_object.sd_usermod").change(function() {
					jQuery(".sd_error_amt").remove();
					if(jQuery(this).attr("type") == "radio"){
						if(!jQuery(this).hasClass("other_amt") && !jQuery(this).hasClass("donate_other_radio")){
							jQuery("#sd_paypalform #paypal_amount").val(jQuery(this).val());
						}
					}else{
						jQuery("#sd_paypalform #paypal_amount").val(jQuery("#sd_paypalform .other_amt").val());
					}
				});
			});
		</script>
		<script>
			/*
			 * jQuery replaceText - v1.1 - 11/21/2009
			 * http://benalman.com/projects/jquery-replacetext-plugin/
			 * 
			 * Copyright (c) 2009 "Cowboy" Ben Alman
			 * Dual licensed under the MIT and GPL licenses.
			 * http://benalman.com/about/license/
			 */
			(function($){$.fn.replaceText=function(b,a,c){return this.each(function(){var f=this.firstChild,g,e,d=[];if(f){do{if(f.nodeType===3){g=f.nodeValue;e=g.replace(b,a);if(e!==g){if(!c&&/</.test(e)){$(f).before(e);d.push(f)}else{f.nodeValue=e}}}}while(f=f.nextSibling)}d.length&&$(d).remove()})}})(jQuery);
		</script>
		<script>
			function checkChecker() {
				if (jQuery('.sd_object.sd_usermod').length) {
					jQuery('.sd_label_radio').removeClass('checked');
					jQuery('.sd_label_radio input:checked').each(function(){ 
						jQuery(this).parent('.sd_label_radio').addClass('checked');
					});
				};
			}
			jQuery(function(){
				checkChecker();
				var coffee_images = {"Cup" : "<?php echo plugins_url( 'images/coffee_cup.png' , __FILE__ ); ?>","Pound" : "<?php echo plugins_url( 'images/coffee_pound.png' , __FILE__ ); ?>", "Other" : "<?php echo plugins_url( 'images/coffee_other.png' , __FILE__ ); ?>"};
				jQuery.each(coffee_images,function (text,image) {
					jQuery(".sd_label_radio:contains("+ text +")").replaceText(text,'<img src="' + image + '" alt="' + text + '" title="' + text + '" />');
				});
				jQuery("#sd_paypalform").addClass("imaged");
				jQuery(".sd_object.sd_usermod").change(function() {
					checkChecker();
				});
			});
		</script>
	</div>
	<form method="POST" style="border-top: 1px solid #dadada;  text-align: right; margin-top: 10px; padding-top: 5px;"><input type="submit" name="hide" value="Hide This Forever" class="button" style="color: #888" /></form>
<?php
}
?>
</div>