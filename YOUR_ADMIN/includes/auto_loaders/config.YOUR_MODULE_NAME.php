<?php
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
} 

$autoLoadConfig[999][] = array(
	'autoType' => 'init_script',
	'loadFile' => 'init_YOUR_MODULE_NAME.php'
);
