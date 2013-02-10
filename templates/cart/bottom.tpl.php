<div class="grid_6">
	<div class="cartLeft">
		<a class="button" href="home">Continue Shopping</a>
		<div class="discount">
			<h3>Enter your discount code here:</h3>
			<input type="number" name="quantity" value="" placeholder="">
			<input class="button" type="submit" value="Discount Voucher Code" name="add">
		</div>
	</div>
</div>
<div class="grid_6">
	<div class="cartRight">
			<input class="button" type="submit" value="Update Cart" name="add">
		<!-- </form> -->
		<form method="post" action="cart/emptyCart">
			<input class="button" type="submit" value="Empty Cart" name="empty">
		</form>
		<div class="totals">
			<span>Total</span><span>$<?php echo number_format($grandTotal, 2, '.', ''); ?></span>
			<span>Tax</span><span>$<?php echo number_format($cartTax, 2, '.', ''); ?></span>
		</div>
		<form method="post" action="cart/purchase">
			<input class="button purchase" type="submit" value="Proceed to Checkout" name="empty">
		</form>
	</div>
</div>
<div class="clear"></div>