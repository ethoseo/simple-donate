(function() {
	tinymce.create('tinymce.plugins.SimpleDonatePlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mceSimpleDonate', function() {
				ed.windowManager.open({
					file : url + '/simpledonate.htm',
					width : 600 + parseInt(ed.getLang('simpledonate.delta_width', 0)),
					height : 300 + parseInt(ed.getLang('simpledonate.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});

			// Register buttons
			ed.addButton('simpledonate', {title : 'Simple Donate', cmd : 'mceSimpleDonate', image: url + '/simpledonate.png' });
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : 'Simple Donate',
				author : 'Ethoseo Internet Marketing',
				authorurl : 'http://www.ethoseo.com/',
				infourl : 'http://www.ethoseo.com/tools/simple-donate',
				version : '1.0'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('simpledonate', tinymce.plugins.SimpleDonatePlugin);
})();