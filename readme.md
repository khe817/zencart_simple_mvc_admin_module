# README #

### DESCRIPTION ###

Simple Model-View-Controller admin module framework with routers, models, controllers, and views
packaged in one folder for clean & quick development.


### INSTALLATION ###

1. Change the name of YOUR_MODULE_NAME and YOUR MODULE NAME in all files and folders to your module's name.

2. Upload the content of YOUR_ADMIN to your admin folder.

The module will install an admin page for module at ADMIN > TOOLS > YOUR_MODULE_NAME


### USAGE ###

Main layout is in YOUR_ADMIN/modules/YOUR_MODULE_NAME/templates/main_layout.php

Add common settings for the module in YOUR_ADMIN/YOUR_MODULE_NAME.php

**Routes**:

- Routes are determined by $_GET['action'] . Formats:

```php
	$_GET['action'] = 'route';
```

- Add routes for controllers in YOUR_ADMIN/modules/YOUR_MODULE_NAME/routes.php (detailed instructions is in the file)

```php
	// route to controller that is a simple file
	SimpleRoute::register('route', 'controller');

	// route to method in controller that is a class
	SimpleRoute::register('route', 'ControllerClass', 'method');
	SimpleRoute::register('route2', 'sub_folder/ControllerClass2', 'method');

```

- Default route is index, set in YOUR_ADMIN/modules/YOUR_MODULE_NAME/routes.php

```php
	SimpleRoute::set_default_route('index');
```

**Controllers**:

- Controllers can be simple php files or classes.

- If controllers are classes:

	* It must extends SimpleController class.

	* Class name must be the same as file name.

- Controllers can be nested in sub folders within YOUR_ADMIN/modules/YOUR_MODULE_NAME/controllers/ folder.

**Models**:

- Model files must have the same names as controller files.

- If model is a class, model class name must be named with controller's name entailing with "Model". Example: ExampleModel

- Model functions and classes can then be initialized and referenced in controller. Example:

```php
	$exampleModel = $this->load_model('Example', true);
```

**Views**:

- Two methods for calling a view in a controller class:

	* Method 1: call directly

```php
	// --- template vars
	$controller = $this->controller_name;
	$main_template = 'index';
	// --- render view
	require($this->get_template_path('main_layout.php'));
```
- 
	* Method 2: render view with passing data

```php
	// --- render view
	$view_data = array(
		'main_template' => $main_template,
		'current_admin_name' => $current_admin_name,
		);
	$this->render('main_layout', $view_data);
```

- Two method for calling a view within a view:

	* Method 1: call directly, for controller that is not a class:

```php
	require(MODULE_FOLDER_YOUR_MODULE_NAME . 'templates/example.php');
```
- 

	* Method 2: call via controller's method, for controller that is a class:


```php
	require($this->get_template_path('example.php'));
```

**Javascripts**:

- Main scripts are always included (main.js, main_config.js, main.css).

- Add controller related scripts in YOUR_ADMIN/modules/YOUR_MODULE_NAME/js/ , under the same names as controllers.

- Example for ajax actions is in YOUR_ADMIN/modules/YOUR_MODULE_NAME/js/main.js


### TIPS ###
Redirect to another controller inside a controller:

```php
	SimpleRoute::navigate('route_to_another_controller');

```

Works when controller is a class, call Javascript/CSS/Images in views using controller's method:

```

	<!-- includes/modules/YOUR_MODULE_NAME/js/ -->
	<script src="<?php echo $this->get_js_path('example.js'); ?>"></script>

	<!-- includes/modules/YOUR_MODULE_NAME/css/ -->
	<link rel="stylesheet" href="<?php echo $this->get_css_path('example.css'); ?>">

	<!-- includes/modules/YOUR_MODULE_NAME/images/ -->
	<img alt="" src="<?php echo $this->get_image_path('example.png'); ?>">
```

Works when controller is a class, use helper functions in controller:

```php
	// function file locates in 'includes/modules/YOUR_MODULE_NAME/functions/'
	// include function file
	$this->load_function('general');
	// use a function in function file
	$current_admin_name = get_current_admin_name();
```

Works when controller is a class, use another controller's method inside a controller:

- Method with arguments:

```php
	SimpleRoute::call_to_controller('Example');
	$example_controller = new Example(SimpleRoute::$module_dir);
	$example_data = $example_controller->example_method($params);
```

- Method without arguments:

```php
	SimpleRoute::call_to_controller('Example', 'example_method');
```

### Example modules using this framework: ###

- Controllers as files:
https://bitbucket.org/numinix/authorizenet_virtual_terminal

- Controllers as classes:
https://bitbucket.org/numinix/products_questions_answers
