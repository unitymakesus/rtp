import { Component } from 'react'
import './style.scss'

/**
 * Handles inline editing for builder layouts.
 *
 * @since 2.1
 * @class InlineEditor
 */
class InlineEditor extends Component {
	constructor( props ) {
		super( props )
		const { postId } = this.props
		this.layoutClass = `.fl-builder-content-${ postId ? postId : FLBuilderConfig.postId }`
	}

	componentDidMount() {
		this.setupHooks = this.setupHooks.bind( this )
		this.hooked = false
		jQuery( document ).on( 'tinymce-editor-init', this.setupHooks )
		this.setupHooks()
	}

	setupHooks() {
		if ( 'ontouchstart' in document ) {
			return
		}
		if ( ! window.tinymce || this.hooked || ! FLBuilderConfig.inlineEnabled ) {
			return
		}

		const initEditables = this.initEditables.bind( this )
		const refreshEditables = this.refreshEditables.bind( this )

		//const destroyEditables = this.destroyEditables.bind( this )
		const destroyAllEditables = this.destroyAllEditables.bind( this )
		const destroyLoadingEditables = this.destroyLoadingEditables.bind( this )

		if ( FLBuilder ) {

			// Init actions
			FLBuilder.addHook( 'settingsConfigLoaded', initEditables )
			FLBuilder.addHook( 'restartEditingSession', initEditables )

			// Destroy actions
			FLBuilder.addHook( 'endEditingSession', destroyAllEditables )
			FLBuilder.addHook( 'didStartNodeLoading', destroyLoadingEditables )

			// Refresh actions
			FLBuilder.addHook( 'didRenderLayoutComplete', refreshEditables )
			FLBuilder.addHook( 'didDeleteRow', refreshEditables )
			FLBuilder.addHook( 'didDeleteColumn', refreshEditables )
			FLBuilder.addHook( 'didDeleteModule', refreshEditables )
		}

		this.initEditables()
		this.hooked = true
	}

	initEditables() {
		const { editables } = FLBuilderSettingsConfig
		const content = jQuery( this.layoutClass )

		if ( content.length ) {
			for ( const key in editables ) {
				const selector = `.fl-module[data-type="${ key }"]:not(.fl-editable):not(.fl-node-global)`
				content.find( selector ).each( ( index, module ) => {
					module = jQuery( module )
					module.addClass( 'fl-editable' )
					module.delegate( '.fl-block-overlay', 'click.fl-inline-editing-init', e => this.initEditable( e, module ) )
				} )
			}
		}
	}

	initEditable( e, module ) {
		const { preview } = FLBuilder

		// Don't setup if we have a parent that needs to save.
		if ( preview ) {
			const isParent = module.parents( `.fl-node-${ preview.nodeId }` ).length
			if ( isParent && preview._settingsHaveChanged() ) {
				return
			}
		}

		this.setupEditable( module, () => {
			this.onModuleOverlayClick( e )
		} )

		module.undelegate( '.fl-block-overlay', 'click.fl-inline-editing-init' )
	}

	setupEditable( module, callback = () => {} ) {
		const nodeId = module.data( 'node' )
		const settings = FLBuilderSettingsConfig.nodes[ nodeId ]

		if ( 'undefined' === typeof settings ) {
			return false
		}

		const type = module.data( 'type' )
		const config = FLBuilderSettingsConfig.editables[ type ]
		const nodeClass = `.fl-node-${ nodeId } `
		const editorId = `fl-inline-editor-${ nodeId }`
		const overlay = jQuery( `<div id="${ editorId }" class="fl-inline-editor"></div>` )
		const form = jQuery( `.fl-builder-settings[data-node=${ nodeId }]` )
		const { connections } = settings

		module.append( overlay )
		module.delegate( '.fl-block-overlay', 'click', this.onModuleOverlayClick.bind( this ) )
		module.on( 'mouseleave', this.onModuleMouseleave.bind( this ) )

		for ( const key in config ) {
			const data = config[ key ]
			const selector = FLBuilderPreview.getFormattedSelector( nodeClass, data.selector )
			const editable = jQuery( selector )
			const editableHTML = editable.html()
			const connection = form.find( `#fl-field-${ key } .fl-field-connection-value` )

			if ( ! editable.length ) {
				continue
			} else if ( connection.length && '' !== connection.val() ) {
				continue
			} else if ( ! connection.length && connections && connections[ key ] ) {
				continue
			}

			if ( editable.hasClass( 'mce-content-body' ) ) {
				tinymce.execCommand( 'mceRemoveEditor', true, editable.attr( 'id' ) )
			} else {
				editable.data( 'field', data.field )
				editable.on( 'drop', this.onEditorDrop.bind( this ) )
			}


			tinymce.init( {
				selector,
				inline: true,
				menubar: false,
				paste_as_text: true,
				relative_urls: false,
				convert_urls: false,
				skin: FLBuilder ? false : 'lightgray',
				skin_url: FLBuilder ? false : `${ tinyMCEPreInit.baseURL }/skins/lightgray/`,
				theme: 'modern',
				theme_url: `${ tinyMCEPreInit.baseURL }/themes/modern/`,
				fixed_toolbar_container: `#${ editorId }`,
				plugins: this.getEditorPluginConfig( data.field.type ),
				toolbar: 'string' === typeof data.field.toolbar ? data.field.toolbar : this.getEditorToolbarConfig( data.field.type ),
				init_instance_callback: ( editor ) => {
					this.onEditorInit( editor )

					/**
					 * TinyMCE can change the editable's HTML which changes the visual
					 * appearance. To prevent this from happening, we reinsert the original
					 * HTML after the editable has been initialized.
					 */
					editable.html( editableHTML )
					callback()
				},
			} )
		}
	}

