<?php
	error_reporting(E_ALL);
	ini_set( 'display_errors','1'); 

	// Get library classes
	require ("library/additionalFunctions.php");
	require ("library/loader.class.php");
	require ("library/dataAccessHandler.class.php");
	require ("library/pagination.class.php");
	require ("library/baseController.class.php");

	// Require entity classes
	require ("entities/catalogItem.entity.php");
	require ("entities/saleItem.entity.php");
	require ("entities/cartItem.entity.php");

	// Require model classes
	require ("models/catalog.model.php");
	require ("models/sales.model.php");
	require ("models/cart.model.php");

	// Require controller classes
	require ("controllers/home.controller.php");

	// Require controller classes
	require ("views/index.view.php");

	// Include header
	include ("templates/header.php");

	// Create controller and execute actions
	$loader = new loader($_GET);
	$controller = $loader->createController();
	$view = $controller->executeAction();
	$view->render();

	// Include footer
	include ("templates/footer.php");
?>