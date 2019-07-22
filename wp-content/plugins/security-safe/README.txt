=== WP Security Safe ===
Contributors: sovstack, freemius
Tags: firewall, disable XML-RPC, security, wp security, privacy, security audit, file permissions, brute force login
Requires at least: 3.5
Requires PHP: 5.3
Tested up to: 5.2.1
Stable tag: trunk

A plugin to quickly implement WordPress hardening and security techniques.

== Description ==

Wp Security Safe is a freemium WordPress security plugin. For more advanced features, upgrade to the professional version.

Free Features:

* Firewall With Logs and Charts
* Disable XML-RPC.php
* Hide WordPress CMS Version
* Hide Script Versions
* Make Website Anonymous During Updates
* Enable Automatic Core, Plugin, and Theme Updates
* Disable Editing Theme Files
* Audit & Fix File Permission
* Audit Hosting Software Versions
* Login Security
* Brute Force Protection
* Content Copyright Protection
* 404 Error Logging
* Turn On/Off All Security Policies Easily

Pro Features:

* All Free Features 
* Bulk Fix File Permissions
* Make Theme Versions Private
* Make Plugin Versions Private
* Automatically Fix Theme/Plugin File Permissions
* Import/Export Settings
* Pro Plugin Updates
* Priority Support

== Installation ==

1. Install WP Security Safe automatically or by uploading the ZIP file to your plugins folder. 
2. Activate the WP Security Safe on the 'Plugins' admin page. The plugin initially sets minimum security policies active.
3. Navigate to the General Settings by clicking on the WP Security Safe menu located on the left side admin panel.
4. On General Settings, You will notice the main icon menu at the top of the page. Navigate through all of them and change settings as they pertain to your site's needs.
5. Test your site thoroughly. If you notice that your site is not functioning as expected, you can turn off each type of security policy (Privacy, Files, User Access, etc.) by navigating to each page and disabling the policy type. If necessary, you can disable all policy types at once using General Settings.

== Screenshots ==

1. Privacy Settings
2. File Settings
3. File Permissions
4. Server Software
5. User Access Settings
6. Content Settings

== Changelog ==

= 2.1.1 (Medium Priority) = 
*Release Date - 15 July 2019*
* Bug Fix: Session handling conflicted with some admin features in oddball scenarios
* Improvement: Fixed a PHP Warning

= 2.1.0 (Medium Priority) = 
*Release Date - 15 July 2019*
* Bug Fix: WP Cron activities were not recording to activity log (Only visible in debug mode)
* Bug Fix: Charts do not display properly until an entry has been initially added to stats.
* Bug Fix: Styling issue with wp_table_list pagination
* Bug Fix: Search field not working on log tables
* Bug Fix: Admin notices would not display for policies that were disabled or if wp cron was disabled using DISABLE_WP_CRON.
* Bug Fix: The admin notices were not displaying bold properly
* Improvement: Fixed some PHP notices, thanks Charles Suggs
* Improvement: Excluded user roles super admin, administrator, editor, and author from text highlighting and right-click content protection while logged in
* Improvement: Updated SDK
* Improvement: Implemented better session handling for increased load performance
* Improvement: Added more i18n language support.

= 2.0.2 (High Priority) = 
*Release Date - 10 June 2019*
* Improvement: In some outlying circumstances, the db tables do not get created. A failsafe was added to create the tables if the insertion of a record failed.
* Bug Fix: The new db tables get created if the plugin is disabled and then enabled, but not after an update process.

= 2.0.0 (Low Priority) = 
*Release Date - 10 June 2019*

* Bug Fix: Security Safe would unintentionally recommend a lower version of PHP if the user had a newer version higher than the known versions.
* Added Feature: Log 404 Errors
* Added Feature: Log Successful and Failed Logins
* Added Feature: Manage Blacklist / Whitelist IP Addresses
* Added Feature: Log Blocked Access Attempts
* Added Feature: Log Security Vulnerability Probing
* Added Feature: Statistics and Charts
* Improvement: Force Local Logins setting now records blocked attempts.
* Improvement: Cleaned up some PHP Notices in error log.
* Improvement: Updated namespacing to support future plugins
* Improvement: Updated directory structure for better scalability
* Improvement: Minor code standardization updates
* Improvement: Performance testing and optimization
* Improvement: Minor styling updates
* Improvement: Updated PHP version checks
* Security: Added additional security to prevent XSS
* Tested up to: 5.2.1

