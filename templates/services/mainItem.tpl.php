<a href="<?php echo $link; ?>">
	<div class="item">
		<img src="img/coming_soon.jpg">
		<div class="price">$<?php echo number_format($price, 2, '.', ''); ?></div>
		<div class="caption">
			<h4><?php echo html_entity_decode($name); ?></h4>
			<p><?php echo html_entity_decode($this->itemDescriptionLimited($description, 80)); ?></p>
		</div>
	</div>
</a>