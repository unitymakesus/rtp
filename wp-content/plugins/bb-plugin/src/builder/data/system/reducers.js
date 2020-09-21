export const shouldShowShortcuts = ( state = false, action ) => {

	switch ( action.type ) {
	case 'SET_SHOULD_SHOW_SHORTCUTS':
		return action.value ? true : false
	default:
		return state
	}
}

export const panels = ( state = {}, action ) => {

	switch ( action.type ) {
	case 'REGISTER_PANEL':
		return {
			...state,
			[action.handle] : action.options
		}
	default:
		return state
	}
}

export const currentPanel = ( state = null, action ) => {

	switch ( action.type ) {
	case 'SET_CURRENT_PANEL':
		return action.name
	case 'HIDE_CURRENT_PANEL':
		return null
	case 'TOGGLE_PANEL':
		return action.name === state ? null : action.name
	default:
		return state
	}
}

export const isEditing = ( state = true, action ) => {
	switch ( action.type ) {
	case 'SET_IS_EDITING':
		return action.value ? true : false
	default:
		return state
	}
}

export const colorScheme = ( state = 'light', action ) => {
	switch ( action.type ) {
	case 'SET_COLOR_SCHEME':
		return 'dark' === action.value ? 'dark' : 'light'
	default:
		return state
	}
}
