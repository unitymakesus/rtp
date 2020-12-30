const { registerStore } = wp.data

const DEFAULT_STATE = {
	launching: false,
}

const actions = {
	setLaunching( launching ) {
		return {
			type: 'SET_LAUNCHING',
			launching,
		}
	},
}

const selectors = {
	isLaunching( state ) {
		return state.launching
	},
}

registerStore( 'fl-builder', {
	reducer( state = DEFAULT_STATE, action ) {
		switch ( action.type ) {
		case 'SET_LAUNCHING':
			state.launching = action.launching
		}

		return state
	},
	actions,
	selectors,
} )
