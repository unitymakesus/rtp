import React from 'react'
import { Panel } from './panel'
import { getSystemActions } from 'data'
import './style.scss'

const ShortcutsList = ( { shortcuts } ) => {

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

const ShortcutsPanel = () => {
	const { setShouldShowShortcuts } = getSystemActions()
	return (
		<Panel
			title="Keyboard Shortcuts"
			onClose={ () => setShouldShowShortcuts( false ) }
			className="fl-ui-help"
			style={ {
				width: 360,
				maxWidth: '95vw',
			} }
		>
			<ShortcutsList shortcuts={ FLBuilderConfig.keyboardShortcuts } />
		</Panel>
	)
}

export default ShortcutsPanel
