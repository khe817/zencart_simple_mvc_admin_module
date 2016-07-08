<?php
require('includes/application_top.php');

// TODO: your custom settings
//
//

// --- include simple MVC framework
$simple_mvc_dir = MODULE_FOLDER_YOUR_MODULE_NAME . 'simple_mvc/';
$simple_mvc_files = glob($simple_mvc_dir . "/*.php");

if ( !empty($simple_mvc_files) ) {
	foreach ( $simple_mvc_files as $simple_mvc_file ) {
		require $simple_mvc_file;
	}
}

// --- Routing
require(MODULE_FOLDER_YOUR_MODULE_NAME . 'routes.php');

require(DIR_WS_INCLUDES . 'application_bottom.php');