	getEditorPluginConfig( type ) {
		switch ( type ) {
		case 'editor':
			return 'wordpress, wplink, lists, paste'

		default:
			return 'paste'
		}
	}

	getEditorToolbarConfig( type ) {
		switch ( type ) {
		case 'editor':
			return 'bold italic strikethrough link underline | alignleft aligncenter alignright'

		case 'unit':
			return false

		default:
			return 'bold italic strikethrough underline'
		}
	}

	destroyEditables( modules ) {
		const editables = modules.find( '.mce-content-body' )
		const overlays = modules.find( '.fl-inline-editor' )
		const extras = jQuery( '.wplink-autocomplete, .ui-helper-hidden-accessible' )

		editables.removeAttr( 'contenteditable' )
		modules.undelegate( '.fl-block-overlay', 'click' )
		modules.off( 'mouseleave' )
		modules.removeClass( 'fl-editable' )
		overlays.remove()
		extras.remove()
	}

	destroyAllEditables() {
		const content = jQuery( this.layoutClass )
		const modules = content.find( '.fl-editable' )

		this.destroyEditables( modules )
	}

	destroyLoadingEditables( e, node ) {
		let modules = jQuery( node )

		if ( ! modules.hasClass( 'fl-module' ) ) {
			modules = modules.find( '.fl-module' )
		}

		this.destroyEditables( modules )
	}

	refreshEditables() {
		this.initEditables()
		tinymce.editors.map( editor => {
			if ( editor.inline && ! jQuery( `#${ editor.id }` ).length ) {
				setTimeout( () => tinymce.execCommand( 'mceRemoveEditor', true, editor.id ), 1 )
			}
		} )
	}

	getEditorEventVars( target ) {
		const editable = jQuery( target ).closest( '.mce-content-body' )
		const editor = tinymce.get( editable.attr( 'id' ) )
		const field = editable.data( 'field' )
		const module = editable.closest( '.fl-module' )
		const nodeId = module.data( 'node' )

		return { editable, module, editor, field, nodeId }
	}

	onEditorInit( editor ) {
		editor.on( 'change', this.onEditorChange.bind( this ) )
		editor.on( 'keyup', this.onEditorChange.bind( this ) )
		editor.on( 'undo', this.onEditorChange.bind( this ) )
		editor.on( 'redo', this.onEditorChange.bind( this ) )
		editor.on( 'focus', this.onEditorFocus.bind( this ) )
		editor.on( 'blur', this.onEditorBlur.bind( this ) )
		editor.on( 'mousedown', this.onEditorMousedown.bind( this ) )
	}

	onEditorChange( e ) {

		const target = e.target.bodyElement ? e.target.bodyElement : e.target
		const { editor, field, nodeId } = this.getEditorEventVars( target )
		const settings = jQuery( `.fl-builder-settings[data-node="${ nodeId }"]` )
		const content = editor.getContent()

		if ( ! settings.length ) {
			return
		} else if ( 'editor' === field.type ) {
			const textarea = settings.find( `#fl-field-${ field.name } textarea.wp-editor-area` )
			const editorId = textarea.attr( 'id' )
			if ( textarea.closest( '.tmce-active' ).length ) {
				tinymce.get( editorId ).setContent( content )
			} else {
				textarea.val( content )
			}
		} else {
			const textarea = document.createElement( 'textarea' )
			textarea.innerHTML = content
			settings.find( `[name="${ field.name }"]` ).val( textarea.value )
		}
	}

