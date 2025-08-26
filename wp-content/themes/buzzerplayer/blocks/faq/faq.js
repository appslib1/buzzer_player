// my-custom-block.js

( function( blocks, element, editor ) {
    var el = element.createElement;
    var RichText = editor.RichText;
    var __ = wp.i18n.__;

    blocks.registerBlockType( 'my-custom-block/faq', {
        title: __( 'FAQ Block' ),
        icon: 'menu',
        category: 'common',
        
        // Define attributes without source or selector for dynamic blocks
        attributes: {
            title: {
                type: 'string',
            },
            description: {
                type: 'string',
            },
        },

        edit: function( props ) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            function onChangeTitle( newTitle ) {
                setAttributes( { title: newTitle } );
            }

            function onChangeDescription( newDescription ) {
                setAttributes( { description: newDescription } );
            }

            return el(
                'div',
                { style: { border: '1px solid #900', padding: '10px' } },
                el( RichText, {
                    tagName: 'h2',
                    placeholder: __( 'Enter a title' ),
                    value: attributes.title,
                    onChange: onChangeTitle,
                } ),
                el( RichText, {
                    tagName: 'p',
                    placeholder: __( 'Enter a description' ),
                    value: attributes.description,
                    onChange: onChangeDescription,
                } )
            );
        },

        save: function() {
            // This function must return null for blocks with a PHP render_callback.
            return null;
        }
    } );
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.editor
) );