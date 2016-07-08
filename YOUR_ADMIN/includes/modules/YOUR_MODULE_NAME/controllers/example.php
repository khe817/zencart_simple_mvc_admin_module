<?php
if ( !defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

global $db, $PHP_SELF;

// --- do things

$current_admin_name = get_current_admin_name();

// --- template vars
$controller = 'example';
$main_template = 'index';
require(MODULE_FOLDER_YOUR_MODULE_NAME . 'templates/main_layout.php');
