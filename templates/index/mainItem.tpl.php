<a href="item/index/<?php echo str_replace('item_','',$values['id']); ?>">
	<div class="item">
		<img src="img/<?php echo $values['image']; ?>" alt="<?php echo str_replace('"', '', $values['name']); ?> ">
		<div class="price">$<?php echo number_format($values['price'], 2, '.', ''); ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $values['quantity']; ?></div>
		<div class="caption">
			<h4><?php echo html_entity_decode($values['name']); ?></h4>
			<p><?php echo html_entity_decode($this->itemDescriptionLimited($values['description'], 80)); ?></p>
			<form method="post" action="cart">
				<input type="hidden" value="<?php echo $values['id']; ?>" name="itemID">
				<input class="button addToCart" type="submit" value="Add To Cart" name="add">
			</form>
		</div>
	</div>
</a>