<?php
if ( !defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

global $db, $PHP_SELF;

// --- do things

// --- template vars
$controller = 'index';
$main_template = 'index';
require(MODULE_FOLDER_YOUR_MODULE_NAME . 'templates/main_layout.php');
