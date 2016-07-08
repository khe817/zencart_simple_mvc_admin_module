<?php
/**
 * model file for controllers/example.php
 */

if ( !defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

function get_current_admin_name () {
	global $db;

	$current_admin = $db->Execute('SELECT * FROM ' . TABLE_ADMIN . ' WHERE admin_id = "' . $_SESSION['admin_id'] . '"');

	if ( $current_admin->RecordCount() > 0 ) {
		return $current_admin->fields['admin_name'];
	} else {
		return null;
	}
}
