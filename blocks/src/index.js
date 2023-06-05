import { registerBlockType } from '@wordpress/blocks';
import { TextControl } from '@wordpress/components';

registerBlockType(
    'an/block',
    {
        title: 'Basic Block',
        description: 'Our first block',
        icon: 'smiley',
        category: 'posts',
        attributes: {
            content: {
                type: 'string',
                default: 'Hello World'
            }
        },
        edit: (props) => {
            const { attributes: { content }, setAttributes, className, isSelected } = props;
            const handlerOnChangeInput = (newContent) => {
                setAttributes({ content: newContent });
            };
            return (
                <TextControl
                    label="Fill the field"
                    value={content}
                    onChange={handlerOnChangeInput}
                />
            )
        },
        save: () => null,
    }
)