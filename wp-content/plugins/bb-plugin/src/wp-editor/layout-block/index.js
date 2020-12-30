import { LayoutBlockEditConnected } from './edit'
import { LayoutBlockEditConnectedPre_5_3 } from './edit-pre-5-3'
import './index.scss'

const { builder, strings } = FLBuilderConfig
const { version } = FLBuilderConfig.wp
const { registerBlockType } = wp.blocks
const { RawHTML } = wp.element

const getBlockEdit = () => {
	if ( parseFloat( version ) < 5.3 ) {
		return LayoutBlockEditConnectedPre_5_3
	}
	return LayoutBlockEditConnected
}

/**
 * Register the block.
 */
if ( ( builder.access && builder.unrestricted ) || builder.enabled ) {
	registerBlockType( 'fl-builder/layout', {
		title: strings.title,
		description: strings.description,
		icon: 'welcome-widgets-menus',
		category: 'layout',
		useOnce: true,
		supports: {
			customClassName: false,
			className: false,
			html: false,
		},
		attributes: {
			content: {
				type: 'string',
				source: 'html',
			},
		},
		edit: getBlockEdit(),
		save( { attributes } ) {
			return <RawHTML>{ attributes.content }</RawHTML>
		},
	} )
}
