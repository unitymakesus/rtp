import React from 'react'
import classname from 'classnames'
import { Icon } from '../../art'
import './style.scss'

export const Panel = ( {
	className,
	children,
	title,
	actions,
	showCloseButton = true,
	onClose = () => {},
	...rest
} ) => {

	const classes = classname( {
		'fl-ui-panel-area': true,
	}, className )

	const TrailingActions = () => {

		if ( ! actions && ! showCloseButton ) {
			return null
		}

		return (
			<div className="fl-ui-panel-trailing-actions">
				{actions}
				<button onClick={ onClose } className="fl-ui-button">
					<Icon.Close />
				</button>
			</div>
		)
	}

	const stopProp = e => e.stopPropagation()

	return (
		<div className={ classes } onClick={ onClose }>
			<div className="fl-ui-panel" { ...rest } onClick={ stopProp }>
				<div className="fl-ui-panel-topbar">
					{ title && <div className="fl-ui-panel-title">{title}</div> }
					<TrailingActions />
				</div>
				<div className="fl-ui-panel-content">{children}</div>
			</div>
		</div>
	)
}
