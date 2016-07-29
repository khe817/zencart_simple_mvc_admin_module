===================
DESCRIPTION
===================
Simple Model-View-Controller admin module framework with routers, models, controllers, and views
packaged in one folder for clean & quick development.


===================
INSTALLATION
===================
Step 1.) Change the name of YOUR_MODULE_NAME and YOUR MODULE NAME in all files and folders to your module's name.

Step 2.) Upload the content of YOUR_ADMIN to your admin folder.

The module will install an admin page for module at ADMIN > TOOLS > YOUR_MODULE_NAME


===================
USAGE
===================
Main layout is in YOUR_ADMIN/modules/YOUR_MODULE_NAME/templates/main_layout.php

Add common settings for the module in YOUR_ADMIN/YOUR_MODULE_NAME.php

Add routes for controllers in YOUR_ADMIN/modules/YOUR_MODULE_NAME/routes.php (instructions is in the file)

Default controller is index, set in YOUR_ADMIN/modules/YOUR_MODULE_NAME/routes.php

Controllers can be simple php files or classes.

If controllers are classes:
- It must extends SimpleController class.
- Class name must be the same as file name.

Controllers can be nested in sub folders within YOUR_ADMIN/modules/YOUR_MODULE_NAME/controllers/ folder.

Model files must have the same names as controller files. Read index.html in YOUR_ADMIN/modules/YOUR_MODULE_NAME/models/

Main scripts are always included (main.js, main_config.js, main.css).

Add controller related scripts in YOUR_ADMIN/modules/YOUR_MODULE_NAME/js/ ,
under the same names as controllers.

Example for ajax actions is in YOUR_ADMIN/modules/YOUR_MODULE_NAME/js/main.js

Example module using this framework:
https://bitbucket.org/numinix/authorizenet_virtual_terminal


===================
TIPS
===================
ooo Redirect to another controller inside a controller:
[code]
	global $routes;
	$routes->call_to_controller('controller', 'method');
[code]

ooo Two methods for calling a view in controller:
# Method 1: call directly
[code]
	// --- template vars
	$controller = $this->controller_name;
	$main_template = 'index';
	require($this->get_template_path('main_layout.php'));
[code]

# Method 2: render view with passing data
[code]
	$view_data = array(
		'controller' => $controller,
		'main_template' => $main_template,
		'current_admin_name' => $current_admin_name,
		);
	$this->render('main_layout', $view_data);
[code]

This method requires putting <?php exit(); ?> after </html> close tag
