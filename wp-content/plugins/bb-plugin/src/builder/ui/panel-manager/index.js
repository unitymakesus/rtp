import React, { Fragment } from 'react'
import c from 'classnames'
import { Root as AppCoreRoot } from '@beaverbuilder/app-core'
import { useSystemState } from 'data'
import DefaultFrame from './frame'
import './style.scss'

const handleObjectOrFunction = obj => {
	return 'function' === typeof obj ? obj() : obj
}

const PanelManager = () => {
	const { currentPanel, panels, colorScheme } = useSystemState()

	let panel = null
	if ( currentPanel in panels ) {
		panel = panels[currentPanel]
	} else {
		return null
	}

	const {
		routerProps,
		onHistoryChanged,
		root,
		render,
		frame = DefaultFrame, // Allows frame component to be overriden by registered panel
		className: panelClassName,
		wrapClassName
	} = panel

	const Frame = false === frame ? Fragment : frame
	const PanelContent = root ? root : render /* support legacy render prop */
	const wrapClasses = c( { [`fluid-color-scheme-${colorScheme}`]: colorScheme }, wrapClassName )

	return (
		<div className={ wrapClasses }>
			<Frame className={ false !== frame && panelClassName }>
				<AppCoreRoot
					routerProps={ handleObjectOrFunction( routerProps ) }
					onHistoryChanged={ onHistoryChanged }
					colorScheme={ colorScheme }
				>
					<PanelContent />
				</AppCoreRoot>
			</Frame>
		</div>
	)
}

export default PanelManager
