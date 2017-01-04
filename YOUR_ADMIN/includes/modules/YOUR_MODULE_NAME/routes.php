<?php
if ( !defined('IS_ADMIN_FLAG') ) {
	die('Illegal Access');
}

/**
 * Routes are determined by $_GET['action']
 * Formats:
 * $_GET['action'] = 'route'
 */
$routes = new SimpleRoute(MODULE_FOLDER_YOUR_MODULE_NAME);

// --- register routes to controller-method here

// this makes the framework call to method index in class Example
// in YOUR_ADMIN/includes/modules/YOUR_MODULE_NAME/controllers/Example.php
SimpleRoute::register('example', // route, must not contain special characters
	'Example', // controller that is a class, could be different than the name in route
	'index' // method
	);

// this makes the framework call to YOUR_ADMIN/includes/modules/YOUR_MODULE_NAME/controllers/example.php file
SimpleRoute::register('index', // route
	'example' // controller that is a simple file, could be different than the name in route
	);

// ajax action as a controller
SimpleRoute::register('ajax_action_example', // route
	'ajax_action_example' // controller
	);

// Tips: controllers can be nested in sub folders within controllers/ folder
// example:
/*
SimpleRoute::register('example', // route
	'sub_folder/Example', // controller
	'index' // method
	);
*/

// --- eof register routes to controller-method

// set default route
SimpleRoute::set_default_route('index');
//$routes->set_default_route('example'); // example default action

if ( isset($_GET['action']) && $_GET['action'] != '' ) {
	$action = $_GET['action'];
} else { // the default route
	$action = SimpleRoute::get_default_route();
}

// navigate to the corresponding controller-method
SimpleRoute::navigate($action);
