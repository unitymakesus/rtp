export const setShouldShowShortcuts = value => {
	return {
		type: 'SET_SHOULD_SHOW_SHORTCUTS',
		value
	}
}

export const registerPanel = ( handle = 'fl/untitled', options = {} ) => {

	const defaults = {
		label: '',
		render: () => {},
		className: null,
		routerProps: {},
		onHistoryChanged: () => {}
	}
	return {
		type: 'REGISTER_PANEL',
		handle,
		options: { ...defaults, ...options },
	}
}

export const displayPanel = ( name = null ) => {
	return {
		type: 'SET_CURRENT_PANEL',
		name,
	}
}

export const togglePanel = ( name = null ) => {
	return {
		type: 'TOGGLE_PANEL',
		name,
	}
}

export const hideCurrentPanel = () => ({
	type: 'HIDE_CURRENT_PANEL'
})

export const setIsEditing = ( value = true ) => {
	return {
		type: 'SET_IS_EDITING',
		value,
	}
}

export const setColorScheme = ( value = 'light' ) => {
	return {
		type: 'SET_COLOR_SCHEME',
		value,
	}
}
