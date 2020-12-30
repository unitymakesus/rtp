import { BuilderMoreMenuItemConnected } from './menu-item'
import { BuilderMoreMenuItemConnectedPre_5_3 } from './menu-item-pre-5-3'

const { version } = FLBuilderConfig.wp
const { registerPlugin } = wp.plugins

const getMenuItemComponent = () => {
	if ( parseFloat( version ) < 5.3 ) {
		return BuilderMoreMenuItemConnectedPre_5_3
	}
	return BuilderMoreMenuItemConnected
}

/**
 * Register the builder more menu plugin.
 */
registerPlugin( 'fl-builder-plugin-sidebar', {
	icon: 'welcome-widgets-menus',
	render: getMenuItemComponent(),
} );
