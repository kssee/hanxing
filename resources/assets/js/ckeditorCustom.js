if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
    CKEDITOR.tools.enableHtml5Elements( document );

CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';

var initCkeditor = ( function() {
    var wysiwygareaAvailable = isWysiwygareaAvailable(),
        isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

    return function() {
        var editorElement = CKEDITOR.document.getById( 'editor' );

        if ( isBBCodeBuiltIn ) {
            editorElement.setHtml(
                ''
            );
        }
        if ( wysiwygareaAvailable ) {
            CKEDITOR.replace('editor', {
                //"filebrowserImageUploadUrl": "/ckeditor/plugins/imgupload.php"
                filebrowserBrowseUrl: '/browser/browse.php',
                filebrowserUploadUrl: '/uploader/upload.php'
            });
        } else {
            editorElement.setAttribute( 'contenteditable', 'true' );
            CKEDITOR.inline( 'editor' );
        }
    };

    function isWysiwygareaAvailable() {
        if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
            return true;
        }

        return !!CKEDITOR.plugins.get( 'wysiwygarea' );
    }
} )();