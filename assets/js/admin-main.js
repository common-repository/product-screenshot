/**
 * Product screenshot admin js.
 *
 * Handle all admin option js of the plugin.
 *
 * @since 1.0.0
 */

( function ( $ ) {

    ( function () {
        var prscrtShortcodeField = $( '.prscrt-shortcode-field input[data-depend-id="shortcode_output"]' ),
            shortcode = prscrtShortcodeField.attr( 'placeholder' ),
            postID = prscrtShortcodeField.attr( 'data-prscrt-id' );
    
        if ( 'string' === typeof postID && '' !== postID && 0 < postID.length ) {
            prscrtShortcodeField.val( shortcode );
        }
    } )();

} )( jQuery );