<?php
if ( !defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

/**
 * Controller class name must have the same name as controller's file name (without .php)
 * Controller class must extends SimpleController class
 */
class Example extends SimpleController {

	public function index () {
		global $db, $PHP_SELF;

		// --- do things

		$exampleModel = new ExampleModel();
		$current_admin_name = $exampleModel->get_current_admin_name();

		// --- template vars
		$controller = $this->controller_name;
		$main_template = 'index';
		require($this->get_template_path('main_layout.php'));
		// $this->render('main_layout', array('controller' => 'index', 'template' => 'index')); // only reconmmended for calling within views
	}
}
