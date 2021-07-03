(function( $ ) {
    'use strict';
    
    // Load GOOGLE Fonts From API
    $.ajax({
        url: 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDRWRR6LLMivK9e_H5BQXtcdy8vGS56igg',
        method: 'GET',
        dataType: 'json',
        success: function(fonts){
            $.each(fonts.items, function(k, v){
                var fontFamily = v.family.replace(/ /g, '+');
                var fontName = v.family;
                $('#googleFontsPicker').append('<option value="'+ fontFamily +'">'+ fontName +'</option>');
                var selectedFont = $('#selectedFont').text();
                $('#googleFontsPicker').val(selectedFont).attr('selected', true);
            });
        }
    });

	var editor, editorSettings;

    if ( ! $( '.sccss-content' ).length ) {
        return;
    }
    editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};

    editorSettings.codemirror = _.extend( {}, editorSettings.codemirror, {
        lineNumbers: true,
        lineWrapping: true,
        indentUnit: 2,
        tabSize: 2,
        mode: 'css',
        lint: true,
        gutters: ['CodeMirror-lint-markers'],
        theme: 'mdn-like'
    } );

    editor = wp.codeEditor.initialize( $( '.sccss-content' ), editorSettings );

    $('.checkinoutColorPicker').wpColorPicker();

})( jQuery );
