<?php
require('includes/application_top.php');

// --- Common settings
if (!zen_not_null($_GET['action'])) {
	$_GET['action'] = 'index';
}

// TODOD: your settings

// --- eof Common settings

// --- Routing
require(MODULE_FOLDER_YOUR_MODULE_NAME . 'routes.php');

require(DIR_WS_INCLUDES . 'application_bottom.php');