= 1.2.3 (High Priority) = 
*Release Date - 1 March 2019*

* Security: Updated SDK
* Improvement: Updated PHP version checks
* Tested up to: 5.1

= 1.2.2 (High Priority) = 
*Release Date - 9 December 2018*

* NOTE: PHP 5.6 and 7.0 are now identified as no longer supported due to end of life.
* Improvement: Converted plugin variables to constants for efficiency and updated all references
* Improvement: Updated PHP version checks
* Tested up to: 5.0

= 1.2.1 (Medium Priority) =
*Release Date - 22 September 2018*

* Bug Fix: WP-CLI does not properly set variables and causes fatal error when attemptimg to load plugin. Thank you Brian Medlin.

= 1.2.0 (High Priority) =
*Release Date - 22 September 2018*

* Improvement: Automatically display file permission issues at the top of the list of files.
* Improvement: Removed Composer autoloading to increase efficiency
* Improvement: Reduced PHP memory usage to increase performance
* Improvement: Added Freemius integration
* Improvement: Updated PHP version checks
* Improvement: Minor UI styling
* Bug Fix: UI Styling issues in WP 3.5
* Bug Fix: Some WP-CLI commands return blank responses due to plugin killing PHP process. Thank you Brian Medlin for the discovery.
* Added Feature: Remove WP Version in wp-admin
* Pro: Added Feature: Import / Export Settings
* Pro: Added Feature: Automatic fix plugin permissions on plugin updates.
* Pro: Added Feature: Automatic fix theme permissions on theme updates.
* Pro: Added Feature: Automatically hide files with permissions that cannot be changed.
* Compatibility testing with WordPress version 3.5
* Tested up to: 4.9.8

= 1.1.13 (Low Priority) =
*Release Date - 17 August 2018*

* Bug Fix: Individual policy disabled notice was visible when all notices were disabled.
* Added Feature: Clear PHP Cache Before Updates
* Improvement: Updated descriptions of features in settings.
* Improvement: Updated PHP version checks.

= 1.1.12 (Low Priority) =
*Release Date - 4 July 2018*

* NOTICE: Update to this version if you are having issues with your settings.
* Improvement: Automatically detects if settings are corrupted and resets them to default values.
* Improvement: Updated the initial/default settings.
* Improvement: Updated PHP version checks.

= 1.1.11 (High Priority) =
*Release Date - 3 July 2018*

* Bug Fix: Cannot change file permissions. Bug introduced in version 1.1.10.
* Bug Fix: File Policy settings get cleared out when attempting to change file permissions. Bug introduced in version 1.1.10.
* Bug Fix: Initial settings were not properly being set. Bug introduced in version 1.1.10.
* Bug Fix: debug.log file does not remove itself when debugging is turned off.
* Improvement: Cleaned up some PHP Notices in error log.
* Improvement: Added additional logging for troubleshooting bugs.

= 1.1.10 (Low Priority) =
*Release Date - 26 June 2018*

* Bug Fix: After a group of policies are enabled, the disabled warning notice still appears immediately after saving, but goes away after navigating to another page.
* Bug Fix: When all security policies are disabled, the notice was incorrectly referring to "General Settings" which no longer exists.
* Bug Fix: When a group of policies are disabled, the warning notice would instruct the user to go to the relative settings page even if the user was already on that specific page.
* Bug Fix: Page would not go back to the top when a page anchor was used in the URL and settings were saved.
* Improvement: Improved usability by Adding color indicators within the settings tab to match the notices related to the specific setting.
* Improvement: Added Priorities to the changelog to indicate the urgency of an update.
* Thank you @df03472 for notifying us about the bugs above.

= 1.1.9 (Medium Priority) =
*Release Date - 14 June 2018*

* Bug Fix: Security Safe Admin page styling breaks when other plugins add classes to the body.

