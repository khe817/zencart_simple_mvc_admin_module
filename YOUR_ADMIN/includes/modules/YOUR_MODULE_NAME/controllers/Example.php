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

		$exampleModel = $this->load_model('Example', true);
		$current_admin_name = $exampleModel->get_current_admin_name();

		// --- template vars
		$main_template = 'index';

		// --- render view
		$view_data = array(
			'main_template' => $main_template,
			'current_admin_name' => $current_admin_name,
			);
		$this->render('main_layout', $view_data);

		// --- alternate view render
		//require($this->get_template_path('main_layout.php'));
	}
}
