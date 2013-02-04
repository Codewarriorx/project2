<tr class="cartItem">
	<td><img src="img/<?php echo $catalogValues['image']; ?>" alt="<?php echo str_replace('"', '', $catalogValues['name']); ?>"></td>
	<td><?php echo html_entity_decode($catalogValues['name']); ?><input type="hidden" value="<?php echo $catalogValues['id']; ?>" name="itemID[]"></td>
	<td>
		<form method="post" action="cart/deleteItem">
			<input type="hidden" value="<?php echo $cartValues['id']; ?>" name="cartID">
			<button class="iconButton" type="submit" name="remove"><img class="icon" src="img/glyphicons_016_bin.png" alt="bin icon"></button>
		</form>
	</td>
	<td><input type="number" name="quantity[]" value="<?php echo $cartValues['count']; ?>" placeholder="1"></td>
	<td>$<?php echo number_format($catalogValues['price'], 2, '.', ''); ?></td>
	<td>$<?php echo number_format($itemSum, 2, '.', ''); ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>