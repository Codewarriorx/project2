<div class="grid_5">
	<div class="imgGallery">
		<img class="imgMain" src="img/<?php echo $values['image']; ?>" alt="<?php echo str_replace('"', '', $values['name']); ?>">
		
		<img class="imgSub" src="img/<?php echo $values['image']; ?>" alt="<?php echo str_replace('"', '', $values['name']); ?>">
		<img class="imgSub" src="img/coming_soon.jpg" alt="Coming soon!">
		<img class="imgSub" src="img/coming_soon.jpg" alt="Coming soon!">
	</div>
</div>
<div class="grid_7">
	<div class="productInfo">
		<h2><?php echo $values['name']; ?></h2>
		<span class="stock">Stock: <?php echo $values['quantity']; ?></span>
		<p><?php echo $values['description']; ?></p>
		<span class="priceBar">$<?php echo number_format($values['price'], 2, '.', ''); ?></span>
		<form method="post" action="cart">
			<input type="hidden" value="<?php echo $values['id']; ?>" name="itemID" >
			<span class="quantity">Quantity:<input type="number" name="quantity" value="" placeholder="1"></span>
			<input class="button addToCart" type="submit" value="Add To Cart" name="add" >
		</form>
	</div>
</div>
<div class="clear"></div>