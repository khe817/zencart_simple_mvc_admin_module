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
		$this->controller_name = get_class($this);
		$this->module_dir = $module_dir;
		$this->template_dir = $this->module_dir . 'templates'. DIRECTORY_SEPARATOR;
		$this->js_dir = $this->module_dir . 'js' . DIRECTORY_SEPARATOR;
		$this->css_dir = $this->module_dir . 'css' . DIRECTORY_SEPARATOR;
		$this->image_dir = $this->module_dir . 'images' . DIRECTORY_SEPARATOR;
	}

	/*
	*       render($view)
	*       =============
	*       Loads a view from within the /plugin/templates folder. Keep in mind
	*       that any data you need should be passed through the $this->data array.
	*       A few examples:
	*           $var_array = array();
	*           $var_array['color'] = $input_color;
	*           $var_array['shape'] = $input_shape;
	*           //Load /Plugin/templates/example.php
	*           $this->render_view('example', $var_array);
	*
	*           //Load /Plugin/templates/subfolder/example.php
	*           $this->render_view('subfolder/example', $var_array);
	*
	*       Within the view, use $color and $shape
	*/
	public function render ( $view, $var_array = array() ) {
		global $db, $PHP_SELF;

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
			exit(1);
			$output = ob_get_contents();
			ob_get_clean();
			return $output;
		}
		
		trigger_error("View $view does not exist.", E_USER_ERROR);
	}

	/**
	 * load model file or class
	 * @param  string  $model_filename model filename without extension (.php)
	 * @param  boolean $load_class     whether or not to load the model class if exists
	 * @return class instant or boolean
	 */
	public function load_model ( $model_filename, $load_class = false ) {
		if ( file_exists($this->module_dir . 'models/' . $model_filename . '.php') ) {
			require_once($this->module_dir . 'models/' . $model_filename . '.php');
			$model_class = $model_filename . 'Model';
			if ( $load_class && class_exists($model_class) ) {
				return new $model_class();
			} else {
				return false;
			}
			return true;
		}
		return false;
	}

	/**
	 * load helpers function file
	 * @param  string  $function_filename function filename without extension (.php)
	 * @return boolean
	 */
	public function load_function ( $function_filename ) {
		if ( file_exists($this->module_dir . 'functions/' . $function_filename . '.php') ) {
			require_once($this->module_dir . 'functions/' . $function_filename . '.php');
			return true;
		}
		return false;
	}

	public function get_template_path ( $view_file_name ) {
		return $this->template_dir . $view_file_name;
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
