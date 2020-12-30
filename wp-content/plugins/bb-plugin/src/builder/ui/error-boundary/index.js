import React from 'react'

/**
 * Catches errors in the builder UI and renders a fallback
 * modal for attempting to reboot.
 *
 * This might also be a good place for a link to common error
 * fixes such as switching themes or deactivating plugins.
 *
 * @since 2.1
 * @class ErrorBoundary
 */
class ErrorBoundary extends React.Component {

	constructor( props ) {
		super( props )
		this.state = { hasError: false }
	}

	componentDidCatch( error, info ) {
		this.setState( { hasError: true } )
		console.log( 'Builder UI Error:', error, info )
	}

	render() {
		if ( this.state.hasError ) {

			// TODO: Return fallback UI modal for rebooting.
		}

		return this.props.children
	}
}

export default ErrorBoundary
