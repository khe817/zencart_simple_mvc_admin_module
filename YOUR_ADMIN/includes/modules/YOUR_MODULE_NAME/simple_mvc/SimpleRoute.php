<?php

class SimpleRoute {
	public $module_dir;
	public $controllers = array();
	public $routes = array();
	public $in_used_controllers = array();
	public $controller_name;
	public $default_route = '';
	public $current_route = '';

	/**
	 * contruct: set path to where the whole module locates
	 * @param string $module_dir module's directory
	 */
	function __construct ( $module_dir = __DIR__ ) {
		$this->module_dir = $module_dir;
	}

	/**
	 * Set default route, to use when no route is set for navigation
	 * @param string $route route to set
	 */
	public function set_default_route( $route = '' ) {
		if ( is_string($route) && $route != '' ) {
			$this->default_route = $route;
		} else {
			trigger_error("Invalid default route: $route.", E_USER_ERROR);
		}
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

			if ( isset($action) && is_string($action) && $action != '' ) {
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
	 * register action to controller
	 * @param  string $controller controller file name (without .php)
	 * @param  string $action     controller class's method name
	 * @return void
	 */
	public function register_action_to_controller ( $controller, $action ) {
		if ( isset($action)	&& is_string($action) && $action != ''
				&& isset($controller) && is_string($controller) && $controller != ''
				&& (!array_key_exists($controller, $this->controllers) || !in_array($action, $this->controllers[$controller])) ) {
			$this->controllers[$controller][] = $action;
		}
	}

	/**
	 * register action-controller pair to route if action exist
	 * @param  string $route      route from $_GET['action'], format: 'controller_class_name/method_name' or 'controller_file_name'
	 * @param  string $controller controller file name (without .php)
	 * @param  string $action     controller class's method name
	 * @return void
	 */
	public function register_action_to_route ( $route, $controller, $action ) {
		if ( $action == '' ) return;
		if ( isset($action)	&& is_string($action) && $action != ''
				&& in_array($controller, $this->routes) && in_array($action, $this->controllers[$controller]) ) {
			$this->routes[$route] = array($controller => $action);
		} else {
			trigger_error("Route already exist: $route", E_USER_WARNING);
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
		if ( !array_key_exists($route, $this->routes) ) {
			$this->routes[$route] = $controller;
		} else {
			trigger_error("Route already exist: $route", E_USER_WARNING);
		}
		// register controller
		if ( !array_key_exists($controller, $this->controllers) ) {
			$this->controllers[$controller] = array();
		}
		// register action
		$this->register_action_to_controller($controller, $action);
		$this->register_action_to_route($route, $controller, $action);
	}

	/**
	 * navigate route to a controller-method
	 * @param  string  $route       route from $_GET['action'], format: 'controller_class_name/method_name' or 'controller_file_name'
	 * @param  boolean $use_default navigate to default route if a route can not be found
	 * @return void
	 */
	public function navigate ( $route, $use_default = true ) {
		$this->current_route = $route;
		if ( $route == '' && $use_default && $this->default_route != '' ) {
			$this->current_route = $this->default_route;
			$this->navigate($this->default_route);
		}

		// remove '/' before and after
		$regex = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
		$route = trim($route, $regex);

		if ( array_key_exists($route, $this->routes) ) {
			$controller = $this->routes[$route];
			switch ( true ) {
				case is_array($controller) : // controller is a class
					// get action and controller associate with the route
					$controller_tmp = array_keys($controller);
					$controller_tmp = $controller_tmp[0];
					$action = $controller[$controller_tmp];
					$controller = $controller_tmp;

					if ( array_key_exists($controller, $this->controllers) && in_array($action, $this->controllers[$controller]) ) {
						$this->call_to_controller($controller, $action);
					} else {
						trigger_error("Method $action in controller $controller is not registered.", E_USER_WARNING);
						if ( $use_default && $this->default_route != '' ) $this->navigate($this->default_route);
					}
					break;

				case is_string($controller) : // controller is just a file
					if ( array_key_exists($controller, $this->controllers) ) {
						$this->call_to_controller($controller);
					} else {
						trigger_error("Controller $controller is not registered.", E_USER_WARNING);
						if ( $use_default && $this->default_route != '' ) $this->navigate($this->default_route);
					}
					break;

				default:
					trigger_error("Invalid route: $route", E_USER_WARNING);
					if ( $use_default && $this->default_route != '' ) $this->navigate($this->default_route);
					break;
			}
		} else {
			trigger_error("Route $route is not registered.", E_USER_WARNING);
			if ( $use_default && $this->default_route != '' ) $this->navigate($this->default_route);
		}
	}
}
