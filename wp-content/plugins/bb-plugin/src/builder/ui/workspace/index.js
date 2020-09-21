import React from 'react'
import classname from 'classnames'
import { __ } from '@wordpress/i18n'
import { useSystemState } from 'data'
import { App } from 'fluid/ui'
import './style.scss'

const Panel = ({ children, className, ...rest }) => {
    const classes = classname({
        'fl-builder-workspace-panel' : true,
    }, className )

    return <div className={classes} {...rest}>{children}</div>
}

const Workspace = ({ className }) => {
    const { currentPanel, panels, colorScheme } = useSystemState()
    let panel = null
    if ( currentPanel in panels ) {
        panel = panels[currentPanel]
    }

    if ( !panel ) return null

    const { routerProps, onHistoryChanged, render } = panel

    const classes = classname({
        'fl-builder-workspace' : true,
        [`fluid-color-scheme-${colorScheme}`]: colorScheme,
    }, className )

    return (
        <div className={classes}>
            { panel && (
                <App
                    routerProps={ 'function' === typeof routerProps ? routerProps() : routerProps }
                    onHistoryChanged={onHistoryChanged}
                    colorScheme={colorScheme}
                >
                    <Panel className={panel.className}>
                        { render() }
                    </Panel>
                </App>
            ) }
        </div>
    )
}

export default Workspace
