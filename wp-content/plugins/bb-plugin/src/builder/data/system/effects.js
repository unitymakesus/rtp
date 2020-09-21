/**
 * Effects that fire before an action.
 */
export const before = {}

/**
 * Effects that fire after an action.
 */
export const after = {
	TOGGLE_PANEL: ( action, store ) => {
		const { currentPanel } = store.getState()
		const html = document.querySelector('html')

		if ( currentPanel ) {
			FLBuilder._closePanel()
		}

		if ( 'fl/assistant' === currentPanel ) {
			html.classList.add( 'fl-builder-assistant-visible' )
		} else {
			html.classList.remove( 'fl-builder-assistant-visible' )
		}
	},
	HIDE_CURRENT_PANEL: ( action, store ) => {
		const html = document.querySelector('html')
		html.classList.remove( 'fl-builder-assistant-visible' )
	}
}
