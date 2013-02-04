<div class="grid_12">
	<h4 class="adminHeader">New Item<</h4>
</div>
<div class="clear"></div>

<div class="grid_12">
	<form method="POST" action="admin.php">
		<div class="grid_6 alpha grid_together">
			<div class="adminForm">
				<span class="inputLabel">Name:</span><span class="inputField"><input type="text" name="name" value="" placeholder="Product Name"></span>
				<span class="inputLabel">Description:</span><span class="inputField"><textarea name="description" placeholder="Product Description"></textarea></span>
				<span class="inputLabel">Price:</span><span class="inputField"><input type="number" name="price" value="" placeholder="Product Price"></span>
			</div>
		</div>
		<div class="grid_6 omega grid_together">
			<div class="adminForm">
				<span class="inputLabel">Quantity in Stock:</span><span class="inputField"><input type="number" name="quantity" value="" placeholder="Product Stock"></span>
				<span class="inputLabel">Sale Price:</span><span class="inputField"><input type="number" name="salePrice" value="" placeholder="Product Sale Price"></span>
				<span class="inputLabel">Image:</span><span class="inputField"><input type="file" name="image"></span>
				<span class="inputLabel">On Sale:</span><span class="inputField"><input type="checkbox" name="onSale" value="1"></span>
				<span class="inputLabel">Your Password:</span><span class="inputField"><input type="password" name="password" value="" placeholder=""></span>
				<input class="button" type="reset" value="Reset Form" name="reset">
				<input class="button purchase" type="submit" value="Submit New Item" name="save">
			</div>
		</div>
	</form>
	<div class="clear"></div>
</div>
<div class="clear"></div>