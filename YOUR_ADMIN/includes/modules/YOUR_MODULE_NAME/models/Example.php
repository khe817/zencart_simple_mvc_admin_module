<?php
/**
 * Model file for controllers/Example.php
 */

if ( !defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

/**
 * Model class name must be different than controller's class name.
 * Best practice is just adding 'Model' to the name.
 */
class ExampleModel {

	public function get_current_admin_name () {
		global $db;

		$current_admin = $db->Execute('SELECT * FROM ' . TABLE_ADMIN . ' WHERE admin_id = "' . $_SESSION['admin_id'] . '"');

		if ( $current_admin->RecordCount() > 0 ) {
			return $current_admin->fields['admin_name'];
		} else {
			return null;
		}
	}
}
