import React from 'react'
import c from 'classnames'

const Frame = ( { className, ...rest } ) => {
	const classes = c( 'fl-builder-workspace-panel', className )
	return (
		<div
			className={ classes }
			{ ...rest }
		/>
	)
}

export default Frame