= 1.1.8 (High Priority) =
*Release Date - 12 June 2018*

* Bug Fix: Reference to wp-content was incorrect as a fallback default value when using custom plugin directory outside of wp-content directory.
* Security: Prevent Administrators of a multisite environment from modifying settings unless they are Super Admin.
* Added Support: Add support for backup logging.
* Tested Multi-site Compatibility
* Improvement: Increased plugin load efficiency

= 1.1.7 (High Priority) =
*Release Date - 06 June 2018*

* Added Feature: Hide password protected posts from public queries.
* Bug Fix: Changing permissions of the home directory has been reported to cause issues when loading the website. Use default permissions set by the host. 
* Bug Fix: Duplicate notices were being displayed in the Files section.
* Bug Fix: Fixed broken link in notice message.
* Improvement: Moved certain notices regarding features to the specific areas of each settings tab.
* Improvement: Updated PHP version checks
* Improvement: Minor grammatical corrections
* Tested up to version 4.9.6

= 1.1.6 (Low Priority) =
*Release Date - 08 May 2018*

* Bug Fix: If a child theme is used, only the parent theme files were appearing in the theme files permissions audit list.
* Improvement: Updated PHP version checks

= 1.1.5 (High Priority) =
*Release Date - 23 April 2018*

* Added Feature: Prevent Access to readme.html and license.txt core files.
* Added Feature: Notifications for file permissions displaying totals of vulnerable files.
* Improvement: Updated file permission status color scheme to match WP notifications.
* Improvement: Updated PHP version checks and added notifications.
* Security: Added additional security measures when handling $_POST variables.
* Bug Fix: Changed status of files from "good" to "secure" for all files that should only be 644 permissions.
* Bug Fix: When using the Hide Script Versions feature, CSS and JS files cache would not update for the browser until the next day after a plugin or theme was updated.
* Bug Fix: After the user pressed the Reset Settings button, the content on the page would not display.
* Added support for Security Safe Pro Add-on.
* Tested up to version 4.9.5

= 1.1.3 (Medium Priority) =
*Release Date - 25 February 2018*

* Added Feature: Hide WordPress Version from the RSS feed.
* Added Feature: Hide Script Versions from enqueued CSS and JS files
* Bug Fix: Hide WordPress stays on despite the settings value
* Bug Fix: An error is displayed when saving settings if the settings are the same in the database.

= 1.1.2 (Medium Priority) =
*Release Date - 20 February 2018*

* Bug Fix: Icon CSS conflict with other icon plugins

= 1.1.1 (Low Priority) =
*Release Date - 20 February 2018*

* Added Feature: Disable text highlighting to deter copying content
* Added Feature: Disable right clicking to deter copying content
* Added Feature: Fix file permissions
* Added Feature: Make website anonymous when checking for updates
* Added Feature: Plugin information tab for debugging purposes
* Bug Fix: Database was including nonce and referrer when saving settings
* Improvement: Update UI styling
* Thank you @epohs and @isabisa for file permissions UI testing and feedback
* Tested up to: 4.9.4

= 1.0.3 (High Priority) =
*Release Date - 24 January 2018*

* Added Feature: Server software version auditing
* Added Feature: Theme file permissions auditing
* Added Feature: Plugins files permissions auditing
* Bug Fix: Plugin version history was not logging properly
* Bug Fix: Automatic Updates were not running when the settings were selected
* Security: Added Nonce to admin forms
* Security: Removed the absolute path from file permissions auditing
* Improvement: File permissions were expanded to include all files and folders of WordPress base directory
* Improvement: Minor code standardization
* Improvement: Updated all screenshots
* Tested up to: 4.9.2

= 1.0.2 (Medium Priority) =
*Release Date - 10 January 2018*

* Bug Fix: File permissions would display files and directories even if they did not exist
* Bug Fix: File permissions status would display Bad if the 'world' had no permissions to read, write, or execute
* Bug Fix: Directory structure references relied on constants that could potentially conflict with custom site directory structures

= 1.0.1 =
*Release Date - 09 January 2018*

* Initial Release
* Thank you @daggerhart for plugin development feedback
* Thank you @cfullsteam for PHP structure feedback
