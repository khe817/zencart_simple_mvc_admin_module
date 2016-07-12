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