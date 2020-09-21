import {
	registerStore,
	useStore,
	getStore,
	getDispatch,
	getSelectors
} from '../registry'

import * as actions from './actions'
import * as reducers from './reducers'
import * as effects from './effects'
import * as selectors from './selectors'

const key = 'fl-builder/system'

registerStore( key, {
	actions,
	reducers,
	effects,
	selectors,
	state: {
		isEditing: true,
		currentPanel: null,
		shouldShowShortcuts: false,
		colorScheme: FLBuilderConfig.userSettings.skin,
		panels: {},
	}
} )

export const useSystemState = () => useStore( key )
export const getSystemStore = () => getStore( key )
export const getSystemState = () => getStore( key ).getState()
export const getSystemActions = () => getDispatch( key )
export const getSystemSelectors = () => getSelectors( key )