	onEditorFocus( e ) {
		const { editable, editor, module, field, nodeId } = this.getEditorEventVars( e.target.bodyElement )
		const overlay = module.find( '.fl-inline-editor' )
		const settingHTML = this.getSettingHTML( nodeId, field )

		if ( ! this.matchHTML( editor.getContent(), settingHTML ) ) {
			editable.data( 'original', {
				settingHTML,
				editableHTML: editable.html(),
			} )
			editable.css( 'min-height', editable.height() )
			editor.setContent( settingHTML )
			editor.selection.select( editor.getBody(), true )
			editor.selection.collapse( false )
		}

		if ( editor.settings.toolbar ) {
			overlay.removeClass( 'fl-inline-editor-no-toolbar' )
		} else {
			overlay.addClass( 'fl-inline-editor-no-toolbar' )
		}

		module.addClass( 'fl-editable-focused' )
		this.showEditorOverlay( module )
		this.showModuleSettings( module )
	}

	onEditorBlur( e ) {
		const { editable, editor, module } = this.getEditorEventVars( e.target.bodyElement )
		const overlay = module.find( '.fl-inline-editor' )
		const original = editable.data( 'original' )

		overlay.removeClass( 'fl-inline-editor-no-toolbar' )
		module.removeClass( 'fl-editable-focused' )

		if ( original && this.matchHTML( editor.getContent(), original.settingHTML ) ) {
			editable.html( original.editableHTML )
			editable.css( 'min-height', '' )
		}
	}

	onEditorMousedown( e ) {
		const { module } = this.getEditorEventVars( e.target )
		this.showEditorOverlay( module )
	}

	onEditorDrop( e ) {
		e.preventDefault()
		return false
	}

	onModuleOverlayClick( e ) {
		const actions = jQuery( e.target ).closest( '.fl-block-overlay-actions' )
		const module = jQuery( e.currentTarget ).closest( '.fl-module' )
		const editorId = module.find( '.mce-content-body' ).first().attr( 'id' )

		if ( actions.length || FLBuilder._colResizing ) {
			return
		}
		if ( editorId ) {
			tinymce.get( editorId ).focus()
			module.addClass( 'fl-editable-focused' )
		}
	}

	onModuleMouseleave() {
		const panels = jQuery( '.mce-inline-toolbar-grp:visible, .mce-floatpanel:visible' )

		if ( ! panels.length ) {
			this.hideEditorOverlays()
			this.showNodeOverlays()
		}
	}

	showEditorOverlay( module ) {
		const overlay = module.find( '.fl-inline-editor' )
		this.hideNodeOverlays()
		this.hideEditorOverlays()
		overlay.show()

		const active = jQuery( '.fl-inline-editor-active-toolbar' )
		active.removeClass( 'fl-inline-editor-active-toolbar' )

		const toolbar = overlay.find( '> .mce-panel:visible' )
		toolbar.addClass( 'fl-inline-editor-active-toolbar' )
	}

	hideEditorOverlays() {
		jQuery( '.fl-inline-editor, .mce-floatpanel' ).hide()
	}

	showNodeOverlays() {
		jQuery( '.fl-block-overlay' ).show()
	}

	hideNodeOverlays() {
		jQuery( '.fl-block-overlay' ).hide()
	}

	showModuleSettings( module ) {
		const type = module.data( 'type' )
		const nodeId = module.data( 'node' )
		const parentId = module.closest( '.fl-col' ).data( 'node' )
		const global = module.hasClass( 'fl-node-global' )
		const settings = jQuery( `.fl-builder-settings[data-node="${ nodeId }"]` )

		if ( ! settings.length ) {
			FLBuilder._showModuleSettings( { type,	nodeId, parentId, global } )
		}
	}

	getSettingValue( nodeId, name ) {
		const form = jQuery( `.fl-builder-settings[data-node="${ nodeId }"]` )
		let settings = {}

		if ( form.length ) {
			settings = FLBuilder._getSettings( form )
		} else {
			settings = FLBuilderSettingsConfig.nodes[ nodeId ]
		}

		return settings[ name ]
	}

	getSettingHTML( nodeId, field ) {
		const html = this.getSettingValue( nodeId, field.name )

		if ( 'editor' === field.type && '' !== html ) {
			return wp.editor.autop( html )
		}

		return html
	}

	matchHTML( a, b ) {
		return this.cleanHTML( a ) === this.cleanHTML( b )
	}

	cleanHTML( html ) {
		const re = /(\r\n|\n|\r)/gm
		return jQuery( `<div>${ html }</div>` ).html().trim().replace( re, '' )
	}

	render() {
		return null
	}
}

export default InlineEditor
