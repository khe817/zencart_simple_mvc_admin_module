<?php

class SimpleRoute {
	public $module_dir;
	public $controllers = array();
	public $routes = array();
	public $in_used_controllers = array();
	public $controller_name;

	function __construct ( $module_dir = __DIR__) {
		$this->module_dir = $module_dir;
	}

	/**
	 * Call to controller
	 * @param  string $controller controller file name (without .php)
	 * @param  string $action     controller class's method name
	 * @return void
	 */
	public function call_to_controller ( $controller, $action = null ) {
		// remove '/' before and after
		$regex = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
		$controller = trim($controller, $regex);

		// call to model for controller
		if ( file_exists($this->module_dir . 'models/' . $controller . '.php') ) {
			require_once($this->module_dir . 'models/' . $controller . '.php');
		}

		// call to controller
		if ( file_exists($this->module_dir . 'controllers/' . $controller . '.php') ) {
			$this->controller_name = basename($controller, '.php');
			require_once($this->module_dir . 'controllers/' . $controller . '.php');

			if ( isset($action) ) {
				if ( !array_key_exists($controller, $this->in_used_controllers) ) { // create new object if not eixsts
					$controller_class_name = $this->controller_name;
					$to_call_controller = new $controller_class_name($this->module_dir);
					$this->in_used_controllers[$controller] = $to_call_controller;
				} else { // re-use existing controller
					$to_call_controller = $this->in_used_controllers[$controller];
				}
				$to_call_controller->{ $action }();
				$to_call_controller = null;
			}
		} else {
			trigger_error("Controller $controller does not exist.", E_USER_ERROR);
		}
	}

	/**
	 * register actions to controller
	 * @param  string          $controller  controller file name (without .php)
	 * @param  string or array $actions     controller class's method names
	 * @return void
	 */
	public function register_actions ( $controller, $actions ) {
		if ( isset($actions) || !empty($actions) ) {
			if ( is_string($actions) && $actions != '' ) {
				$this->controllers[$controller][] = $actions;
			} elseif ( is_array($actions) ) {
				array_push($this->controllers[$controller], $actions);
			}
		}
	}

	/**
	 * register controller to route
	 * @param  string $route      route from $_GET['action'], format: 'controller_class_name/method_name' or 'controller_file_name'
	 * @param  string $controller controller file name (without .php)
	 * @param  string $action     controller class's method name
	 * @return void
	 */
	public function register ( $route, $controller, $action = '' ) {
		// register route
		if ( !array_key_exists($controller, $this->routes) ) {
			$this->routes[$route] = $controller;
		}
		// register controller
		if ( !array_key_exists($controller, $this->controllers) ) {
			$this->controllers[$controller] = array();
		}
		// register action
		$this->register_actions($controller, $action);
	}

	/**
	 * navigate route to a controller-method
	 * @param  string $route route from $_GET['action'], format: 'controller_class_name/method_name' or 'controller_file_name'
	 * @return void
	 */
	public function navigate ( $route ) {
		if ( array_key_exists($route, $this->routes) ) {
			$controller = $this->routes[$route];
		}
		if ( array_key_exists($controller, $this->controllers) ) {
			// remove '/' before and after
			$regex = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
			$route = trim($route, $regex);
			$routes_parts = explode('/', $route);
			$routes_parts_count = count($routes_parts);
			switch ( true ) {
				case $routes_parts_count == 1: // controller is just a file
					$this->call_to_controller($controller);
					break;

				case $routes_parts_count > 1: // controller is a class
					$action = $routes_parts[$routes_parts_count - 1];
					if ( in_array($action, $this->controllers[$controller]) ) {
						$this->call_to_controller($controller, $action);
					} else {
						trigger_error("Method $action in controller $controller is not registered.", E_USER_ERROR);
					}
					break;

				default:
					trigger_error("Invalid route: $route", E_USER_ERROR);
					break;
			}
		} else {
			trigger_error("Controller $controller is not registered.", E_USER_ERROR);
		}
	}
}
