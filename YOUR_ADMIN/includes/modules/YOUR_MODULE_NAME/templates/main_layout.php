<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<!-- module css -->
<link rel="stylesheet" href="<?php echo MODULE_FOLDER_YOUR_MODULE_NAME; ?>css/main.css">
<!-- eof module css -->

<script language="javascript" src="includes/general.js"></script>
<script language="javascript" src="includes/menu.js"></script>
<script type="text/javascript">
	<!--
	function init()
	{
		cssjsmenu('navbar');
		if (document.getElementById)
		{
			var kill = document.getElementById('hoverJS');
			kill.disabled = true;
		}
	}
	// -->
</script>
</head>

<body onLoad="init()">
	<!-- header //-->
	<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
	<!-- header_eof //-->

	<h1><?php echo HEADING_TITLE; ?></h1>

	<!-- container module -->
	<div id="contentMainWrapper">
	<?php	require(MODULE_FOLDER_YOUR_MODULE_NAME . 'templates/' . $main_template . '.php'); ?>

	</div>
	<!-- eof container module  -->

	<!-- footer //-->
	<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
	<!-- footer_eof //-->

	<!-- module js -->
	<!-- check if jquery is already loaded in the header for avoiding conflicts -->
	<script>window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"><\/script>')</script>
	<?php require(MODULE_FOLDER_YOUR_MODULE_NAME . 'js/main_config.php'); ?>
	<script src="<?php echo MODULE_FOLDER_YOUR_MODULE_NAME; ?>js/main.js"></script>

	<?php // load controller's related scripts
	if ( file_exists(MODULE_FOLDER_YOUR_MODULE_NAME . 'js/' . ($this ? $this->controller_name : $controller) . '.php') ) {
		require(MODULE_FOLDER_YOUR_MODULE_NAME . 'js/' . ($this ? $this->controller_name : $controller) . '.php');
	}
	if ( file_exists(MODULE_FOLDER_YOUR_MODULE_NAME . 'js/' . ($this ? $this->controller_name : $controller) . '.js') ) { ?>
		<script src="<?php echo MODULE_FOLDER_YOUR_MODULE_NAME . 'js/' . ($this ? $this->controller_name : $controller) . '.js'; ?>"></script>
	<?php } ?>
	<!-- eof module js -->
</body>

</html>