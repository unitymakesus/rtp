import React from 'react'
import { useSystemState } from 'data'
import { NotificationsManager } from './notifications'
import InlineEditor from './inline-editor'
import ShortcutsPanel from './shortcuts-panel'
import { SVGSymbols } from './art'
import PanelManager from './panel-manager'
import './style.scss'

/**
 * Builder React-based UI Root
 *
 * Gets rendered onto the page and remains.
 */
const BeaverBuilderUI = () => {
	const { isEditing, shouldShowShortcuts } = useSystemState()
	return (
		<>
			<InlineEditor />
			{ isEditing && (
				<>
					<SVGSymbols />
					<NotificationsManager />
					{ shouldShowShortcuts && <ShortcutsPanel /> }
					<PanelManager />
				</>
			) }
		</>
	)
}

export default BeaverBuilderUI
