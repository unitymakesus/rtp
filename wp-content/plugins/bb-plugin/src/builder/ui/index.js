import React from 'react'
import { useSystemState } from 'data'
import { NotificationsManager } from './notifications'
import InlineEditor from './inline-editor'
import { HelpPanel } from './help-panel'
import { SVGSymbols } from './art'
import Workspace from './workspace'
import './assistant'

const UI = () => {
	const { isEditing } = useSystemState()
	return (
		<>
			<InlineEditor />
			<SVGSymbols />
			<NotificationsManager />
			{ isEditing && <>
				<HelpPanel />
				<Workspace />
			</> }
		</>
	)
}

export default UI
