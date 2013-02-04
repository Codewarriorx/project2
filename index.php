<?php
	define('PASSWORD', 'project2');

	error_reporting(E_ALL);
	ini_set( 'display_errors','1'); 


	require ("library/loader.class.php");
	/* nullify any existing autoloads */
    spl_autoload_register(null, false);

    /* specify extensions that may be loaded */
    spl_autoload_extensions('.php, .class.php, .model.php, .entity.php, view.php, controller.php');

    /* register the loader functions */
    spl_autoload_register('Loader::libLoader');
    spl_autoload_register('Loader::entityLoader');
    spl_autoload_register('Loader::modelLoader');
    spl_autoload_register('Loader::controllerLoader');
    spl_autoload_register('Loader::viewLoader');

	// Get library classes
	require ("library/additionalFunctions.php");

	// Create controller and execute actions
	$loader = new loader($_GET);
	$controller = $loader->createController();

	// Include header
	include ("templates/header.php");
	$view = $controller->executeAction();
	$view->render();

	// Include footer
	include ("templates/footer.php");
?>