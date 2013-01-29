<?php
	error_reporting(E_ALL);
	ini_set( 'display_errors','1'); 

	// Get library classes
	require ("library/loader.class.php");
	require ("library/dataAccessHandler.class.php");
	require ("library/pagination.class.php");
	require ("library/baseController.class.php");

	// Require entity classes
	require ("entities/catalogItem.entity.php");

	// Require model classes
	require ("models/catalog.model.php");

	// Require controller classes
	require ("controllers/home.controller.php");

	// Require controller classes
	require ("views/index.view.php");

	// Include header
	include ("templates/header.php");

	// Create controller and execute actions
	var_dump($_GET);
	echo "test";
	$loader = new loader($_GET);
	$controller = $loader->createController();
	$view = $controller->executeAction();
	$view->render();

	// Include footer
	include ("templates/footer.php");
?>