<?php
/**
 * Model file for controllers/Example.php
 */

if ( !defined('IS_ADMIN_FLAG') ) {
	die('Illegal Access');
}

/**
 * Model class name must be named with controller's name entailing with "Model"
 */
class ExampleModel {

	public function get_current_admin_name () {
		global $db;

		$current_admin_sql = 'SELECT admin_name FROM ' . TABLE_ADMIN . ' WHERE admin_id = :admin_id';
		$current_admin_sql = $db->bindVars($current_admin_sql, ':admin_id', (int)$_SESSION['admin_id'], 'integer');
		$current_admin = $db->Execute($current_admin_sql);

		if ( $current_admin->RecordCount() > 0 ) {
			return $current_admin->fields['admin_name'];
		} else {
			return null;
		}
	}
}
