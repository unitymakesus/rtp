import './menu-item-pre-5-3.scss'

const { strings } = FLBuilderConfig
const { createBlock, serialize } = wp.blocks
const { Button } = wp.components
const { compose } = wp.compose
const { withDispatch, withSelect } = wp.data
const { PluginSidebarMoreMenuItem } = wp.editPost
const { Component } = wp.element

/**
 * Builder menu item for the more menu pre WordPress 5.3.
 *
 * More menu items currently only support opening a sidebar.
 * However, we need a click event. For now, that is done in a
 * hacky manner with an absolute div that contains the event.
 * This should be reworked in the future when API supports it.
 */
class BuilderMoreMenuItemPre_5_3 extends Component {
	render() {
		return (
			<PluginSidebarMoreMenuItem>
				<div
					className='fl-builder-plugin-sidebar-button'
					onClick={ this.menuItemClicked.bind( this ) }>
				</div>
				{ this.hasBuilderBlock() ? strings.launch : strings.convert }
			</PluginSidebarMoreMenuItem>
		)
	}

	hasBuilderBlock() {
		const { blocks } = this.props
		const builder = blocks.filter( ( block ) => 'fl-builder/layout' === block.name )

		return !! builder.length
	}

	menuItemClicked() {
		const { closeGeneralSidebar } = this.props

		if ( this.hasBuilderBlock() ) {
			this.launchBuilder()
		} else {
			this.convertToBuilder()
		}

		// Another hack because we can't have click events yet :(
		setTimeout( closeGeneralSidebar, 100 )
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
		savePost()
	}
}

/**
 * Connect the menu item to editor data.
 */
export const BuilderMoreMenuItemConnectedPre_5_3 = compose(
	withDispatch( ( dispatch, ownProps ) => {
		const editor = dispatch( 'core/editor' )
		const editPost = dispatch( 'core/edit-post' )
		const builder = dispatch( 'fl-builder' )
		return {
			savePost: editor.savePost,
			insertBlock: editor.insertBlock,
			removeBlocks: editor.removeBlocks,
			closeGeneralSidebar: editPost.closeGeneralSidebar,
			setLaunching: builder.setLaunching,
		}
	} ),
	withSelect( ( select ) => {
		const editor = select( 'core/editor' )
		return {
			blocks: editor.getBlocks(),
		}
	} ),
)( BuilderMoreMenuItemPre_5_3 )
