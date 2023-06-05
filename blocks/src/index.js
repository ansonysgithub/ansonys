import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { TextControl, PanelBody, PanelRow } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType(
    'an/block',
    {
        title: 'Basic Block',
        description: 'Our first block',
        icon: 'smiley',
        category: 'products',
        attributes: {
            content: {
                type: 'string',
                default: 'Hello World'
            }
        },
        edit: (props) => {
            const { attributes: { content }, setAttributes, className, isSelected } = props;

            const handlerOnChangeInput = (newContent) => {
                setAttributes({ content: newContent })
            }

            return <>
                <InspectorControls>
                    <PanelBody
                        title="Modify text of Basic Block"
                        initialOpen={false}
                    >
                        <PanelRow>
                            <TextControl
                                label="Fill the fields"
                                value={content}
                                onChange={handlerOnChangeInput}
                            />
                        </PanelRow>
                    </PanelBody>
                </InspectorControls>
                <ServerSideRender
                    block="an/block"
                    attributes={props.attributes}
                />
            </>
        },
        save: () => null,
    }
)