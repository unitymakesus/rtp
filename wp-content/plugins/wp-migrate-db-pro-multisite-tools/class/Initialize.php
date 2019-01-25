<?php

namespace DeliciousBrains\WPMDBMST;

use DeliciousBrains\WPMDB\Container;

class Initialize {

	public function __construct() { }

	public function registerAddon() {
		$container = Container::getInstance();
		$container->add( 'mst_addon', 'DeliciousBrains\WPMDBMST\MultisiteToolsAddon' )
		          ->withArguments( [
			          'addon',
			          'properties',
			          'dynamic_properties',
			          'multisite',
			          'util',
			          'migration_state_manager',
			          'table',
			          'table_helper',
			          'form_data',
			          'template',
			          'profile_manager'
		          ] );

		$container->add( 'mst_addon_cli', 'DeliciousBrains\WPMDBMST\CliCommand\MultisiteToolsAddonCli' )
		          ->withArguments( [
			          'addon',
			          'properties',
			          'dynamic_properties',
			          'multisite',
			          'util',
			          'migration_state_manager',
			          'table',
			          'table_helper',
			          'form_data',
			          'template',
			          'profile_manager',
			          'cli'
		          ] );
	}
}
