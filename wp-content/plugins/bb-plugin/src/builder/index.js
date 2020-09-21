import React from 'react'
import { render } from 'react-dom'
import UI from './ui'

// Setup Store Registry and Initialize System Store
import * as data from './data'

const { registerPanel, displayPanel, togglePanel } = data.getSystemActions()

// Setup public API - window.FL.Builder
const api = window.FL || {}
const existing = api.Builder || {}

const Builder = {
	...existing,
	ui: {},
	data,
	registerPanel,
	displayPanel,
	togglePanel,
}

window.FL = {
	...api,
	Builder,
}

// Render UI
const root = document.getElementById( 'fl-ui-root' )
root.classList.add( 'fluid' )

render( <UI />, root )
