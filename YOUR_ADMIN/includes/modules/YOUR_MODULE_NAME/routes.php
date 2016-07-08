<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

/**
 * Routes are determined by $_GET['action']
 * Formats:
 * $_GET['action'] = 'controller/method'
 * Or:
 * $_GET['action'] = 'controller' // a simple file with no class definition
 */
$routes = new SimpleRoute(MODULE_FOLDER_YOUR_MODULE_NAME);

// --- register routes to controller-method here

// this makes the framework call to method index in class ExampleController
// in YOUR_ADMIN/includes/modules/YOUR_MODULE_NAME/controllers/ExampleController.php
$routes->register('example/index', // route
	'ExampleController', // controller
	'index' // method
	);

// this makes the framework call to YOUR_ADMIN/includes/modules/YOUR_MODULE_NAME/controllers/index.php file
$routes->register('index', // route
	'index' // controller
	);

// ajax action as a controller
$routes->register('ajax_action_example', // route
	'ajax_action_example' // controller
	);
// --- eof register routes to controller-method

if ( isset($_GET['action']) && $_GET['action'] != '' ) {
	$action = $_GET['action'];
} else { // the default route
	$action = 'index';
	// $action = 'example/index'; // example default action
}

// navigate to the corresponding controller-method
$routes->navigate($action);
