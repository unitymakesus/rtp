import React from 'react'
import { Panel } from './panel'
import { useSystemState, getSystemActions } from 'data'
import './style.scss'

const ShortcutList = ( { shortcuts } ) => {

	if ( 0 === Object.keys( shortcuts ).length ) {
		return null
	}

	return (
		<ul className="fl-ui-shortcut-list">
			{ Object.values( shortcuts ).map( ( item, i ) => {
				const { label, keyLabel } = item
				const key = { __html: keyLabel }
				return (
					<li key={ i }>
						<span>{label}</span>
						<span
							className="fl-ui-shortcut-item-keycode"
							dangerouslySetInnerHTML={ key }
						/>
					</li>
				)
			} ) }
		</ul>
	)
}

export const HelpPanel = () => {
	const { shouldShowShortcuts } = useSystemState()
	const { setShouldShowShortcuts } = getSystemActions()
	const dismissPanel = () => setShouldShowShortcuts( false )

	if ( ! shouldShowShortcuts ) {
		return null
	}

	const style = {
		width: 360,
		maxWidth: '95vw',
	}

	return (
		<Panel
			title="Keyboard Shortcuts"
			onClose={ dismissPanel }
			className="fl-ui-help"
			style={ style }
		>
			<ShortcutList shortcuts={ FLBuilderConfig.keyboardShortcuts } />
		</Panel>
	)
}
