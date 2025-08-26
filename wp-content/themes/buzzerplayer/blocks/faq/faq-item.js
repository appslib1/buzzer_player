// faq-item.js

( function( blocks, element, editor ) {
    var el = element.createElement;
    var RichText = editor.RichText;
    var __ = wp.i18n.__;

    blocks.registerBlockType( 'my-custom-block/faq-item', {
        title: __( 'FAQ Item' ),
        icon: 'menu',
        category: 'common',
        
        attributes: {
            question: {
                type: 'string',
            },
            answer: {
                type: 'string',
            },
        },

        edit: function( props ) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            function onChangeQuestion( newQuestion ) {
                setAttributes( { question: newQuestion } );
            }

            function onChangeAnswer( newAnswer ) {
                setAttributes( { answer: newAnswer } );
            }

            return el(
                'div',
                { style: { border: '1px solid #ddd', padding: '10px', marginBottom: '10px' } },
                el( RichText, {
                    tagName: 'h3',
                    placeholder: __( 'Enter a question' ),
                    value: attributes.question,
                    onChange: onChangeQuestion,
                } ),
                el( RichText, {
                    tagName: 'p',
                    placeholder: __( 'Enter an answer' ),
                    value: attributes.answer,
                    onChange: onChangeAnswer,
                } )
            );
        },

        save: function() {
            // Save function is not needed for InnerBlocks
            return null;
        }
    } );
}(
    window.wp.blocks,
    window.wp.element,
    window.wp.editor
) );