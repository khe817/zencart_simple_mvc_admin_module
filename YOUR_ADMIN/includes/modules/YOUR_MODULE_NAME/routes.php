<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

/**
 * Routes are determined by $_GET['action']
 * Formats:
 * $_GET['action'] = 'controller/method' // reference to method in a class
 * Or:
 * $_GET['action'] = 'controller' // reference to a simple file with no class definition
 */
$routes = new SimpleRoute(MODULE_FOLDER_YOUR_MODULE_NAME);

// --- register routes to controller-method here

// this makes the framework call to method index in class Example
// in YOUR_ADMIN/includes/modules/YOUR_MODULE_NAME/controllers/Example.php
$routes->register('example/index', // route, must contain '/' to make routing recognize it wants to reference to a class
	'Example', // controller that is a class, could be different than the controller name in route
	'index' // method, must be the same as the method name in route
	);

// this makes the framework call to YOUR_ADMIN/includes/modules/YOUR_MODULE_NAME/controllers/example.php file
$routes->register('index', // route
	'example' // controller that is a simple file, could be different than the name in route
	);

// ajax action as a controller
$routes->register('ajax_action_example', // route
	'ajax_action_example' // controller
	);

// Tips: controllers can be nested in sub folders within controllers/ folder
/* example:
$routes->register('example/index', // route
	'sub_folder/Example', // controller
	'index' // method
	);
*/
// --- eof register routes to controller-method

if ( isset($_GET['action']) && $_GET['action'] != '' ) {
	$action = $_GET['action'];
} else { // the default route
	$action = 'index';
	// $action = 'example/index'; // example default action
}

// navigate to the corresponding controller-method
$routes->navigate($action);
