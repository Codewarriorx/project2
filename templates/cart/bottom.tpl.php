<div class="grid_6">
	<div class="cartLeft">
		<a class="button" href="index.php">Continue Shopping</a>
		<div class="discount">
			<h3>Enter your discount code here:</h3>
			<input type="number" name="quantity" value="" placeholder="">
			<input class="button" type="submit" value="Discount Voucher Code" name="add">
		</div>
	</div>
</div>
<div class="grid_6">
	<div class="cartRight">
		<form method="post" action="cart.php">
			<input class="button" type="submit" value="Empty Cart" name="empty">
		</form>
		<input class="button" type="submit" value="Update Cart" name="add">
		<div class="totals">
			<span>Total</span><span>$<?php echo number_format($grandTotal, 2, '.', ''); ?></span>
			<span>Tax</span><span>$<?php echo number_format($cartTax, 2, '.', ''); ?></span>
		</div>
		<input class="button purchase" type="submit" value="Proceed to Checkout" name="add">
	</div>
</div>
<div class="clear"></div>