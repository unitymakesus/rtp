import React from 'react'
import './style.scss'

export const SVGSymbols = () => {
	return (
		<svg id="fl-symbol-container" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<symbol id="fl-down-caret" viewBox="0 0 11 6">
				<polygon points="0 0 2.05697559 0 5.49235478 3.74058411 8.93443824 0 11 0 5.5 6"></polygon>
			</symbol>
		</svg>
	)
}

export const Icon = () => {}

Icon.Close = () => {
	return (
		<svg width="14px" height="14px" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<g stroke="currentColor" strokeWidth="2" fill="none" fillRule="evenodd" strokeLinecap="round">
				<path d="M13,1 L1,13"></path>
				<path d="M1,1 L13,13"></path>
			</g>
		</svg>
	)
}
Icon.Close.displayName = 'Icon.Close'
