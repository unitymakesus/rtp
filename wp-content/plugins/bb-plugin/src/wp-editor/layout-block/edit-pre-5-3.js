const { builder, strings, urls } = FLBuilderConfig
const { rawHandler, serialize } = wp.blocks
const { Button, Placeholder, Spinner } = wp.components
const { compose } = wp.compose
const { subscribe, withDispatch, withSelect } = wp.data
const { Component } = wp.element

/**
 * Edit component for WordPress versions before 5.3.
 */
class LayoutBlockEditPre_5_3 extends Component {
	constructor() {
		super( ...arguments )
		this.unsubscribe = subscribe( this.storeDidUpdate.bind( this ) )
	}

	storeDidUpdate() {
		const { isLaunching, isSavingPost } = this.props
		if ( isLaunching && ! isSavingPost ) {
			this.unsubscribe()
			this.redirectToBuilder()
		}
	}

	componentDidMount() {
		const { blockCount } = this.props
		if ( 1 === blockCount ) {
			this.toggleEditor( 'disable' )
		}
	}

	componentWillUnmount() {
		this.unsubscribe()
		this.toggleEditor( 'enable' )
	}

	render() {
		const { blockCount, onReplace, isLaunching } = this.props
		let label, callback, description

		if ( 1 === blockCount ) {
			label = builder.access ? strings.launch : strings.view
			callback = this.launchBuilder.bind( this )
		} else {
			label = strings.convert
			callback = this.convertToBuilder.bind( this )
		}

		if ( builder.enabled ) {
			description = strings.active
		} else {
			description = strings.description
		}

		if ( false === builder.showui ) {
			return '';
		}

		return (
			<Placeholder
				key='placeholder'
				instructions={ description }
				icon='welcome-widgets-menus'
				label={ strings.title }
				className='fl-builder-layout-launch-view'
			>
				{ isLaunching &&
					<Spinner />
				}
				{ ! isLaunching &&
					<Button
						isLarge
						isPrimary
						type='submit'
						onClick={ callback }
					>
						{ label }
					</Button>
				}
				{ ! isLaunching &&
					<Button
						isLarge
						type='submit'
						onClick={ this.convertToBlocks.bind( this ) }
					>
						{ strings.editor }
					</Button>
				}
			</Placeholder>
		)
	}

	toggleEditor( method = 'enable' ) {
		const { classList } = document.body
		const enabledClass = 'fl-builder-layout-enabled'

		if ( 'enable' === method ) {
			if ( classList.contains( enabledClass ) ) {
				classList.remove( enabledClass )
			}
		} else {
			if ( ! classList.contains( enabledClass ) ) {
				classList.add( enabledClass )
			}
		}
	}

	redirectToBuilder() {
		window.location.href = builder.access ? urls.edit : urls.view
	}

	launchBuilder() {
		const { savePost, setLaunching } = this.props
		setLaunching( true )
		savePost()
	}

	convertToBuilder() {
		const { clientId, blocks, setAttributes, removeBlocks } = this.props
		const content = serialize( blocks )
		const clientIds = blocks.map( ( block ) => block.clientId ).filter( ( id ) => id !== clientId )

		setAttributes( { content: content.replace( /<!--(.*?)-->/g, '' ) } )
		removeBlocks( clientIds )
		this.launchBuilder()
	}

	convertToBlocks() {
		const { attributes, clientId, replaceBlocks, onReplace } = this.props

		if ( attributes.content && ! confirm( strings.warning ) ) {
			return
		} else if ( attributes.content ) {
			replaceBlocks( [ clientId ], rawHandler( {
				HTML: attributes.content,
				mode: 'BLOCKS',
			} ) )
		}
		else {
			onReplace( [] )
		}
	}
}

/**
 * Connect the edit component to editor data.
 */
export const LayoutBlockEditConnectedPre_5_3 = compose(
	withDispatch( ( dispatch, ownProps ) => {
		const editor = dispatch( 'core/editor' )
		const builder = dispatch( 'fl-builder' )
		return {
			savePost: editor.savePost,
			removeBlocks: editor.removeBlocks,
			replaceBlocks: editor.replaceBlocks,
			setLaunching: builder.setLaunching,
		}
	} ),
	withSelect( ( select ) => {
		const editor = select( 'core/editor' )
		const builder = select( 'fl-builder' )
		return {
			blockCount: editor.getBlockCount(),
			blocks: editor.getBlocks(),
			isSavingPost: editor.isSavingPost(),
			isLaunching: builder.isLaunching(),
		}
	} ),
)( LayoutBlockEditPre_5_3 )
