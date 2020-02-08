(function() {

    tinymce.PluginManager.add('pushortcodes', function( editor )
    {
        var shortcodeValues = [];

        jQuery.each(shortcodes_button, function(i, val) {
            //console.log(i);
            shortcodeValues.push({text: val.title, value:i});
        });
        editor.addButton('pushortcodes', {
            type: 'listbox',
            text: 'Shortcodes',
            onselect: function(e) {
                var v = this.value();
                var content;
                content = '[' + v;

                if ( shortcodes_button[v].atts ) {
                    var atts = shortcodes_button[v].atts;
                    jQuery.each(atts, function(i, val) {
                        console.log(i);
                        console.log(val);
                        content += ' ' + i + '="' + val + '"'
                    });
                }

                content += ']';

                if ( shortcodes_button[v].closed ) {
                    content += '[/' + v + ']';
                }

                tinyMCE.activeEditor.selection.setContent( content );
            },
            values: shortcodeValues
        });
    });
})();