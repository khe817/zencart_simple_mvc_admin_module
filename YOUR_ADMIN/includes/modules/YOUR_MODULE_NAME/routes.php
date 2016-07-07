<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

/**
 * Add routes for controllers as switch cases here.
 * Default route is index.
 * Ajax actions could count as controllers or route to /ajax folder
 */
switch ($_GET['action']) {
	case 'ajax_action_example':
		require(MODULE_FOLDER_YOUR_MODULE_NAME . 'ajax/ajax_action_example.php');
		break;

	case 'index': // --- load index page without any request
	default:
		require(MODULE_FOLDER_YOUR_MODULE_NAME . 'controllers/index.php');
		break;
}
