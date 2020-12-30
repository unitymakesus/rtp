const { builder, strings, urls } = FLBuilderConfig
const { rawHandler, serialize } = wp.blocks
const { Button, Placeholder, Spinner } = wp.components
const { compose } = wp.compose
const { withDispatch, withSelect } = wp.data
const { Component } = wp.element

/**
 * Edit Component
 */
class LayoutBlockEdit extends Component {
	constructor() {
		super( ...arguments )
	}

	componentDidMount() {
		const { blockCount } = this.props
		if ( 1 === blockCount ) {
			this.toggleEditor( 'disable' )
		}
	}

	componentWillUnmount() {
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

	launchBuilder() {
		const { savePost, setLaunching } = this.props
		setLaunching( true )
		savePost().then( () => {
			setTimeout( function() {
				window.location.href = builder.access ? urls.edit : urls.view
			}, 2000 );
		} )
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
export const LayoutBlockEditConnected = compose(
	withDispatch( ( dispatch, ownProps ) => {
		const blockEditor = dispatch( 'core/block-editor' )
		const editor = dispatch( 'core/editor' )
		const builder = dispatch( 'fl-builder' )
		return {
			removeBlocks: blockEditor.removeBlocks,
			replaceBlocks: blockEditor.replaceBlocks,
			savePost: editor.savePost,
			setLaunching: builder.setLaunching,
		}
	} ),
	withSelect( ( select ) => {
		const blockEditor = select( 'core/block-editor' )
		const editor = select( 'core/editor' )
		const builder = select( 'fl-builder' )
		return {
			blockCount: blockEditor.getBlockCount(),
			blocks: blockEditor.getBlocks(),
			isLaunching: builder.isLaunching(),
		}
	} ),
)( LayoutBlockEdit )
