var SimpleDonatePluginDialog = {
	init : function(ed) {
		// var dom = ed.dom, f = document.forms[0], n = ed.selection.getNode(), w;
	},

	update : function() {
		var ed = tinyMCEPopup.editor;
	
	
		var shortcode = "[simpledonate";

		shortcode += ' item_name="' + $("input[name=item_label]").val() + '"';

		$("#itemlist li").each(function (index) {
			number = index + 1;
			shortcode += ' amt' + number + '="' + $(this).find("input.amt").val() + '" label' + number + '="' + $(this).find("input.label").val() + '"';
		});

		if($("input[name=other_label]").length){
			shortcode += ' label_other="' + $("input[name=other_label]").val() + '"';
		}
		if($("input[name=other_step]").length){
			shortcode += ' other_step="' + $("input[name=other_step]").val() + '"';
		}
		shortcode += ' button_text="' + $("input[name=submit_button_text]").val() + '"';

		shortcode += " ]";

		ed.execCommand("mceInsertContent", false, shortcode);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(SimpleDonatePluginDialog.init, SimpleDonatePluginDialog);