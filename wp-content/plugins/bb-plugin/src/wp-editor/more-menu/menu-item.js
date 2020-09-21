const { builder, strings, urls } = FLBuilderConfig
const { createBlock, serialize } = wp.blocks
const { Button } = wp.components
const { compose } = wp.compose
const { withDispatch, withSelect } = wp.data
const { PluginMoreMenuItem } = wp.editPost
const { Component } = wp.element

/**
 * Builder menu item for the more menu.
 */
class BuilderMoreMenuItem extends Component {
	render() {
		return (
			<PluginMoreMenuItem onClick={ this.menuItemClicked.bind( this ) }>
				{ this.hasBuilderBlock() ? strings.launch : strings.convert }
			</PluginMoreMenuItem>
		)
	}

	hasBuilderBlock() {
		const { blocks } = this.props
		const builder = blocks.filter( ( block ) => 'fl-builder/layout' === block.name )

		return !! builder.length
	}

	menuItemClicked() {
		if ( this.hasBuilderBlock() ) {
			this.launchBuilder()
		} else {
			this.convertToBuilder()
		}
	}

	convertToBuilder() {
		const { blocks, insertBlock, removeBlocks } = this.props
		const clientIds = blocks.map( ( block ) => block.clientId )
		const content = serialize( blocks ).replace( /<!--(.*?)-->/g, '' )
		const block = createBlock( 'fl-builder/layout', { content } )

		insertBlock( block, 0 )
		removeBlocks( clientIds )
	}

	launchBuilder() {
		const { savePost, setLaunching } = this.props
		setLaunching( true )
		savePost().then( () => {
			setTimeout( function() {
				window.location.href = builder.access ? urls.edit : urls.view
			}, 2000 );
		} )
	}
}

/**
 * Connect the menu item to editor data.
 */
export const BuilderMoreMenuItemConnected = compose(
	withDispatch( ( dispatch, ownProps ) => {
		const blockEditor = dispatch( 'core/block-editor' )
		const editor = dispatch( 'core/editor' )
		const builder = dispatch( 'fl-builder' )
		return {
			insertBlock: blockEditor.insertBlock,
			removeBlocks: blockEditor.removeBlocks,
			savePost: editor.savePost,
			setLaunching: builder.setLaunching,
		}
	} ),
	withSelect( ( select ) => {
		const blockEditor = select( 'core/block-editor' )
		return {
			blocks: blockEditor.getBlocks(),
		}
	} ),
)( BuilderMoreMenuItem )
