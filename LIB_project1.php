<?
	$itemName = array();
	$description = array();
	$price = array();
	$stock = array();
	$imgName = array();
	$salesPrice = array();

	$salesList = array();

	$cartList = array();
	$cartCount = array();

	$password = 'project1';

	// function readCatalog(){
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice, $itemCount;

	// 	$items = file('catalog.txt');
	// 	foreach ($items as $line) {
	// 	    $stuff = explode('|', $line);

	// 	    array_push($itemName, html_entity_decode($stuff[0]));
	// 	    array_push($description, html_entity_decode($stuff[1]));
	// 	    array_push($price, html_entity_decode($stuff[2]));
	// 	    array_push($stock, html_entity_decode($stuff[3]));
	// 	    array_push($imgName, html_entity_decode($stuff[4]));
	// 	    array_push($salesPrice, html_entity_decode($stuff[5]));
	// 	}
	// }

	// function readSales(){
	// 	global $salesList;

	// 	$items = file('sales.txt');
	// 	foreach ($items as $line) {
	// 		array_push($salesList, $line);
	// 	}
	// }

	// function createItem($itemID, $saleFlag){
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice;
	// 	$itemPrice = "";

	// 	if($saleFlag){
	// 		$itemPrice = $salesPrice[$itemID];
	// 	}
	// 	else{
	// 		$itemPrice = $price[$itemID];
	// 	}

	// 	return "<a href=\"itempage.php?itemID=$itemID\">
	// 				<div class=\"item\">
	// 					<img src=\"img/$imgName[$itemID]\" alt=\"".str_replace('"', '', $itemName[$itemID])."\" >
	// 					<div class=\"price\">\$".number_format($itemPrice, 2, '.', '')."&nbsp;&nbsp;|&nbsp;&nbsp;$stock[$itemID]</div>
	// 					<div class=\"caption\">
	// 						<h4>".html_entity_decode($itemName[$itemID])."</h4>
	// 						<p>".html_entity_decode(itemDescriptionLimited($itemID, 80))."</p>
	// 						<form method=\"post\" action=\"cart.php\">
	// 							<input type=\"hidden\" value=\"$itemID\" name=\"itemID\">
	// 							<input class=\"button addToCart\" type=\"submit\" value=\"Add To Cart\" name=\"add\" >
	// 						</form>
	// 					</div>
	// 				</div>
	// 			</a>";
	// }

	// function createItemPage($itemID){
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice;

	// 	return "<h2>".html_entity_decode($itemName[$itemID])."</h2>
	// 			<span class=\"stock\">Stock: $stock[$itemID]</span>
	// 			<p>".html_entity_decode($description[$itemID])."</p>
	// 			<span class=\"priceBar\">\$".number_format($price[$itemID], 2, '.', '')."</span>
	// 			<form method=\"post\" action=\"cart.php\">
	// 				<input type=\"hidden\" value=\"$itemID\" name=\"itemID\" >
	// 				<span class=\"quantity\">Quantity:<input type=\"number\" name=\"quantity\" value=\"\" placeholder=\"1\"></span>
	// 				<input class=\"button addToCart\" type=\"submit\" value=\"Add To Cart\" name=\"add\" >
	// 			</form>";
	// }

	// function itemPageGallery($itemID){
	// 	global $itemName, $imgName;
	// 	return "<img class=\"imgMain\" src=\"img/$imgName[$itemID]\" alt=\"".str_replace('"', '', $itemName[$itemID])."\">
		
	// 			<img class=\"imgSub\" src=\"img/$imgName[$itemID]\" alt=\"".str_replace('"', '', $itemName[$itemID])."\">
	// 			<img class=\"imgSub\" src=\"img/coming_soon.jpg\" alt=\"Coming soon!\">
	// 			<img class=\"imgSub\" src=\"img/coming_soon.jpg\" alt=\"Coming soon!\">";
	// }

	function cartTotal(){
		global $cartList, $cartCount;
		global $price, $salesPrice;
		$total = 0;

		for ($i=0; $i < cartCount(); $i++) { 
			$total += cartItemSum($i);
		}

		return $total;
	}

	// function cartTax($total){
	// 	return $total * 0.08;
	// }

	// function activePage($page='home'){
	// 	global $PAGE;
		
	// 	if($page == $PAGE){
	// 		return "active";
	// 	}
	// }

	// function cartItemSum($cartID){
	// 	global $cartList, $cartCount;
	// 	global $price, $salesPrice;

	// 	$itemID = $cartList[$cartID];
	// 	$num = $cartCount[$cartID];
	// 	$itemSum = $num * $price[$itemID];
	// 	return $itemSum;
	// }

	// function cartList($cartID){
	// 	global $cartList, $cartCount;
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice;

	// 	$itemID = $cartList[$cartID];
	// 	$num = $cartCount[$cartID];

	// 	return "<tr class=\"cartItem\">
	// 				<td><img src=\"img/$imgName[$itemID]\" alt=\"".str_replace('"', '', $itemName[$itemID])."\"></td>
	// 				<td>".html_entity_decode($itemName[$itemID])."<input type=\"hidden\" value=\"$itemID\" name=\"itemID\"></td>
	// 				<td>
	// 					<form method=\"post\" action=\"cart.php\">
	// 					<input type=\"hidden\" value=\"$itemID\" name=\"itemID\">
	// 					<button class=\"iconButton\" type=\"submit\" name=\"remove\"><img class=\"icon\" src=\"img/glyphicons_016_bin.png\" alt=\"bin icon\"></button>
	// 					</form>
	// 				</td>
	// 				<td><input type=\"number\" name=\"quantity\" value=\"$num\" placeholder=\"1\"></td>
	// 				<td>\$".number_format($price[$itemID], 2, '.', '')."</td>
	// 				<td>\$".number_format(cartItemSum($cartID), 2, '.', '')."</td>
	// 			</tr>
	// 			<tr>
	// 				<td>&nbsp;</td>
	// 				<td>&nbsp;</td>
	// 				<td>&nbsp;</td>
	// 				<td>&nbsp;</td>
	// 				<td>&nbsp;</td>
	// 				<td>&nbsp;</td>
	// 			</tr>";
	// }

	function itemOptions(){
		global $itemName, $description, $price, $stock, $imgName, $salesPrice;
		$optionList = "";

		for ($i=0; $i < getItemCount(); $i++) { 
			$optionList .= "<option value=\"$i\">$itemName[$i]</option>";
		}
		return $optionList;
	}
	
	function errorCheck($fieldName){
		global $errors;

		if(in_array($fieldName, $errors)){
			return " error";
		}
		return "";
	}

	function adminFiller($fieldName, $formFlag){
		global $itemName, $description, $price, $stock, $imgName, $salesPrice, $itemCount;
		global $salesList;
		global $errors, $clean;

		if($formFlag != -1){
			switch ($fieldName) {
				case 'name':
					return $itemName[$formFlag];
					break;

				case 'description':
					return $description[$formFlag];
					break;

				case 'price':
					return $price[$formFlag];
					break;

				case 'quantity':
					return $stock[$formFlag];
					break;

				case 'salePrice':
					return $salesPrice[$formFlag];
					break;

				case 'image':
					return $imgName[$formFlag];
					break;

				case 'onSale':
					if(in_array($formFlag, $salesList)){
						return "checked";
					}
					break;
			}
		}
		if(count($errors) != 0){
			return htmlentities($_POST[$fieldName]);
		}

		return "";
	}

	// function readCart(){
	// 	global $cartList, $cartCount;

	// 	$items = file('cart.txt');
	// 	foreach ($items as $line) {
	// 	    $stuff = explode('|', $line);

	// 	    array_push($cartList, $stuff[0]);
	// 	    array_push($cartCount, $stuff[1]);
	// 	}
	// }

	// function cartCount(){
	// 	global $cartList;
	// 	return count($cartList);
	// }

	// function itemDescriptionLimited($itemID, $length){
	// 	global $description;
	// 	return substr($description[$itemID],0,$length)."...";
	// }

	// function getItemCount(){
	// 	global $itemName;
	// 	return count($itemName);
	// }

	// function pageCount($count, $itemsPerPage = 8){
	// 	return ceil($count / $itemsPerPage);
	// }

	// function pagination($itemCount, $page="1", $itemsPerPage = 8){
	// 	$page--;
	// 	$lowerBound = $page * $itemsPerPage;
	// 	$upperBound = $lowerBound + $itemsPerPage;

	// 	if($upperBound > $itemCount){
	// 		$upperBound = $itemCount;
	// 	}

	// 	return array($lowerBound, $upperBound);
	// }

	// function sanitizeString($var){
	// 	$var = trim($var);
	// 	$var = stripslashes($var);
	// 	$var = htmlentities($var);
	// 	$var = strip_tags($var);
	// 	$var = str_replace('|', ' ', $var);
	// 	return $var;
	// }

	// function inCart($itemID){
	// 	global $cartList;
	// 	if(in_array($itemID, $cartList)){
	// 		return array_search($itemID, $cartList); // return cartID
	// 	}
	// 	return -1;
	// }

	// function onSale($itemID){
	// 	global $salesList;
	// 	if(in_array($itemID, $salesList)){
	// 		return array_search($itemID, $salesList); // return salesID
	// 	}
	// 	return -1;
	// }

	// function addToCart($itemID, $amount){
	// 	global $cartList, $cartCount;
	// 	global $stock;

	// 	$cartID = inCart($itemID);
	// 	if($cartID != -1){ // in cart
	// 		$stock[$itemID] = $stock[$itemID] - $amount;
	// 		$cartCount[$cartID] += $amount;
	// 	}
	// 	else{ // not in cart
	// 		$stock[$itemID] = $stock[$itemID] - $amount;
	// 		array_push($cartList, $itemID);
	// 		array_push($cartCount, $amount);
	// 	}

	// 	updateCartFile(); // update the file
	// 	updateCatalogFile();
	// }

	// function removeFromCart($itemID){
	// 	global $cartList, $cartCount;
	// 	global $stock;

	// 	$cartID = inCart($itemID);
	// 	if($cartID != -1){ // in cart
	// 		$stock[$itemID] += $cartCount[$cartID];

	// 		unset($cartList[$cartID]);
	// 		unset($cartCount[$cartID]);
	// 		$cartList = array_values($cartList);
	// 		$cartCount = array_values($cartCount);

	// 		updateCartFile(); // update the file
	// 		updateCatalogFile();
	// 	}
	// }

	// function addToCatalog($fields){
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice, $itemCount;

	// 	array_push($itemName, $fields['name']);
	// 	array_push($description, $fields['description']);
	// 	array_push($price, $fields['price']);
	// 	array_push($stock, $fields['quantity']);
	// 	array_push($imgName, $fields['image']);
	// 	array_push($salesPrice, $fields['salePrice']);

	// 	updateCatalogFile();
	// }

	// function editCatalog($fields, $itemID){
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice, $itemCount;
	// 	global $salesList;

	// 	$itemName[$itemID] = $fields['name'];
	// 	$description[$itemID] = $fields['description'];
	// 	$price[$itemID] = $fields['price'];
	// 	$stock[$itemID] = $fields['quantity'];
	// 	$imgName[$itemID] = $fields['image'];
	// 	$salesPrice[$itemID] = $fields['salePrice'];

	// 	updateCatalogFile();
	// 	$salesID = onSale($itemID);

	// 	if(isset($fields['onSale'])){ // item is to be on sale
	// 		if($salesID != -1){
	// 			// do nothing, already on sale
	// 		}
	// 		else{
	// 			array_push($salesList, $itemID);
	// 			updateSalesFile();
	// 		}
	// 	}
	// 	else{ // make sure item is not on sale
	// 		if($salesID != -1){ // remove from cart if true
	// 			unset($salesList[$salesID]);
	// 			$salesList = array_values($salesList);
	// 			updateSalesFile();
	// 		}
	// 	}
	// }

	// function updateSalesFile(){
	// 	global $salesList;

	// 	file_put_contents('sales.txt', implode("\n", $salesList));
	// }

	// function updateCartFile(){
	// 	global $cartList, $cartCount;
	// 	$cart = array();

	// 	for ($i=0; $i < count($cartList); $i++) {
	// 		$temp = array(sanitizeString($cartList[$i]), sanitizeString($cartCount[$i]));

	// 		array_push($cart, implode('|', $temp));
	// 	}

	// 	file_put_contents('cart.txt', implode("\n", $cart));
	// }

	// function updateCatalogFile(){
	// 	global $itemName, $description, $price, $stock, $imgName, $salesPrice, $itemCount;
	// 	$catalog = array();

	// 	for ($i=0; $i < count($itemName); $i++) {
	// 		$temp = array(sanitizeString($itemName[$i]), sanitizeString($description[$i]), sanitizeString($price[$i]), sanitizeString($stock[$i]), sanitizeString($imgName[$i]), sanitizeString($salesPrice[$i]));
	// 		array_push($catalog, implode('|', $temp));
	// 	}

	// 	file_put_contents('catalog.txt', implode("\n", $catalog));
	// }

?>