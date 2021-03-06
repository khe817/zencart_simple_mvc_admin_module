<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

// --- Register admin page
if (function_exists('zen_register_admin_page')) {
	// Add YOUR_MODULE_NAME link to Tools menu
	if (!zen_page_key_exists('toolsYOUR_MODULE_NAME')) {
		zen_register_admin_page('toolsYOUR_MODULE_NAME', 'BOX_TOOLS_YOUR_MODULE_NAME','FILENAME_YOUR_MODULE_NAME', '', 'tools', 'Y', 99); 
	}
}

/**
 * Un-comment this if you want to install configuration menu for the module
 */
/*
$module_name = "YOUR_MODULE_NAME";
$module_enabled = "YOUR_MODULE_NAME_ENABLED";

$check = $db->Execute("SELECT configuration_key FROM  " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $module_enabled . "'");
if ($check->RecordCount() == 0) {
	// --- Install new configuration page for module
	$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_GROUP . " (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('" . $module_name . "', 'Set " . $module_name . " Options', '1', '1');");
	$configuration_group_id = $db->Insert_ID();

	$db->Execute("UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = " . $configuration_group_id . " WHERE configuration_group_id = " . $configuration_group_id . ";");

	$db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
	('" . $module_name . " Enable', '" . $module_enabled . "', 'false', '" . $module_name . " enabled?', " . $configuration_group_id . ", " . $configuration_group_id . ", NOW(), NOW(), NULL,  'zen_cfg_select_option(array(\'true\', \'false\'),');");

	// --- Register admin page
	if (function_exists('zen_register_admin_page')) {
		if (!zen_page_key_exists('configYOUR_MODULE_NAME')) {
			// Add link to Configration menu
			zen_register_admin_page('configYOUR_MODULE_NAME', 'BOX_CONFIGURATION_YOUR_MODULE_NAME','FILENAME_CONFIGURATION', 'gID='. $configuration_group_id, 'configuration', 'Y', $configuration_group_id);
		}
	}

	$messageStack->add("Installed " . $module_name . " in Configuration->" . $module_name, 'success');
}
*/
