<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php 
			if(!isset($TITLE)){
				echo "Default Title";
			}
			else{
				echo $TITLE; 
			}
		?></title>

		<base href="http://people.rit.edu/mjl7592/539/project2/">
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/text.css" />
		<link rel="stylesheet" href="css/960.css" />
		<link href="js/jquery.shadow/jquery.shadow.css" rel="stylesheet">

		<link href='http://fonts.googleapis.com/css?family=Lato:900' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Iceland' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Monda:400,700' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
	</head>
	<body>
		<div class="container_12">
			<div class="grid_5">
				<div id="logo">
					<object width="300" height="200" type="image/svg+xml" data="img/gadgets.svg"></object>
					<div id="header">
						<h1>World of Gadgets</h1>
					</div>
				</div>
				
			</div>
			<div class="grid_7">
				<ul class="nav">
					<li class="<?php /*echo activePage('home');*/ ?>"><img src="img/glyphicons_020_home.png" alt="home icon"><a href="index.php">Home</a></li>
					<li class="<?php /*echo activePage('cart');*/ ?>"><img src="img/glyphicons_202_shopping_cart.png" alt="shopping cart icon"><a href="cart.php">Cart</a></li>
					<li class="<?php /*echo activePage('admin');*/ ?>"><img src="img/glyphicons_137_cogwheels.png" alt="admin icon"><a href="admin.php">Admin</a></li>
					<li class="<?php /*echo activePage('about'); */?>"><img src="img/glyphicons_039_notes.png" alt="about icon"><a href="#">About</a></li>
				</ul>

				<a href="cart.php" class="cartCount">
					<img src="img/glyphicons_202_shopping_cart.png" alt="shopping cart icon">
					<span><? /*echo cartCount();*/ ?> Items</span>
				</a>
			</div>
			<div class="clear"></div>
			<div class="grid_12">
				<div class="section mainSection">
					<h2>Catalog</h2>