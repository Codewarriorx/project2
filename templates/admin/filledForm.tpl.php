<div class="grid_12">
	<h4 class="adminHeader">New Item<? if(count($this->errors) != 0){ ?><span class="errorMessage error">Not all required fields are filled or password is incorrect!</span><? } ?></h4>
</div>
<div class="clear"></div>

<div class="grid_12">
	<form method="POST" action="admin/save" enctype="multipart/form-data">
		<div class="grid_6 alpha grid_together">
			<div class="adminForm">
				<input type="hidden" name="id" value="<? echo $values['id']; ?>"/>
				<span class="inputLabel<? echo $this->errorCheck('name'); ?>">Name:</span><span class="inputField"><input type="text" name="name" value="<? echo $values['name']; ?>" placeholder="Product Name"></span>
				<span class="inputLabel<? echo $this->errorCheck('description'); ?>">Description:</span><span class="inputField"><textarea name="description" placeholder="Product Description"><? echo $values['description']; ?></textarea></span>
				<span class="inputLabel<? echo $this->errorCheck('price'); ?>">Price:</span><span class="inputField"><input type="number" name="price" value="<? echo $values['price']; ?>" placeholder="Product Price"></span>
			</div>
		</div>
		<div class="grid_6 omega grid_together">
			<div class="adminForm">
				<span class="inputLabel<? echo $this->errorCheck('quantity'); ?>">Quantity in Stock:</span><span class="inputField"><input type="number" name="quantity" value="<? echo $values['quantity']; ?>" placeholder="Product Stock"></span>
				<span class="inputLabel<? echo $this->errorCheck('salePrice'); ?>">Sale Price:</span><span class="inputField"><input type="number" name="salePrice" value="<? echo $values['salePrice']; ?>" placeholder="Product Sale Price"></span>
				<span class="inputLabel<? echo $this->errorCheck('image'); ?>">Image:</span><span class="inputField"><input type="file" name="image"></span>
				<span class="inputLabel<? echo $this->errorCheck('onSale'); ?>">On Sale:</span><span class="inputField"><input type="checkbox" name="onSale" value="1" <? echo $values['onSale']; ?>></span>
				<span class="inputLabel<? echo $this->errorCheck('password'); ?>">Your Password:</span><span class="inputField"><input type="password" name="password" value="" placeholder=""></span>
				<input class="button" type="reset" value="Reset Form" name="reset">
				<input class="button purchase" type="submit" value="Submit New Item" name="save">
			</div>
		</div>
	</form>
	<div class="clear"></div>
</div>
<div class="clear"></div>