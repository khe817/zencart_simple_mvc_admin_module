<?php
/**
 * Controller class name must have the same name as controller's file name (without .php)
 */
class SimpleController {

	public $controller_name;
	public $module_dir;
	public $template_dir;
	public $js_dir;
	public $css_dir;
	public $image_dir;

	function __construct ( $module_dir = __DIR__) {
		$this->controller_name = basename(__FILE__, '.php');
		$this->module_dir = $module_dir;
		$this->template_dir = $this->module_dir . 'templates'. DIRECTORY_SEPARATOR;
	}

	/*
	*       render($view)
	*       =============
	*       Loads a view from within the /plugin/templates folder. Keep in mind
	*       that any data you need should be passed through the $this->data array.
	*       A few examples:
	*						$var_array = array();
	*						$var_array['color'] = $input_color;
	*						$var_array['shape'] = $input_shape;			
	*           //Load /Plugin/templates/example.php
	*           $this->render_view('example', $var_array);
	*
	*           //Load /Plugin/templates/subfolder/example.php
	*           $this->render_view('subfolder/example', $var_array);
	*
	*				Within the view, use $color and $shape 
	*/
	public function render ( $view, $var_array = array() ) {

		if ( count($var_array > 0) ) {
			extract($var_array, EXTR_OVERWRITE);
		}

		// remove '/' before and after
		$regex = DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
		$view = trim($view, $regex);
		
		$template_path = $this->template_dir . $view .'.php';
		if ( file_exists($template_path) ) {
			ob_start();
			include($template_path);
			$output = ob_get_contents();
			ob_get_clean();
			return $output;
		}
		
		trigger_error("View $view does not exist.", E_USER_ERROR);
	}

	public function get_template_path ( $view ) {
		return $this->template_dir . $view;
	}

	public function get_js_path ( $js_file_name ) {
		return $this->js_dir . $js_file_name;
	}

	public function get_css_path ( $css_file_name ) {
		return $this->css_dir . $css_file_name;
	}

	public function get_image_path ( $image_file_name ) {
		return $this->image_dir . $image_file_name;
	}
}
